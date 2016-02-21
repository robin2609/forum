<?php include('core/init.php'); ?>
<?php

//Get Topic object
$topic = new Topic;

//Get ID from url
$topic_id = $_GET['id']; 

//Get Template
$template = new Template('templates/thetopic.php');

//Set vars
$template->topic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);
$template->title = $topic->getTopic($topic_id)->title;

//Display template
print $template;