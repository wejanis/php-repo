<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;
//$response["message"] = "A required field is missing!";
$response["username_error"] = "No error";

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );

if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']))
{
	$username_result = array();
	$username_result = R::find('users', 'username = ?', array($_POST['username']));
	
	if(!empty($username_result))
	{
		$response["success"] = 0;
		$response["username_error"] = "Username already exists.";
	}

	else{
		$id = -1;	
		
		//Create a user "bean" with information from the post request and store it in the database
		$user = R::dispense('users');
		$user->name = $_POST['name'];
		$user->username = $_POST['username'];
		$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$id = R::store($user); //store returns the id
		
		//If the id has changed, the bean was successfully stored.
		if($id != -1)
		{
			$response["success"] = 1;
			//$response["message"] = "Account successfully created!";
		}
		//Otherwise, the bean failed to store
		else{
			$response["success"] = 0;
			//$response["message"] = "Failed to create account.";
		}

		R::close();
	}
}

echo json_encode($response);

?>