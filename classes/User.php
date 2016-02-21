<?php

class User {

private $db;

public function __construct() {

	$this->db = new Database;
}

//Input Data in DB to register user
	public function registerUser($data) {
		$sql = 'INSERT INTO 
				users(name, email, profile, username, password, about, last_activity)
				VALUES
				(:name, :email, :profile, :username, :password, :about, :last_activity)
				';
		$this->db->query($sql);
		//Bind values
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':profile', $data['profile']);
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':about', $data['about']);
		$this->db->bind(':last_activity', $data['last_activity']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

// Upload User Avatar
	 
	public function uploadUser(){
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["profile"]["name"]);
		$extension = end($temp);
		if ((($_FILES["profile"]["type"] == "image/gif")
				|| ($_FILES["profile"]["type"] == "image/jpeg")
				|| ($_FILES["profile"]["type"] == "image/jpg")
				|| ($_FILES["profile"]["type"] == "image/pjpeg")
				|| ($_FILES["profile"]["type"] == "image/x-png")
				|| ($_FILES["profile"]["type"] == "image/png"))
				&& ($_FILES["profile"]["size"] < 1000000)
				&& in_array($extension, $allowedExts)) {
			if ($_FILES["profile"]["error"] > 0) {
				redirect('register.php', $_FILES["profile"]["error"], 'error');
			} else {
				if (file_exists("images/" . $_FILES["profile"]["name"])) {
					redirect('register.php', 'File already exists', 'error');
				} else {
					move_uploaded_file($_FILES["profile"]["tmp_name"],
					"images/" . $_FILES["profile"]["name"]);
					
					return true;
				}
			}
		} else {
			redirect('register.php', 'Invalid File Type!', 'error');
		}
	}

	/*
	 * User Login
	 */
	public function login($username, $password){
		$this->db->query("SELECT * FROM users
									WHERE username = :username
									AND password = :password			
		");
		
		//Bind Values
		$this->db->bind(':username', $username);
		$this->db->bind(':password', $password);
		
		$row = $this->db->single();

		//Check Rows
		if($this->db->rowCount() > 0){
			$this->setUserData($row);
			return true;
		} else {
			return false;
		}
	}
	
	/*
	 * Set User Data
	 */
	private function setUserData($row){
		$_SESSION['is_logged_in'] = true;
		$_SESSION['user_id'] = $row->id;
		$_SESSION['username'] = $row->username;
		$_SESSION['name'] = $row->name;
	}
	
	/*
	 * User Logout
	*/
	public function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['name']);
		return true;
	}
	
	/*
	 * Get Total # Of Users
	 */
	public function getTotalUsers(){
		$this->db->query('SELECT * FROM users');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
}