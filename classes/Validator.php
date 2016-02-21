<?php


class Validator {

	public function __construct() {

	}

	//Check for required fields

	public function isRequired($field_array) {
		foreach($field_array as $field) {
			if($_POST[''.$field.''] == '') {
				return false;
			}
		}
		return true;
	}

	//Validate Email

	public function isValidEmail($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	//Check if password matches
	public function passwordsMatch($pw1, $pw2) {
		if($pw1 == $pw2) {
			return true;
		} else {
			return false;
		}
	}
}