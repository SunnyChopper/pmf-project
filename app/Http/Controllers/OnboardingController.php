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
use App\UserAnalytics;

class OnboardingController extends Controller
{
	/* --------------------- *\
		First Step
	\* --------------------- */

    public function index() {
    	// Page data
    	$page_title = "OptinDev - Get Started";
    	$step_number = 1;

    	// Return the view
    	return view('onboarding.pages.index')->with('page_title', $page_title)->with('step_number', $step_number);
    }

    public function createIdea(Request $data) {
    	// Gather data
    	$name = $data->idea_name;
    	$description = $data->idea_description;

    	// Get user information
    	$user = $this->get_user();
    	$user_id = $user->id;

    	// Create Idea and save
    	$idea = new Idea;
    	$idea->user_id = $user_id;
    	$idea->name = $name;
    	$idea->description = $description;
    	$idea->landing_pages = 0;
    	$idea->impressions = 0;
    	$idea->signups = 0;
    	$idea->save();

    	// Update the analytics
    	$user_analytics = UserAnalytics::where('user_id', $user_id)->first();
    	$user_analytics->number_of_ideas = $user_analytics->number_of_ideas + 1;
    	$user_analytics->save();

    	// Go to next page
    	return redirect(url('/onboarding/choose-template'));
    }

    /* --------------------- *\
		Second Step
	\* --------------------- */

    public function choose_template() {
    	// Page data
    	$page_title = "OptinDev - Choose a Template";
    	$step_number = 2;

    	// Return the view
    	return view('onboarding.pages.choose-template')->with('page_title', $page_title)->with('step_number', $step_number);
    }

    /* --------------------- *\
		Third Step
	\* --------------------- */

	public function edit_template($template_id) {
		// Page data
    	$page_title = "OptinDev - Edit Your Template";
    	$step_number = 3;

    	// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($template_id);

    	// Return the view
    	return view('onboarding.pages.edit-template')->with('page_title', $page_title)->with('step_number', $step_number)->with('xml_tags', $xml_tags)->with('template_id', $template_id);
	}

	public function renderOptinPage(Request $data) {
		// Page data
		$page_title = $data->page_title;

		// Get template info
    	$template = Template::where('id', $data->template_id)->first();
    	$path_to_html = "onboarding.renders." . $template->path_to_html;

    	// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($data->template_id);

    	// Take to rendering
    	return view($path_to_html)->with('data', $data)->with('template_id', $data->template_id)->with('xml_tags', $xml_tags);
	}

	public function createOptinPage(Request $data) {
		// Get user
    	$user = $this->get_user();
    	$user_id = $user->id;

    	// Get idea info
		$idea = Idea::where('user_id', $user_id)->first();
		$idea_name = $idea->name;
		$idea_id = $idea->id;

		// Get landing page data
		$landing_page_name = $data->landing_page_name;
		$landing_page_preview_link = "";

		// Get template info
    	$template = Template::where('id', $data->template_id)->first();
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
		$landing_page->template_id = $data->template_id;
		$landing_page->save();
		$landing_page_id = $landing_page->id;

		// Update user analytics
		$analytics = UserAnalytics::where('user_id', $user_id)->first();
		$analytics->number_of_landing_pages = $analytics->number_of_landing_pages + 1;
		$analytics->save();

		// Get XML link
		$xml_link = $this->get_xml_path($user_id, $landing_page_id);
		$landing_page->xml_link = $xml_link;
		$landing_page->save();

		// Counter for template
		$template->active_pages = $template->active_pages + 1;
		$template->save();

		// Get XML fields for the template
    	$xml_tags = $this->get_xml_tags($data->template_id);
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

		// Redirect back to onboarding
		return redirect(url('/onboarding/share'));
	}

	/* --------------------- *\
		Fourth Step
	\* --------------------- */

	public function share() {
		// Page data
		$page_title = "OptinDev - Share with Your Audience";
    	$step_number = 4;

		// Get user
    	$user = $this->get_user();
    	$user_id = $user->id;

		// Get landing page
		$landing_page = LandingPage::where('user_id', $user_id)->first();

		// Get path to landing page
		$url = "http://optindev.com/lp/" . $user_id . "/" . $landing_page->id;

		// Let's update analytics
		$user_analytics = UserAnalytics::where('user_id', $user_id)->first();
		$user_analytics->onboard = 2;
		$user_analytics->save();

		// Return view
		return view('onboarding.pages.share')->with('page_title', $page_title)->with('step_number', $step_number)->with('url', $url);
	}

    /* --------------------- *\
		Private Functions
	\* --------------------- */

    private function get_user() {
        // Check if session variable set
        if (session()->get('logged_in') != true) {
            return 0;
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

	private function get_xml_path($user_id, $landing_page_id) {
		// Store this file
		$filename = "landing_page_" . $landing_page_id . ".xml";
		$path = 'user/' . $user_id . '/xml/' . $filename;
		return $path;
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
