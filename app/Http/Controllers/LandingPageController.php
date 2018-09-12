<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use DOMDocument;
use DOMXpath;
use URL;
use File;
use SimpleXMLElement;
use Session;

use App\User;
use App\Idea;
use App\XMLInfo;
use App\Template;
use App\LandingPage;

class LandingPageController extends Controller
{

	public function choose_template() {
		// Page details
		$page_title = "Choose Landing Page Template";

		// Get user
    	$user = $this->get_user();

    	// Get templates
    	$templates = Template::paginate(12);

    	return view('dashboard.choose-template')->with('page_title', $page_title)->with('user', $user)->with('templates', $templates);
	}

	public function customize($template_id) {
		// Page details
		$page_title = "Customize Your Template";

		// Get user
    	$user = $this->get_user();
    	$user_id = $user->id;

    	// Get ideas for user
    	$ideas = Idea::where('user_id', $user_id)->get();

    	// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($template_id);

    	return view('dashboard.customize-template')->with('page_title', $page_title)->with('user', $user)->with('xml_tags', $xml_tags)->with('template_id', $template_id)->with('ideas', $ideas);
	}

	public function render(Request $data, $template_id, $mode) {
		// Page details
		$page_title = "Customize Your Template";

		// Get user
    	$user = $this->get_user();

    	// Get template info
    	$template = Template::where('id', $template_id)->first();
    	$path_to_html = "preview-renders." . $template->path_to_html;

    	// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($template_id);
		
		// Check to see if in edit mode
		if ($mode == "edit") {
			return view($path_to_html)->with('data', $data)->with('template_id', $template_id)->with('xml_tags', $xml_tags)->with('mode', $mode)->with('landing_page_id', $data->landing_page_id);
		} else {
			return view($path_to_html)->with('data', $data)->with('template_id', $template_id)->with('xml_tags', $xml_tags)->with('mode', $mode);
		}
	}

	public function publish(Request $data, $template_id) {
		// Get user
    	$user = $this->get_user();
    	$user_id = $user->id;

		// Get idea info
		$idea_id = $data->idea_id;
		$idea = Idea::where('id', $idea_id)->first();
		$idea_name = $idea->name;

		// Get landing page data
		$landing_page_name = $data->landing_page_name;
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
		$landing_page->template_id = $template_id;
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

		// Redirect back to landing pages
		return redirect(url('/dashboard/landing-pages/'));
	}

	public function view($user_id, $landing_page_id) {
		// Get landing page info
		$landing_page = LandingPage::where('id', $landing_page_id)->first();
		$template_path = $landing_page->landing_page_template_path;
		$xml_link = $landing_page->xml_link;

		// Get XML tags
		$xml_data = $this->read_xml('local', $xml_link);

		// Get HTML
		return view($template_path)->with('xml_data', $xml_data)->with('landing_page_id', $landing_page_id);
	}

	public function edit($landing_page_id) {
		// Page data
		$page_title = "Edit Landing Page";

    	// Get user
    	$user = $this->get_user();

		// Get landing page
		$landing_page = LandingPage::where('id', $landing_page_id)->first();
		$xml_data = $this->read_xml('local', $landing_page->xml_link);
		$xml_tags = $this->get_xml_tags($landing_page->template_id);

		// Get ideas for user
    	$user_id = $user->id;
    	$ideas = Idea::where('user_id', $user_id)->get();

		return view('dashboard.edit-landing-page')->with('page_title', $page_title)->with('user', $user)->with('landing_page', $landing_page)->with('xml_data', $xml_data)->with('xml_tags', $xml_tags)->with('template_id', $landing_page->template_id)->with('ideas', $ideas);
	}

	public function edit_data(Request $data, $landing_page_id) {
		// Get user
    	$user = $this->get_user();
    	$user_id = $user->id;

		// Get landing page
		$landing_page = LandingPage::where('id', $landing_page_id)->first();

		// Check if idea changed
		$new_idea_id = $data->idea_id;
		if ($new_idea_id != $landing_page->idea_id) {
			// Change landing_pages variables
			$original_idea = Idea::where('id', $landing_page->idea_id)->first();
			$new_idea = Idea::where('id', $new_idea_id)->first();

			// Number of landing pages that belong to idea
			$original_idea->landing_pages = $original_idea->landing_pages - 1;
			$new_idea->landing_pages = $new_idea->landing_pages + 1;

			// Name and ID of idea
			$landing_page->idea_name = $new_idea->name;
			$landing_page->idea_id = $new_idea_id;

			// Save
			$original_idea->save();
			$new_idea->save();
			$landing_page->save();
		}

		// Check if landing page name changed
		$new_landing_page_name = $data->landing_page_name;
		if ($new_landing_page_name != $landing_page->name) {
			// Update
			$landing_page->name = $new_landing_page_name;
			$landing_page->save();
		}

		// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($landing_page->template_id);
    	$tags = array();
    	$values = array();
    	foreach($xml_tags as $tag => $value) {
    		array_push($tags, $tag);
    		array_push($values, $data->$tag);
    	}

		// Edit XML
		$this->edit_xml($user_id, $landing_page_id, $tags, $values);

		// Redirect to landing pages
		return redirect(url('/dashboard/landing-pages/'));
	}

	/* Private Helper Functions */
    private function get_user() {
        // Check if session variable set
        if (session()->get('logged_in') != true) {
            return redirect(url('/start-trial'));
        } else {
            // Return user
            return User::where('id', Session::get('user_id'))->first();
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

