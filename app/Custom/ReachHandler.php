<?php

namespace App\Custom;

use App\Reach;
use App\LandingPage;
use App\Idea;
use App\LandingPageRef;

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

	public function increaseReachForRef($ref) {
		if ($this->needToIncreaseReach() == true) {
			// Check to see if record exists
			if (LandingPageRef::where('landing_page_id', $landing_page_id)->count() > 0) {
				// Rows exist for landing page, now let's check for the specific ref tag
				if (LandingPageRef::where('landing_page_id', $landing_page_id)->where('ref_source', $ref)->count() > 0) {
					// Yes, exists, simply have to edit
					$landing_page_ref = LandingPageRef::where('landing_page_id', $landing_page_id)->where('ref_source', $ref)->first();
					$landing_page_ref->reach = $landing_page_ref->reach + 1;
					$landing_page_ref->save();
				} else {
					// No, create it
					$landing_page_ref = new LandingPageRef;
					$landing_page_ref->landing_page_id = $this->landing_page_id;
					$landing_page_ref->ref_source = $ref;
					$landing_page_ref->reach = 1;
					$landing_page_ref->save();
				}
			} else {
				// No, create it
				$landing_page_ref = new LandingPageRef;
				$landing_page_ref->landing_page_id = $this->landing_page_id;
				$landing_page_ref->ref_source = $ref;
				$landing_page_ref->reach = 1;
				$landing_page_ref->save();
			}
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

	private function recordIPTransaction() {
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