<?php
	$servername = "localhost";
	$username = "root";
	$password = "root123";

// Create connection
	$conn = new mysqli($servername, $username, $password,"testexample");

// Check connection
	if ($conn->connect_error) 
	{
   		 die("Connection failed: " . $conn->connect_error);
	}	 
	//echo "Connected successfully";
	
	//echo ("Hey");

	$newid = $_GET[Id];
	print ("$newid");
	//echo ("Here");
	//$db_selected = mysql_select_db('testexample', $conn);
	$newquery = "select text from updates where uid = $newid"; 
	$result = $conn->query($newquery);
	var_dump($newquery);
	var_dump($result);
	echo "<br>";
	//die();	
	if ($result->num_rows > 0) 
	{
    		while($row = $result->fetch_assoc()) 
		{
        		echo "Text " . $row["text"]. "<br>";
    		}
	} 
	else 
	{
    		echo "0 results";
	}
	$conn->close();
?>
