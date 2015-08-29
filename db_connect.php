<?php
 
/**
 * Connect to database
 */
class DB_CONNECT {
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Connecting to mysql database
        // Deprecated: $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
        // Deprecated: $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());
		$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
 
        if(!$con) // == null if creation of connection object failed
		{ 
			// report the error to the user, then exit program
			die("Connection object not created: ".mysqli_error($con));
		}

		if(mysqli_connect_errno())  // returns false if no error occurred
		{ 
			// report the error to the user, then exit program
			die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
		}
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        mysqli_close();
    }
 
}
 
?>