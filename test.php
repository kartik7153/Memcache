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
	$mc = new Memcache;
	$mc->connect('localhost',12111);
	$newid = $_GET[Id];
	//$newid = 1;
	$val = strval($newid);
	$val = "NGO".$val;
	$db_selected = mysql_select_db('testexample', $conn);
	echo $val;
	/*print ("$newid");
	echo ("Here");
	$db_selected = mysql_select_db('testexample', $conn);
	$newquery = "select text from updates where uid = $newid"; 
	$result = $conn->query($newquery);
	var_dump($newquery);
	var_dump($result);
	echo "<br>";
	die();*/	
	$mcd = array();
	$memresult = $mc->get($val);
	var_dump($memresult);
	if ($memresult)
	{
		echo "Taking from the cache\n";
		var_dump(($memresult));
	}
	else
	{
		$newquery = "select text from updates where uid = $newid";
		$result = $conn->query($newquery);
		if ($result->num_rows > 0) 
		{
    			while($row = $result->fetch_assoc()) 
			{
        			echo "Text " . $row["text"]. "<br>";
				$mcd[] = $row;
    			}
			$mc->set($val,serialize($mcd),0,0);
		} 
		else 
		{
    			echo "0 results";
		}
	}
	$conn->close();
?>
