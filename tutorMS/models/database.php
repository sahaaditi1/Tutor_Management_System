<?php
	 $serverName="localhost";
	 $userName="root";
	 $password="";
	 $dbName="tutor";
	function execute($query) //executing non query
	{
		$conn = mysqli_connect("localhost","root", "", "tutor");
		$res = mysqli_query($conn,$query);
		mysqli_close($conn);
		return $res;
	}

	function executeInsert($query) //executing non query
	{
		$conn = mysqli_connect("localhost","root", "", "tutor");
		$id=0;
		if(mysqli_query($conn,$query))
		{
			$id=mysqli_insert_id($conn);
		}
		mysqli_close($conn);
		return $id;
	}
	
	function get($query)
	{   
        $data=array();//numeric array
		global $serverName,$userName,$password,$dbName;
		// $conn = mysqli_connect( $serverName, $userName, $password, $dbName);
		$conn = mysqli_connect("localhost","root", "", "tutor");
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $entity=array();//associative array
                foreach($row as $k=>$v)           
                {
                    $entity[$k] = $row[$k];    
                }
                $data[] = $entity;																
            }
        }
        else return false;
        
        mysqli_close($conn);
        
		return $data;
	}
	
	
?>