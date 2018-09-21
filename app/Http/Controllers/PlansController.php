<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class PlansController extends Controller
{
	/* Public CRUD Functions */
    public function index($plan_id) {
    	// Get plan
    	$plan = $this->read($plan_id);
        $plan->impressions = $plan->impressions + 1;
        $plan->save();

        // Page data
        $page_header = $plan->title;
        $page_title = config('app.name') . " - " . $page_header;

    	return view('public.checkout')->with('plan', $plan)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function all_plans() {
    	// Page data
    	$page_header = "Plans";
    	$page_title = config('app.name') . " - " . $page_header;

    	// Get all plans
    	$plans = Plan::all();

    	return view('public.all_plans')->with('plans', $plans)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    /* Private CRUD Functions */
    private function read($plan_id) {
    	return Plan::where('id', $plan_id)->first();
    }
}
