<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	public function test(Request $data) {
		// Be sure to replace this with your actual test API key
		// (Switch to the live key later)
		\Stripe\Stripe::setApiKey("sk_test_skdi9fJ5e8Q9t1hGa1jUZDfX");

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
				'plan' => 'plan_DXo8PQEzNADNjk',
				'trial_period_days' => 14
			));

			// Redirect
			return redirect(url('/dashboard/'));
		} catch (Exception $e) {
			echo("unable to sign up customer:" . $_POST['stripeEmail']. ", error:" . $e->getMessage());
		}
	}

	public function create_charge(Request $data) {
		// Be sure to replace this with your actual test API key
		// (Switch to the live key later)
		\Stripe\Stripe::setApiKey("sk_test_skdi9fJ5e8Q9t1hGa1jUZDfX");

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
				'plan' => 'plan_DXo8PQEzNADNjk',
				'trial_period_days' => 14
			));

			// Redirect
			return redirect(url('/dashboard/'));
		} catch (Exception $e) {
			echo("unable to sign up customer:" . $_POST['stripeEmail']. ", error:" . $e->getMessage());
		}
	}
}
