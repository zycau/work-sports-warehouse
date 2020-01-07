<?php
	require_once('Classes/Authentication.php');

	$result = Authentication::createUser('admin','password');

	if($result){
		echo 'User created: admin & password';
	}else{
		echo 'Something wrong happened.';
	}


?>