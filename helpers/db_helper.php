<?php

//Count # of replies for every topic
	function replyCount($topic_id) {
		$db = new Database;
		$sql = "SELECT * FROM replies 
				WHERE topic_id = :topic_id
				";	
		$db->query($sql);
		$db->bind(':topic_id', $topic_id);
		
		//Assign results
		$rows = $db->resultset();
		//Count results
		return $db->rowCount();
	}

	/*
 *	Get Categories
 */
function getCategories(){
	$db = new Database;
	$sql = "SELECT * FROM categories";
	$db->query($sql);
	
	//Assign Result Set
	$results = $db->resultset();

	return $results;
}

/*
 * User Posts
 */
function userPostCount($user_id){
	$db = new Database;
	$sql = "SELECT * FROM topics WHERE user_id = :user_id";
	$db->query($sql);
	
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	$topic_count = $db->rowCount();
	
	$db->query('SELECT * FROM replies
				WHERE user_id = :user_id
				');
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	$reply_count = $db->rowCount();
	return $topic_count + $reply_count;
}