<?php 

//Using RedBean object relational mapper to query the database.
require 'rb.php';

//array for json response
$response = array();
$response["success"] = 0;

//Connect to database using redbean
R::setup('mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );
//R::debug(true);


if(isset($_POST['delete_id']))
{
	$id = intval($_POST['delete_id']);
	
	$exercise = R::load('exercises', $id);
	R::trash($exercise);
	$response["success"] = 1;
	
}
else{
	$response["success"] = 0;
}

R::close();
echo json_encode($response);

?>