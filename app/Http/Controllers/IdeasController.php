<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;

class IdeasController extends Controller
{
    public function create(Request $data) {
    	// Get data
    	$name = $data->name;
    	$description = $data->description;

    	// Get user id
    	$user_id = 1;

    	// Create idea
    	$idea = new Idea();
    	$idea->user_id = $user_id;
    	$idea->name = $name;
    	$idea->description = $description;
    	$idea->landing_pages = 0;
    	$idea->impressions = 0;
    	$idea->signups = 0;
    	$idea->save();

    	// Redirect to dashboard
    	return redirect(url('/dashboard/'));
    }

    public function edit(Request $data, $idea_id) {
    	// Get data
    	$name = $data->name;
    	$description = $data->description;

    	// Check if idea belongs to the user
    	$user_id = 1;
    	$idea = Idea::where('id', $idea_id)->first();

    	if ($user_id == $idea->user_id) {
    		// Yea, there is a match, time to edit
    		$idea->name = $name;
    		$idea->description = $description;
    		$idea->save();

    		// Redirect to dashboard
    		return redirect(url('/dashboard/'));
    	} else {
    		// Return back
    		return redirect()->back();
    	}
    }
}
