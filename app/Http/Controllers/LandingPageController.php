<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use DOMDocument;
use DOMXpath;
use URL;
use File;
use SimpleXMLElement;
use App\Idea;
use App\XMLInfo;
use App\Template;
use App\LandingPage;

class LandingPageController extends Controller
{
	public function test() {
		$doc = new DOMDocument;
		$doc->load(URL::asset('/xml/test.xml'));

		$xpath = new DOMXpath($doc);
		$nodes = $xpath->query('/landingpage/*');

		$node_array = array();
		foreach($nodes as $node)
		{
			$node_array[$node->nodeName] = $node->nodeValue;
		}

		return view('templates.sample-template')->with('node_array', $node_array);
	}

	public function choose_template() {
		// Page details
		$page_title = "Choose Landing Page Template";

		// Get user
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);

    	// Get templates
    	$templates = Template::paginate(12);

    	return view('dashboard.choose-template')->with('page_title', $page_title)->with('user', $user)->with('templates', $templates);
	}

	public function customize($template_id) {
		// Page details
		$page_title = "Customize Your Template";

		// Get user
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);

    	// Get ideas for user
    	$user_id = 1;
    	$ideas = Idea::where('user_id', $user_id)->get();

    	// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($template_id);

    	return view('dashboard.customize-template')->with('page_title', $page_title)->with('user', $user)->with('xml_tags', $xml_tags)->with('template_id', $template_id)->with('ideas', $ideas);
	}

	public function render(Request $data, $template_id) {
		// Page details
		$page_title = "Customize Your Template";

		// Get user
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);

    	// Get template info
    	$template = Template::where('id', $template_id)->first();
    	$path_to_html = "preview-renders." . $template->path_to_html;

    	// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($template_id);
		
		return view($path_to_html)->with('data', $data)->with('template_id', $template_id)->with('xml_tags', $xml_tags);
	}

	public function publish(Request $data, $template_id) {
		// Get user info
		$user_id = 1;

		// Get idea info
		// TODO: Get idea info from hidden input
		$idea_id = 1;
		$idea_name = "Test Idea #1";

		// Get landing page data
		// TODO: Get landing page data from hidden input
		$landing_page_name = "Testing Landing Page";
		$landing_page_preview_link = "";

		// Get template info
    	$template = Template::where('id', $template_id)->first();
    	$path_to_html = "templates." . $template->path_to_html;

		// Save into database
		$landing_page = new LandingPage;
		$landing_page->user_id = $user_id;
		$landing_page->idea_id = $idea_id;
		$landing_page->idea_name = $idea_name;
		$landing_page->name = $landing_page_name;
		$landing_page->landing_page_template_path = $path_to_html;
		$landing_page->impressions = 0;
		$landing_page->signups = 0;
		$landing_page->save();
		$landing_page_id = $landing_page->id;

		// Get XML link
		$xml_link = $this->get_xml_path($user_id, $landing_page_id);
		$landing_page->xml_link = $xml_link;
		$landing_page->save();

		// Counter for template
		$template->active_pages = $template->active_pages + 1;
		$template->save();

		// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($template_id);
    	$tags = array();
    	$values = array();
    	foreach($xml_tags as $tag => $value) {
    		array_push($tags, $tag);
    		array_push($values, $data->$tag);
    	}

		// Generate XML
		$this->generate_xml($user_id, $landing_page_id, $tags, $values);

		// Update Idea object to let it know of a new landing page
		$idea = Idea::where('id', $idea_id)->first();
		$idea->landing_pages = $idea->landing_pages + 1;
		$idea->save();

		// Redirect
		return redirect(url('/'));
	}

	public function view($user_id, $landing_page_id) {
		// Get landing page info
		$landing_page = LandingPage::where('id', $landing_page_id)->first();
		$template_path = $landing_page->landing_page_template_path;
		$xml_link = $landing_page->xml_link;

		// Get XML tags
		$xml_data = $this->read_xml('local', $xml_link);

		// Get HTML
		return view($template_path)->with('xml_data', $xml_data);
	}

	public function test_xml() {
		// $tags = ["title", "description"];
		// $values = ["Test title", "This is a test description that has been edited."];
		// $this->edit_xml(1, 1, $tags, $values);

		$xml_tags = $this->get_xml_tags(1);
		foreach ($xml_tags as $tag => $tag_data) {
			switch ($tag_data[0]) {
				case "text":
					echo "<label>" . $tag_data[1] . "</label>";
					echo "<br>";
					echo "<input type='text' name='" . $tag ."'>";
					echo "<br>";
					break;
				case "textarea":
					echo "<label>" . $tag_data[1] . "</label>";
					echo "<br>";
					echo "<textarea name='" . $tag ."'></textarea>";
					echo "<br>";
					break;
				default:
					break;
			}
		} 
	}

	private function get_xml_tags($template_id) {
		// Get XMLInfo object
		$xml_info = XMLInfo::where('template_id', $template_id)->first();

		// Parse string to JSON and return
		return json_decode($xml_info->xml_tags, true);
	}

	private function edit_xml($user_id, $landing_page_id, $tags, $values) {
		// Let's create the new XML file
		$xml = new SimpleXMLElement('<landingpage/>');

		// Loop through the tags and values
		$num_of_loops = count($tags);
		for ($i = 0; $i < $num_of_loops; $i++) {
			$xml->addChild($tags[$i], $values[$i]);
		}

		// Store this file
		$filename = "landing_page_" . $landing_page_id . ".xml";
		$path = 'user/' . $user_id . '/xml/' . $filename;
		Storage::put($path, $xml->asXML());
	}

	private function generate_xml($user_id, $landing_page_id, $tags, $values) {
		// Get everything setup by creating XML directory for user
		$this->create_xml_directory('local', $user_id);

		// Next, let's create the XML file
		$xml = new SimpleXMLElement('<landingpage/>');

		// Loop through the tags and values
		$num_of_loops = count($tags);
		for ($i = 0; $i < $num_of_loops; $i++) {
			$xml->addChild($tags[$i], $values[$i]);
		}

		// Store this file
		$filename = "landing_page_" . $landing_page_id . ".xml";
		$path = 'user/' . $user_id . '/xml/' . $filename;
		Storage::put($path, $xml->asXML());
	}

	private function read_xml($target, $xml_path) {
		// Load up XML file
		$xml_string = Storage::disk($target)->get($xml_path);
		$xml = simplexml_load_string($xml_string);
		$json = json_encode($xml);
		$return_array = json_decode($json,TRUE);
		return $return_array;
	}

	private function get_xml_path($user_id, $landing_page_id) {
		// Store this file
		$filename = "landing_page_" . $landing_page_id . ".xml";
		$path = 'user/' . $user_id . '/xml/' . $filename;
		return $path;
	}
	
	private function create_xml_directory($target, $user_id) {
		// Generate the path
		$path = 'user/' . $user_id . '/xml';

		// Check to see if exists
		if (!$this->does_directory_exist('local', $path)) {
			// No, it doesn't, let's create it
			Storage::disk($target)->makeDirectory($path);
		}
	}

	private function does_directory_exist($target, $dir) {
		return Storage::disk($target)->has($dir);
	}

	private function does_file_exist($target, $path) {
		return Storage::disk($target)->has($path);
	}
}

