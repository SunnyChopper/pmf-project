<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;

class UsersController extends Controller
{
	/* Public CRUD Functions */
	public function start_trial(Request $data) {
		// Create the trial customer
		return $this->create_trial_user($data);
	}

	public function login(Request $data) {
		// Get relevant data
		$email = $data->email;

		if ($this->does_user_exist('email', $email) == true) {
			// Get user info
			$user = $this->read_user_by_email($email);
			$hashed_password = $user->password;

			// Compare strings
			if (strcmp(Hash::make($data->password), $hashed_password) == true) {
				// Start session
				Session::put('logged_in', true);
				Session::put('user_id', $user->id);

				return "Success";
			} else {
				return "Incorrect password";
			}
		} else {
			return "User account does not exist.";
		}
	}

	public function logout() {
		Session::flush();
		return redirect(url('/'));
	}

	/* Private CRUD Functions */
	private function create_paying_user(Request $data) {
		// Gather relevant metadata
		$user_id = $data->user_id;
		$first_name = $data->first_name;
		$last_name = $data->last_name;
		$email = $data->email;

		// Create derivative data
		$authorized = 1;
		$paid = 1;
		$cancelled = 0;
		$card_error = 0;
		$trial = 0;
		$next_payment_date = date("Y-m-d", strtotime("+1 month"));

		// Get User object and save
		$user = User::where('id', $user_id)->first();
		$user->authorized = $authorized;
		$user->trial = $trial;
		$user->paid = $paid;
		$user->cancelled = $cancelled;
		$user->next_payment_date = $next_payment_date;
		$user->card_error = $card_error;
		$user->is_active = 1;
		return $user->save();
	}

	private function create_trial_user(Request $data) {
		// Gather relevant metadata
		$first_name = $data->first_name;
		$last_name = $data->last_name;
		$email = $data->email;
		$password = Hash::make($data->password);

		// Check if User already exists with same email
		if (count(User::where('email', $email)->first()) == 0) {
			// Create derivative data
			$authorized = 0;
			$paid = 0;
			$cancelled = 0;
			$card_error = 0;
			$trial = 1;
			$next_payment_date = date("Y-m-d", strtotime("+1 month"));

			// Create User object and save
			$user = new User;
			$user->first_name = $first_name;
			$user->last_name = $last_name;
			$user->email = $email;
			$user->password = $password;
			$user->authorized = $authorized;
			$user->trial = $trial;
			$user->paid = $paid;
			$user->cancelled = $cancelled;
			$user->next_payment_date = $next_payment_date;
			$user->card_error = $card_error;
			$user->is_active = 1;
			$user->save();

			// Set session variables
			Session::put('logged_in', true);
			Session::put('user_id', $user->id);

			return "Success";
		} else {
			return "Duplicate email";
		}
	}

	private function read_user($user_id) {
		return User::where('id', $user_id)->first();
	}

	private function read_user_by_email($email) {
		return User::where('email', $email)->first();
	}

	private function update_user(Request $data) {
		// Load up user
		$user = User::where('id', $data->user_id)->first();

		// Update data
		if(isset($data->email)) {
			$user->email = $data->email;
		}

		if (isset($data->password)) {
			$user->password = Hash::make($data->password);
		}

		if (isset($data->first_name)) {
			$user->first_name = $data->first_name;
		}

		if (isset($data->last_name)) {
			$user->last_name = $data->last_name;
		}

		if (isset($data->authorized)) {
			$user->authorized = $data->authorized;
		}

		if (isset($data->trial)) {
			$user->trial = $data->trial;
		}

		if (isset($data->paid)) {
			$user->paid = $data->paid;
		}

		if (isset($data->cancelled)) {
			$user->cancelled = $data->cancelled;
		}

		if (isset($data->next_payment_date)) {
			$user->next_payment_date = $data->next_payment_date;
		}

		if (isset($data->card_error)) {
			$user->card_error = $data->card_error;
		}

		return $user->save();
	}

	private function delete_user($user_id) {
		// Get user
		$user = User::where('id', $user_id)->first();
		$user->is_active = 0;
		return $user->save();
	}

	private function does_user_exist($lookup_field, $value) {
		if (User::where($lookup_field, $value)->count() != 0) {
			return true;
		} else {
			return false;
		}
	}
}
