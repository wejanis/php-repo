<?php 
require 'rb.php';

$response = array();

if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['verifypassword']))
{
	$id = -1;
	R::setup( 'mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
	$user = R::dispense('users');
	$user->name = $_POST['name'];
	$user->username = $_POST['username'];
	$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$id = R::store($user);
	
	if($id != -1)
	{
		$response["success"] = 1;
		$response["message"] = "Account successfully created.";
		echo json_encode($response);
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Failed to create account.";
		echo json_encode($repsonse);
	}
	echo("Created new user: " . $user->username);
	R::close();
}

else{
	$response["success"] = 0;
	$response["message"] = "A required field is missing!";
	echo json_encode($response);
}
?>