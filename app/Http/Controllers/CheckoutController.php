<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Plan;
use App\User;
use App\UserAnalytics;

use Mail;


class CheckoutController extends Controller
{
	public function checkout(Request $data, $plan_id) {
		// Check to see if we need to do any Stripe work
		$plan = Plan::where('id', $plan_id)->first();

		if ($plan->trial == 1) {
			// Check if User already exists with same email
			if (count(User::where('email', $data->email)->first()) == 0) {
				// Create derivative data
				$authorized = 0;
				$paid = 0;
				$cancelled = 0;
				$card_error = 0;
				$trial = 1;

				// Calculate the date when trial ends
				$next_payment_date = date("Y-m-d", strtotime("+" . $plan->trial_days . " days"));

				// Simply create the user
				$user = new User;
				$user->first_name = $data->first_name;
				$user->last_name = $data->last_name;
				$user->email = $data->email;
				$user->password = Hash::make($data->password);
				$user->authorized = $authorized;
				$user->trial = $trial;
				$user->paid = $paid;
				$user->cancelled = $cancelled;
				$user->next_payment_date = $next_payment_date;
				$user->card_error = $card_error;
				$user->is_active = 1;
				$user->save();

				// Create user analytics object
				$analytics = new UserAnalytics;
				$analytics->user_id = $user->id;
				$analytics->number_of_logins = 0;
				$analytics->number_of_impressions = 0;
				$analytics->number_of_signups = 0;
				$analytics->number_of_ideas = 0;
				$analytics->number_of_idea_edits = 0;
				$analytics->number_of_landing_pages = 0;
				$analytics->number_of_landing_page_edits = 0;
				$analytics->onboard = 0;
				$analytics->save();

				// Update the plan
				$plan->signups = $plan->signups + 1;
				$plan->save();

				// Send out the welcome email
				$this->welcome_email($data->first_name, $data->last_name, $data->email);

				// Set session variables
				Session::put('logged_in', true);
				Session::put('user_id', $user->id);

				return "Success";
			} else {
				return "Duplicate email";
			}
		} else {
			// Be sure to replace this with your actual test API key
			// (Switch to the live key later)
			\Stripe\Stripe::setApiKey("sk_test_skdi9fJ5e8Q9t1hGa1jUZDfX");

			if (count(User::where('email', $data->email)->first()) == 0) {
				// Try to create customer and enroll into subscription
				try {
					// Create a customer
					$customer = \Stripe\Customer::create(array(
						'email' => $data->email,
						'source' => $data->stripeToken
					));

					// Create subscription
					$subscription = \Stripe\Subscription::create(array(
						'customer' => $customer->id,
						'plan' => $plan->plan_id,
						'trial_period_days' => $plan->trial_days
					));

					// Create derivative data
					$authorized = 0;
					$paid = 1;
					$cancelled = 0;
					$card_error = 0;
					$trial = 0;

					// Create the user
					$user = new User;
					$user->first_name = $data->first_name;
					$user->last_name = $data->last_name;
					$user->email = $data->email;
					$user->password = Hash::make($data->password);
					$user->authorized = $authorized;
					$user->trial = $trial;
					$user->paid = $paid;
					$user->cancelled = $cancelled;
					$user->next_payment_date = $next_payment_date;
					$user->card_error = $card_error;
					$user->is_active = 1;
					$user->save();

					// Create user analytics object
					$analytics = new UserAnalytics;
					$analytics->user_id = $user->id;
					$analytics->number_of_logins = 0;
					$analytics->number_of_impressions = 0;
					$analytics->number_of_signups = 0;
					$analytics->number_of_ideas = 0;
					$analytics->number_of_idea_edits = 0;
					$analytics->number_of_landing_pages = 0;
					$analytics->number_of_landing_page_edits = 0;
					$analytics->onboard = 0;
					$analytics->save();

					// Update the plan
					$plan->signups = $plan->signups + 1;
					$plan->save();

					// Send out the welcome email
					$this->welcome_email($data->first_name, $data->last_name, $data->email);

					// Set session variables
					Session::put('logged_in', true);
					Session::put('user_id', $user->id);

					return "Success";
				} catch (Exception $e) {
					return "unable to sign up customer:" . $data->stripeEmail . ", error:" . $e->getMessage();
				}
			} else {
				return "Duplicate email";
			}
		}	
	}

	public function welcome_email($first_name, $last_name, $email) {
		$body = "<p>Welcome to the OptinDev beta. Glad to have you here!</p>";
		$body .= "<p>The first thing you should do if you haven't already is to go through the on-boarding process and get started off by creating a Value Idea and an opt-in page to go along with it.</p>";
		$body .= "<p>If you're not sure what a Value Idea is, don't worry, basically all that it means is an idea to give value. So for example, if you were knowledgeable about cars, you can give value in the form of teaching how to repair your car. That would be a Value Idea.</p>";
		$body .= "<p>If you have any questions, reply back to this email or use our contact form!</p>";

		$data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "header_text" => "Welcome",
            "body" => $body,
            "email" => $email
        );

        Mail::send('emails.notification', $data, function($message) use ($data) {
            $message->to($data["email"], $data["first_name"] . " " . $data["last_name"])
                    ->subject('👋🏽 Welcome to OptinDev 👋🏽');
            $message->from('optindev@gmail.com','OptinDev');
        });
	}


}
