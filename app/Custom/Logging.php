<?php

namespace App\Custom;

use Storage;

class Logging {
	/* Global variables */
	protected $master_log_filename = "master_log.txt";
	protected $user_log_filename;
	protected $user_id;

	/* Constructor */
	public function __construct($user_id) {
		$this->user_id = $user_id;
		$this->user_log_filename = "user_" . $user_id . "_log.txt";
	}

	/* Public functions */
	public function insert($newline) {
		// Create newline with time
		date_default_timezone_get('America/Chicago');
		$now = date('Y-m-d H:i:s');
		$newline = "[" . $now . "] - " . $newline;

		// Start to insert
		$this->insertIntoMasterLog($newline);
		$this->insertIntoUserLog($newline);
	}

	/* Private functions */
	private function insertIntoMasterLog($newline) {
		// Check to see if master log exists
		if (!$this->does_file_exist('local', $this->master_log_filename)) {
			// Does not exist, let's create the file
			Storage::put($this->master_log_filename, $newline . "\r\n");
		} else {
			// Exists, let's get the contents and insert the new line
			$file_contents = Storage::disk('local')->get($this->master_log_filename);
			$file_contents .= $newline . "\r\n";
			Storage::put($this->master_log_filename, $file_contents);
		}
	}

	private function insertIntoUserLog($newline) {
		// Check to see if user log directory exists
		$user_directory = 'user/' . $this->user_id . '/logs';
		if (!$this->does_directory_exist('local', $user_directory)) {
			Storage::disk('local')->makeDirectory($user_directory);
		}

		// Check to see if user log file exists
		if (!$this->does_file_exist('local', $user_directory . "/" . $this->user_log_filename)) {
			Storage::put($user_directory . "/" . $this->user_log_filename, $newline . "\r\n");
		} else {
			// Exists, let's get the contents and insert the new line
			$file_contents = Storage::disk('local')->get($user_directory . "/" . $this->user_log_filename);
			$file_contents .= $newline . "\r\n";
			Storage::put($user_directory . "/" . $this->user_log_filename, $file_contents);
		}
	}

	private function does_directory_exist($target, $dir) {
		return Storage::disk($target)->has($dir);
	}

	private function does_file_exist($target, $path) {
		return Storage::disk($target)->has($path);
	}

}