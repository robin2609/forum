<?php

class Topic {
	//Declare vars
	private $db;

	/*
	* Constructor
	*/

	public function __construct() {
		$this->db = new Database;

	}

	/*
	*Get all Topics
	*/

	public function getTopics() {
		$sql = "SELECT topics.*, users.username, users.profile, categories.name FROM topics
				INNER JOIN users
				ON
				topics.user_id = users.id
				INNER JOIN categories
				ON
				topics.category_id = categories.id
				ORDER BY create_date DESC
				";

		 $this->db->query($sql);

		//Assign results to var

		$results = $this->db->resultset();

		return $results;
	}

	//Get Total count of topics

	public function getTotalTopics() {
		$sql = "SELECT * FROM topics";
		$this->db->query($sql);
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

	//Get Total count of categories

	public function getTotalCategories() {
		$sql = "SELECT * FROM categories";
		$this->db->query($sql);
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

	//Get Total count of replies

	public function getTotalReplies($topic_id) {
		$sql = "SELECT * FROM replies
				WHERE topic_id = :topic_id";
		$this->db->query($sql);
		$db->bind(':topic_id', $topic_id);
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

	public function getByCategory($category_id){
		$sql = "SELECT topics.*, categories.*, users.username, users.profile FROM topics
				INNER JOIN categories
				ON topics.category_id = categories.id
				INNER JOIN users
				ON topics.user_id=users.id
				WHERE topics.category_id = :category_id
				";
		$this->db->query($sql);
		$this->db->bind(':category_id', $category_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}


	
	 // Get Category By ID
	
	public function getCategory($category_id){
		$sql = "SELECT * FROM categories WHERE id = :category_id";
		$this->db->query($sql);
		$this->db->bind(':category_id', $category_id);
	
		//Assign Row
		$row = $this->db->single();
	
		return $row;
	}


	// Get Topic By ID
	public function getTopic($id) {
		$sql = "SELECT topics.*, users.username, users.name, users.profile FROM topics
				INNER JOIN users
				ON topics.user_id = users.id
				WHERE topics.id = :id";

		$this->db->query($sql);

		$this->db->bind(':id', $id);

		//Assign result
		$result = $this->db->single();

		return $result;
	}

	// Get Topic Replies
	 
	public function getReplies($topic_id){
		$this->db->query("SELECT replies.*, users.* FROM replies
						INNER JOIN users
						ON replies.user_id = users.id
						WHERE replies.topic_id = :topic_id 
						ORDER BY create_date ASC	
		");
		$this->db->bind(':topic_id', $topic_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}


	//Get Topics by user
	public function getByUser($user_id){
		$sql = "SELECT topics.*, categories.*, users.username, users.profile FROM topics
				INNER JOIN categories
				ON topics.category_id = categories.id
				INNER JOIN users
				ON topics.user_id= users.id
				WHERE users.id = :user_id
				";
		$this->db->query($sql);
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}	

		// Get Topic By user
	public function getUser($user_id) {
		$sql = "SELECT topics.*, users.username, users.name, users.profile FROM topics
				INNER JOIN users
				ON topics.user_id = users.id
				WHERE topics.id = :user_id";

		$this->db->query($sql);

		$this->db->bind(':user_id', $user_id);

		//Assign result
		$result = $this->db->single();

		return $result;
	}

}