<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signup;
use App\LandingPage;
use App\UserAnalytics;
use App\Idea;

class SignupController extends Controller
{
	/* CRUD Public Functions */
	public function create(Request $data) {
		if ($this->create_signup($data) == true) {
			return "Successful";
		} else {
			return "Failed";
		}
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

	public function delete($signup_id) {
		if ($this->delete_signup($signup_id) == true) {
			return "Successful";
		} else {
			return "Failed";
		}
	}

	/* CRUD Private Functions */
	private function create_signup($data) {
		// Gather relevant data
		$landing_page_id = $data->landing_page_id;
		$name = $data->name;
		$email = $data->email;
		$marketing_consent = $data->marketing_consent;

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
		return $signup->save();
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
}
