<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    	$page_title = "Main Dashboard";
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);
    	return view('dashboard.index')->with('page_title', $page_title)->with('user', $user);
    }

    public function landing_pages() {
    	$page_title = "Landing Pages";
    	$user = array(
    		'name' => 'Sunny Singh',
    		'email' => 'ishy.singh@gmail.com'
    	);
    	return view('dashboard.landing-pages')->with('page_title', $page_title)->with('user', $user);
    }
}
