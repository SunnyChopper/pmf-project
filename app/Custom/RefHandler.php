<?php

namespace App\Custom;

use App\LandingPageRef;

class RefHandler {
	/* Global variables */
	protected $landing_page_id;
	protected $ref;

	/* Constructor */
	public function __construct($landing_page_id, $ref) {
		$this->landing_page_id = $landing_page_id;
		$this->ref = $ref;
	}

	/* Public functions */
	public function createRefImpression() {
		if ($this->doesRefExist() == true) {
			$this->createImpression();
		} else {
			// Create it first
			$this->createRef();
			$this->createImpression();
		}
	}

	public function createRefSignup() {
		if ($this->doesRefExist() == true) {
			$this->createSignup();
		} else {
			// Create it first
			$this->createRef();
			$this->createSignup();
		}
	}

	/* Private functions */
	private function createImpression() {
		$ref = $this->getRef();
		$ref->impressions = $ref->impressions + 1;
		$ref->save();
	}

	private function createSignup() {
		$ref = $this->getRef();
		$ref->signups = $ref->signups + 1;
		$ref->save();
	}

	private function doesRefExist() {
		if (LandingPageRef::where('landing_page_id', $this->landing_page_id)->count() > 0) {
			if (LandingPageRef::where('landing_page_id', $this->landing_page_id)->where('ref_source', $this->ref)->count() > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	private function createRef() {
		$landing_page_ref = new LandingPageRef;
		$landing_page_ref->landing_page_id = $this->landing_page_id;
		$landing_page_ref->ref_source = $this->ref;
		$landing_page_ref->reach = 0;
		$landing_page_ref->impressions = 0;
		$landing_page_ref->signups = 0;
		$landing_page_ref->save();
	}

	private function getRef() {
		return LandingPageRef::where('landing_page_id', $this->landing_page_id)->where('ref_source', $this->ref)->first();
	}
}

?>