<?php

function formatDate($date) {
	return date('F j, Y', strtotime($date));
}

function urlFormat($str) {
	//Strip whitespace
	$str = trim($str);
	//Converts string to lowercase
	$str = strtolower($str);
	//Use  urlencode
	$str = urlencode($str);
	return $str;
}

/*
 * Add classname active if category is active
 */
function is_active($category){
		if(isset($_GET['category'])){
			if($_GET['category'] == $category){
				return 'active';
			} else {
				return '';
			}
		} else {
			if($category == null){
				return 'active';
			}
		}
}