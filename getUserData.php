<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);

$username = $_GET['username'];
$date = $_GET['exercise_date'];

$username_result = R::findOne('user', 'username = ?', array($username));

$user_id = $username_result->getId();

$exercises = R::getAll( 
	'select id, exercise_name, weight, reps, exercise_complete 
	 from exercises 
	 where user_id = :user_id AND exercise_date = :date', 
	 array(':user_id' => $user_id,':date' => $date)
	);

echo json_encode($exercises);

?>