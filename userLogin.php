<?php
//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();

//default messages
$response["success"] = 0;
$response["username_error"] = "null";
$response["password_error"] = "null";


//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);

//Make sure a username and password are entered
if(isset($_POST['username']) && isset($_POST['password'])){
	
	//Load the bean of the username given by the user
	$user_result = R::findOne('users', 'username = ?', array($_POST['username']));

	//If the result is null, the username doesn't exist
	if($user_result == null){
		$response["success"] = 0;
		$response["username_error"] = "Username does not exist";
	}
	
	//If the username exists, check that the password is correct
	else{
		$response["username_error"] = "Username exists";
		
		//grab the password from the loaded bean
		$pw = $user_result->password;
		
		//Verify the password and updated the corresponding message.
		if(password_verify($_POST['password'], $pw)){
			$response["success"] = 1;
			$response["password_error"] = "Correct password";	
		}
		
		else{
			$response["success"] = 0;
			$response["password_error"] = "Incorrect password";
		}
	}
}

//Disconnect from the db and enconde the response.
R::close();
echo json_encode($response);

?>