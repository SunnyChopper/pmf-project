<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Signup;
use App\LandingPage;
use App\UserAnalytics;
use App\Idea;
use App\User;

use App\Custom\Logging;
use App\Custom\Mailing;

class SignupController extends Controller
{
	/* CRUD Public Functions */
	public function create(Request $data) {
		return $this->create_signup($data);
	}

	public function read($signup_id) {
		return $this->read_signup($signup_id)->toJson();
	}

	public function update(Request $data) {
		if ($this->update_signup($data, $data->signup_id) == true) {
			return "Successful";
		} else {
			return "Failed";
		}
	}

	public function delete(Request $data) {
		if ($this->delete_signup($data->signup_id) == true) {
			return redirect(url('/dashboard/signups'));
		} else {
			return redirect()->back();
		}
	}

	/* CRUD Private Functions */
	private function create_signup(Request $data) {
		// Gather relevant data
		$landing_page_id = $data->landing_page_id;
		$name = $data->name;
		$email = $data->email;
		$marketing_consent = $data->marketing_consent;

		// Check to see if email already submitted
		if (Signup::where('landing_page_id', $landing_page_id)->where('email', $email)->count() > 0) {
			return "You have already signed up for this offer!";
		}

		// Split name into first and last
		$name_array = $this->split_name($name);
		$first_name = $name_array[0];
		$last_name = $name_array[1];

		// Get landing page data and get who it belongs to
		$landing_page = LandingPage::where('id', $landing_page_id)->first();
		$user_id = $landing_page->user_id;

		// Update analytics
		$analytics = UserAnalytics::where('user_id', $user_id)->first();
		$analytics->number_of_signups = $analytics->number_of_signups + 1;
		$analytics->save();

		// Update analytics for user
		$landing_page->signups = $landing_page->signups + 1;
		$landing_page->save();

		// Update idea analytics
		$idea = Idea::where('id', $landing_page->idea_id)->first();
		$idea->signups = $idea->signups + 1;
		$idea->save();

		// Create Signup object and save
		$signup = new Signup;
		$signup->landing_page_id = $landing_page_id;
		$signup->first_name = $first_name;
		$signup->last_name = $last_name;
		$signup->email = $email;
		$signup->marketing_consent = $marketing_consent;
		$signup->user_id = $user_id;
		$signup->save();

		// Log the event
		$logging = new Logging($user_id);
		$new_signup_event = "There was a new signup for User " . $user_id . " for the landing page with ID of " . $landing_page->id . " where the first name of the signup was '" . $first_name . "' and the last name was '" . $last_name . "' and email of '" . $email . "'";
		$logging->insert($new_signup_event);

		// Send email to user
		$user = User::where('id', $user_id)->first();
		$user_email = $user->email;
		$subject = "⚡️ New Signup on OptinDev ⚡️";
		$header_text = "New Signup";
		$body = "<p>Congratulations, you just acquired a new signup on OptinDev for your landing page: <b>" . $landing_page->name . "</b>.</p>";
		$body .= "<p>Here are the details:</p><ul>";
		$body .= "<li>First Name: " . $first_name . "</li>";
		$body .= "<li>Last Name: " . $last_name . "</li>";
		$body .= "<li>Email: " . $email . "</li>";
		$body .= "</ul>";
		$body .= "<p>You can check the status of your landing pages and signups by clicking <a href='" . url('/dashboard/') . "'>here.</a></p>";
		$body .= "<p>Remember, you can always add your signups to your favorite email service provider and if you need to delete a signup for any particular reason, you can do so from the dashboard.</p>";
		$mail = new Mailing("notification", $user_email, $subject, $user->first_name, $user->last_name, $body, $header_text);
		$mail->send();

		return "Successful";
	}

	private function read_signup($signup_id) {
		// Return the Signup object
		return Signup::where('id', $signup_id)->get();
	}

	private function update_signup($data, $signup_id) {
		// Gather relevant data
		$name = $data->name;
		$email = $data->email;
		$marketing_consent = $data->marketing_consent;

		// Split name into first and last
		$name_array = $this->split_name($name);
		$first_name = $name_array[0];
		$last_name = $name_array[1];

		// Load up old signup object, update, and save
		$signup = Signup::where('id', $signup_id)->get();
		$signup->first_name = $first_name;
		$signup->last_name = $last_name;
		$signup->email = $email;
		$signup->marketing_consent = $marketing_consent;
		return $signup->save();
	}

	private function delete_signup($signup_id) {
		// Log the event
		$signup = Signup::where('id', $signup_id)->first();
		$logging = new Logging($signup->user_id);
		$delete_signup_event = "User " . $signup->user_id . " deleted a signup that belonged to landing page with ID of " . $signup->landing_page_id . " and where the first name was '" . $signup->first_name . "', last name was '" . $signup->last_name . "' and email was '" . $signup->email . "'";
		$logging->insert($delete_signup_event);

		// Update the landing page metrics
		$landing_page = LandingPage::where('id', $signup->landing_page_id)->first();
		$landing_page->signups = $landing_page->signups - 1;
		$landing_page->save();

		// Update the idea metrics
		$idea = Idea::where('id', $landing_page->idea_id)->first();
		$idea->signups = $idea->signups - 1;
		$idea->save();

		// Update user analytics
		$analytics = UserAnalytics::where('user_id', $signup->user_id)->first();
		$analytics->number_of_signups = $analytics->number_of_signups - 1;
		$analytics->save();

		// Load up signup object and delete
		return Signup::where('id', $signup_id)->delete();
	}

	/* Helper Functions */
	private function split_name($name) {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
		return array($first_name, $last_name);
	}

	private function get_user() {
		// Check if session variable set
		if (Session::get('logged_in') != true) {
			return 0;
		} else {
			// Return user
			return User::where('id', Session::get('user_id'))->first();
		}
	}
}
