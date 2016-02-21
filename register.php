<?php include('core/init.php'); ?>
<?php

//Create new Topic object
$topic = new Topic;

//Create User object
$user = new User;

//Create Validator object
$validator = New Validator;

if(isset($_POST['register'])) {
	//Create POST array
	$data['name'] = $_POST['name'];
	$data['email'] = $_POST['email'];
	$data['username'] = $_POST['username'];
	$data['password'] = md5($_POST['password']);
	$data['password2'] = md5($_POST['password2']);
	$data['about'] = $_POST['about'];
	$data['last_activity'] = date("Y-m-d H:i:s");

		//Required Fields
	$field_array = array('name','email','username','password','password2');
	
	if($validator->isRequired($field_array)){
		if($validator->isValidEmail($data['email'])){
			if($validator->passwordsMatch($data['password'],$data['password2'])){
					//Upload Avatar Image
					if($user->uploadUser()){
						$data['profile'] = $_FILES["profile"]["name"];
					}else{
						$data['profile'] = 'noimage.jpg';
					}
					//Register User
					if($user->registerUser($data)){
						redirect('index.php', 'You are registered and can now log in', 'success');
					} else {
						redirect('index.php', 'Something went wrong with registration', 'error');
					}
			} else {
				redirect('register.php', 'Your passwords did not match', 'error');
			}
		} else {
			redirect('register.php', 'Please use a valid email address', 'error');
		}
	} else {
		redirect('register.php', 'Please fill in all required fields', 'error');
	}

}

//Get Template
$template = new Template('templates/register.php');


//Display template
print $template;