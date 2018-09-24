<?php

namespace App\Custom;

use App\Reach;
use App\LandingPage;
use App\Idea;

class ReachHandler {
	/* Global variables */
	protected $landing_page_id;
	protected $ip_address;

	/* Constructor */
	public function __construct($landing_page_id, $ip_address) {
		$this->landing_page_id = $landing_page_id;
		$this->ip_address = $ip_address;
	}

	/* Public functions */
	public function increaseReach() {
		if ($this->needToIncreaseReach() == true) {
			$this->increaseReachForLandingPage();
			$this->increaseReachForIdea();
			$this->recordIPTransaction();
		}
	}

	/* Private functions */
	private function needToIncreaseReach() {
		$can_find_ip = Reach::where('ip_address', $this->ip_address)->count();
		if ($can_find_ip > 0) {
			$can_find_landing_page = Reach::where('landing_page_id', $this->landing_page_id)->count();
			if ($can_find_landing_page > 0) {
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	private function recordIPTransaction($ip_address) {
		$reach = new Reach;
		$reach->ip_address = $this->ip_address;
		$reach->landing_page_id = $this->landing_page_id;
		$reach->save();
	}

	private function increaseReachForLandingPage() {
		$landing_page = LandingPage::where('id', $this->landing_page_id)->first();
		$landing_page->reach = $landing_page->reach + 1;
		$landing_page->save();
	}

	private function increaseReachForIdea() {
		$landing_page = LandingPage::where('id', $this->landing_page_id)->first();
		$idea = Idea::where('id', $landing_page->idea_id)->first();
		$idea->reach = $idea->reach + 1;
		$idea->save();
	}
}
	
?>