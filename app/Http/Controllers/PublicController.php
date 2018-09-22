<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

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

    public function blog() {
        // Page data
        $page_header = "Blog";
        $page_title = config('app.name') . " - " . $page_header;

        return view('public.blog')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function contact() {
        // Page data
        $page_header = "Contact";
        $page_title = config('app.name') . " - " . $page_header;

        return view('public.contact')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function login() {
        // Page data
        $page_header = "Login";
        $page_title = config('app.name') . " - " . $page_header;

        return view('public.login')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function test() {
        $data = array(
            "first_name" => "Sunny",
            "last_name" => "Singh",
            "header_text" => "Welcome",
            "body" => "<p>Welcome to Optin Dev. Let's start growing our brands!</p>",
            "email" => "ishy.singh@gmail.com"
        );

        Mail::send('emails.notification', $data, function($message) use ($data) {
            $message->to($data["email"], $data["first_name"] . " " . $data["last_name"])
                    ->subject('Welcome to OptinDev');
            $message->from('optindev@gmail.com','OptinDev');
        });
    }

}
