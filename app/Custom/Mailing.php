<?php

namespace App\Custom;

use Mail;

class Mailing {
	/* Global variables */
	protected $mail_template;
	protected $to;
	protected $subject;
	protected $first_name;
	protected $last_name;
	protected $body;
	protected $header_text;

	public function __construct($mail_template = "notification", $to = "", $subject = "", $first_name = "", $last_name = "", $body ="", $header_text = "") {
		$this->mail_template = $mail_template;
		$this->to = $to;
		$this->subject = $subject;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->body = $body;
		$this->header_text = $header_text;
	}

	public function setTo($to) {
		$this->to = $to;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
	}

	public function setFirstName($first_name) {
		$this->first_name = $first_name;
	}

	public function setLastName($last_name) {
		$this->last_name = $last_name;
	}

	public function setBody($body) {
		$this->body = $body;
	}

	public function setHeaderText($header_text) {
		$this->header_text = $header_text;
	}

	public function send() {
		// Create path
		$mail_template_path = 'emails.' . $this->mail_template;

		// Email data
		$data = array(
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'subject' => $this->subject,
			'header_text' => $this->header_text,
			'body' => $this->body,
			'email' => $this->to
		);

		Mail::send($mail_template_path, $data, function($message) use ($data) {
			$message->to($data["email"], $data["first_name"] . " " . $data["last_name"])->subject($data["subject"]);
			$message->from(env('MAIL_USERNAME', 'optindev@gmail.com'), 'OptinDev');
		});
	}

}

?>