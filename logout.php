<?php
	require_once('Classes/Authentication.php');

	if(!isset($_SESSION)){
        session_start();
    }

    Authentication::logout();

?>