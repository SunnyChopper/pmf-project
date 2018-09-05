<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index() {
    	$page_title = config('app.name') . " - Home";

    	return view('public.index')->with('page_title', $page_title);
    }

    public function solutions() {
    	$page_header = "Solutions";
    	$page_title = config('app.name') . " - " . $page_header;

    	return view('public.solutions')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function checkout() {
    	// Page data
    	$page_header = "Checkout";
    	$page_title = config('app.name') . " - " . $page_header;

    	return view('public.checkout')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function trial() {
    	// Page data
    	$page_header = "Start Your Trial";
    	$page_title = config('app.name') . " - " . $page_header;
    	
    	return view('public.start-trial')->with('page_title', $page_title)->with('page_header', $page_header);
    }
}
