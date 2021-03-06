<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Idea;
use App\UserAnalytics;
use App\User;
use App\LandingPage;

use App\Custom\Logging;

class IdeasController extends Controller
{
    public function create(Request $data) {
    	// Get data
    	$name = $data->name;
    	$description = $data->description;

    	// Get user id
        $user = $this->get_user();
        $user_id = $user->id;

        // Update user analytics
        $analytics = UserAnalytics::where('user_id', $user_id)->first();
        $analytics->number_of_ideas = $analytics->number_of_ideas + 1;
        $analytics->save();

    	// Create idea
    	$idea = new Idea();
    	$idea->user_id = $user_id;
    	$idea->name = $name;
    	$idea->description = $description;
        $idea->reach = 0;
    	$idea->landing_pages = 0;
    	$idea->impressions = 0;
    	$idea->signups = 0;
    	$idea->save();

        // Log the event
        $logging = new Logging($user_id);
        $new_idea_event = "User " . $user_id . " created a new Value Idea with the name of " . $name;
        $logging->insert($new_idea_event);

    	// Redirect to dashboard
    	return redirect(url('/dashboard/'));
    }

    public function delete(Request $data) {
        // Get data
        $idea_id = $data->idea_id;

        // Get user id
        $user = $this->get_user();
        $user_id = $user->id;

        // Get idea data and "delete"
        $idea = Idea::where('id', $idea_id)->first();
        $idea_landing_pages = $idea->landing_pages;
        $idea->is_active = 0;
        $idea->save();

        // Get all landing pages for the idea and "delete" them
        $landing_pages = LandingPage::where('idea_id', $idea->id)->get();
        foreach ($landing_pages as $landing_page) {
            $landing_page->is_active = 0;
            $landing_page->save();
        }

        // Update user analytics
        $analytics = UserAnalytics::where('user_id', $user_id)->first();
        $analytics->number_of_ideas = $analytics->number_of_ideas - 1;
        $analytics->number_of_landing_pages = $analytics->number_of_landing_pages - $idea_landing_pages;
        $analytics->number_of_impressions = $analytics->number_of_impressions - $idea->impressions;
        $analytics->save();

        // Redirect back
        return redirect()->back();
    }

    public function edit(Request $data, $idea_id) {
    	// Get data
    	$name = $data->name;
    	$description = $data->description;

    	// Check if idea belongs to the user
        $user = $this->get_user();
        $user_id = $user->id;
    	$idea = Idea::where('id', $idea_id)->first();

        // Update user analytics
        $analytics = UserAnalytics::where('user_id', $user_id)->first();
        $analytics->number_of_idea_edits = $analytics->number_of_idea_edits + 1;
        $analytics->save();

    	if ($user_id == $idea->user_id) {
    		// Yea, there is a match, time to edit
    		$idea->name = $name;
    		$idea->description = $description;
    		$idea->save();

            // Log the event
            $logging = new Logging($user_id);
            $edit_idea_event = "User " . $user_id . " edited the Value Idea with ID of " . $idea->id;
            $logging->insert($edit_idea_event);

    		// Redirect to dashboard
    		return redirect(url('/dashboard/'));
    	} else {
    		// Return back
    		return redirect()->back();
    	}
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
}
