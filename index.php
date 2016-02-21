<?php include('core/init.php'); ?>
<?php

//Get Topic 
$topic = new Topic;

//Get Template
$template = new Template('templates/frontpage.php');

//Assign Topics to template object
$template->topics = $topic->getTopics();
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();


//Display template
print $template;