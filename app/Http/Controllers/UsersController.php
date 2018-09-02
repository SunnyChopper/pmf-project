<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    /* Private CRUD Functions */
    private function create_user(Request $data) {
    	// Check to see if trial
    	$trial_pwd = $data->tp;
    	$trial = $data->trial;

    	if ($trial_pwd == 'pmf-s1997' && $trial == 1) {
    		/* YES TRIAL */
    		// Gather relevant metadata
    		$first_name = $data->first_name;
	    	$last_name = $data->last_name;
	    	$email = $data->email;
	    	$password = Hash::make($data->password);

	    	// Create derivative data
	    	$authorized = 0;
	    	$paid = 0;
	    	$cancelled = 0;
	    	$card_error = 0;
	    	$next_payment_date = date("Y-m-d", strtotime("+1 week"));

	    	// Create User object and save
	    	$user = new User;
	    	$user->email = $email;
	    	$user->password = $password;
	    	$user->authorized = $authorized;
	    	$user->trial = $trial;
	    	$user->paid = $paid;
	    	$user->cancelled = $cancelled;
	    	$user->next_payment_date = $next_payment_date;
	    	$user->first_name = $first_name;
	    	$user->last_name = $last_name;
	    	$user->card_error = $card_error;
	    	$user->is_active = 1;
	    	return $user->save();
    	} else {
    		/* NO TRIAL */
    		// Gather relevant metadata
	    	$first_name = $data->first_name;
	    	$last_name = $data->last_name;
	    	$email = $data->email;
	    	$password = Hash::make($data->password);
	    	$customer_id = $data->customer_id;
	    	$sub_id = $data->sub_id;

	    	// Create derivative data
	    	$authorized = 0;
	    	$paid = 1;
	    	$cancelled = 0;
	    	$card_error = 0;
	    	$next_payment_date = date("Y-m-d", strtotime("+1 month"));

	    	// Create User object and save
	    	$user = new User;
	    	$user->email = $email;
	    	$user->password = $password;
	    	$user->authorized = $authorized;
	    	$user->trial = $trial;
	    	$user->paid = $paid;
	    	$user->cancelled = $cancelled;
	    	$user->next_payment_date = $next_payment_date;
	    	$user->customer_id = $customer_id;
	    	$user->sub_id = $sub_id;
	    	$user->first_name = $first_name;
	    	$user->last_name = $last_name;
	    	$user->card_error = $card_error;
	    	$user->is_active = 1;
	    	return $user->save();
    	}
    }

    private function read_user($user_id) {
    	return User::where('id', $user_id)->first();
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
}
