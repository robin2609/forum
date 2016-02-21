<?php include('core/init.php'); ?>
<?php

//Get Topic 
$topic = new Topic;

//Get category from URL
$category = isset($_GET['category']) ? $_GET['category'] : null;

//Get user from URL
$user_id = isset($_GET['user']) ? $_GET['user'] : null;

//Get Template
$template = new Template('templates/topics.php');

//Assign Topics to template object
if(isset($category)){
	$template->topics = $topic->getByCategory($category);
	$template->title = 'Posts In "'.$topic->getCategory($category)->name.'"';
}

//Check if user exists
if(isset($user_id)){
	$template->topics = $topic->getByUser($user_id);
	$template->title = 'Posts In "'.$topic->getUser($user_id)->username.'"';
} 
// If user_id or category is not set
if(!isset($user_id) && !isset($category)) {
	$template->topics = $topic->getTopics();
}

$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

//Display template
print $template;

