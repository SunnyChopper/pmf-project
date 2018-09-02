<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\LandingPage;
use App\Signup;

class DashboardController extends Controller
{
    public function index() {
    	$page_title = "Main Dashboard";

        // Get user
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);

        // Get ideas
        $user_id = 1;
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

        // Get user
        $user_id = 1;
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);

        // Get landing pages from user
        $landing_pages = LandingPage::where('user_id', $user_id)->get();

    	return view('dashboard.landing-pages')->with('page_title', $page_title)->with('user', $user)->with('landing_pages', $landing_pages);
    }

    public function signups() {
        $page_title = "Signups";

        // Get user
        $user = array(
            'name' => 'Sunny Singh',
            'email' => 'ishy.singh@gmail.com'
        );

        // Get Signups
        $user_id = 1;
        $signups = Signup::where('user_id', $user_id)->get();

        return view('dashboard.signups')->with('page_title', $page_title)->with('user', $user)->with('signups', $signups);
    }

    public function create_idea() {
        $page_title = "New Idea";
        $user = array(
            'name' => 'Sunny Singh',
            'email' => 'ishy.singh@gmail.com'
        );
        return view('dashboard.new-idea')->with('page_title', $page_title)->with('user', $user);
    }

    public function edit_idea($idea_id) {
        $page_title = "Edit Idea";
        $user = array(
            'name' => 'Sunny Singh',
            'email' => 'ishy.singh@gmail.com'
        );

        // Get idea
        $idea = Idea::where('id', $idea_id)->first();

        // Get landing pages associated with idea
        $landing_pages = LandingPage::where('idea_id', $idea_id)->get();

        return view('dashboard.edit-idea')->with('page_title', $page_title)->with('user', $user)->with('idea', $idea)->with('landing_pages', $landing_pages);
    }
}
