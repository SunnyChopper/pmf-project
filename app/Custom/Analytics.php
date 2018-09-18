<?php
	
namespace App\Custom;
use App\UserAnalytics;

class Analytics {
	protected $user_id;

	public function __construct($user_id) {
		$this->user_id = $user_id;
	}

	public function getNumberOfLogins() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_logins;
	}

	public function getNumberOfImpressions() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_impressions;
	}

	public function getNumberOfSignups() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_signups;
	}

	public function getNumberOfIdeas() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_signups;
	}

	public function getNumberOfIdeaEdits() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_idea_edits;
	}

	public function getNumberOfLandingPages() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_landing_pages;
	}

	public function getNumberOfLandingPageEdits() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		return $user_analytics->number_of_landing_page_edits;
	}

	public function doesUserNeedOnboarding() {
		$user_analytics = UserAnalytics::where('user_id', $this->user_id)->first();
		switch($user_analytics->onboard) {
			case 0:
				return true;
				break;
			case 1:
				return false;
				break;
			case 2:
				return false;
				break;
			default:
				return true;
				break;
		}
	}
}

?>