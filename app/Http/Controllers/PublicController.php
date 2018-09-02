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
    	$page_title = config('app.name') . " - Home";

    	return view('public.solutions')->with('page_title', $page_title);
    }
}
