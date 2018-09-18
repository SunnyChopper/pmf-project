<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Custom\Analytics;

use App\Idea;
use App\LandingPage;
use App\Signup;
use App\User;

class DashboardController extends Controller
{
    public function index() {
    	$page_title = "Main Dashboard";

        // Check if logged out
        if (Session::get('logged_in') == NULL) {
            return redirect(url('/login'));
        }

        // Check for trial
        if ($this->has_trial_ended() == "Yes") {
            return redirect(url('/trial-ended'));
        }

        // Get user
    	$user = $this->get_user();
        $user_id = $user->id;

        // Check if user needs onboarding
        $analytics = new Analytics($user_id);
        if ($analytics->doesUserNeedOnboarding() == true) {
            // TODO: Create an onboarding process
            return redirect(url('/onboarding/start'));
        }

        // Get ideas
        $ideas = Idea::where('user_id', $user_id)->get();

        // Calculate stats
        if (count($ideas) == 0) {
            $stats_array = array(
                "impressions" => 0,
                "signups" => 0,
                "landing_pages" => 0
            );
        } else {
            $stats_array = array();
            $impressions = 0;
            $signups = 0;
            $landing_pages = 0;

            foreach ($ideas as $idea) {
                $impressions += $idea->impressions;
                $signups += $idea->signups;
                $landing_pages += $idea->landing_pages;
            }

            $stats_array["impressions"] = $impressions;
            $stats_array["signups"] = $signups;
            $stats_array["landing_pages"] = $landing_pages;
        }

    	return view('dashboard.index')->with('page_title', $page_title)->with('user', $user)->with('ideas', $ideas)->with('stats_array', $stats_array);
    }

    public function landing_pages() {
    	$page_title = "Landing Pages";

        // Check if logged out
        if (Session::get('logged_in') == NULL) {
            return redirect(url('/login'));
        }

        // Check for trial
        if ($this->has_trial_ended() == "Yes") {
            return redirect(url('/trial-ended'));
        }

        // Get user
        $user = $this->get_user();
        $user_id = $user->id;

        // Get landing pages from user
        $landing_pages = LandingPage::where('user_id', $user_id)->get();

    	return view('dashboard.landing-pages')->with('page_title', $page_title)->with('user', $user)->with('landing_pages', $landing_pages);
    }

    public function signups() {
        $page_title = "Signups";

        // Check if logged out
        if (Session::get('logged_in') == NULL) {
            return redirect(url('/login'));
        }

        // Check for trial
        if ($this->has_trial_ended() == "Yes") {
            return redirect(url('/trial-ended'));
        }

        // Get user
        $user = $this->get_user();
        $user_id = $user->id;

        // Get Signups
        $signups = Signup::where('user_id', $user_id)->get();

        return view('dashboard.signups')->with('page_title', $page_title)->with('user', $user)->with('signups', $signups);
    }

    public function create_idea() {
        $page_title = "New Idea";

        // Check if logged out
        if (Session::get('logged_in') == NULL) {
            return redirect(url('/login'));
        }

        // Get user
        $user = $this->get_user();
        $user_id = $user->id;

        return view('dashboard.new-idea')->with('page_title', $page_title)->with('user', $user);
    }

    public function edit_idea($idea_id) {
        $page_title = "Edit Idea";

        // Check if logged out
        if (Session::get('logged_in') == NULL) {
            return redirect(url('/login'));
        }
        
        // Get user
        $user = $this->get_user();
        $user_id = $user->id;

        // Get idea
        $idea = Idea::where('id', $idea_id)->first();

        // Get landing pages associated with idea
        $landing_pages = LandingPage::where('idea_id', $idea_id)->get();

        return view('dashboard.edit-idea')->with('page_title', $page_title)->with('user', $user)->with('idea', $idea)->with('landing_pages', $landing_pages);
    }

    public function trial_ended() {
        $page_title = "Trial Ended";

        // Check if logged out
        if (Session::get('logged_in') == NULL) {
            return redirect(url('/login'));
        }
        
        // Get user
        $user = $this->get_user();
        $user_id = $user->id;

        return view('dashboard.trial-ended')->with('page_title', $page_title)->with('user', $user);
    }

    /* Private Helper Functions */
    private function get_user() {
        // Check if session variable set
        if (Session::get('logged_in') != true) {
            return 0;
        } else {
            // Return user
            return User::where('id', Session::get('user_id'))->first();
        }
    }

    private function has_trial_ended() {
        // First get user
        $user = $this->get_user();
        $user_id = $user->id;

        // Get now
        $today = date("Y-m-d");

        // Check to see if trial has ended
        if ($user->trial == 1) {
            if ($user->next_payment_date <= $today) {
                return "Yes";
            }
        }
    }
}
