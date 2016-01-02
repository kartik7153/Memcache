<?php
	define('MEMCACHED_HOST', '127.0.0.1');
	define('MEMCACHED_PORT', '11211');
 
        //$this-> objCache = new Memcached();
	//Connection Cache creation
	if (class_exists('Memcache')) {
            $memcache = new Memcache();
           	echo "Class";
		die();
            if(!$memcache->connect('localhost', 11211)) {
                  $memcache->connect('localhost', 11211);
            }
        } else {
		die("class not exist");
	}	
	//$memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);
	
	$servername = "localhost";
	$username = "root";
	$password = "root123";

	// Create DB connection
	$conn = new mysqli($servername, $username, $password,"testexample");
	// Check connection
	if ($conn->connect_error) 
	{
   		 die("Connection failed: " . $conn->connect_error);
	}	 
	echo "Connected successfully";
	die();
	$newid = $_GET[Id];

	/*$newquery = "select text from updates where uid = $newid"; 
	$result = $conn->query($newquery);
	var_dump($newquery);
	var_dump($result);
	echo "<br>";
	//die();*/
	$getresult = $memcache->get(1);
	if ($getresult)	
	{
		var_dump($getresult)
		/*if ($getresult->num_rows > 0) 
		{
    			while($row = $result->fetch_assoc()) 
			{
       		 		echo "Text " . $row["text"]. "<br>";
    			}
		}*/
	}	 
	else 
	{
		echo ("Fetching from the database\n");
		$newquery = "select text from updates where uid = $newid"; 
    		$result = $conn->query($newquery);
		var_dump($result);
		$memcache->set($newid,$result);
		if ($result->num_rows > 0)
                {
                        while($row = $result->fetch_assoc()) 
                        {
                                echo "Text " . $row["text"]. "<br>";
                        }
                }
		else
		{
			echo "0 Results";
		}
	}
	$conn->close();

?>
