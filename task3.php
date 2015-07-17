<!DOCTYPE html>
<html>
<head>
<title>Delta SysAd task 3</title>
</head>
<body>
<h1 style="text-align:center">Hello!</h1>
<?php 
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $conn = new mysqli("localhost","root","");
    $conn->query("CREATE DATABASE ipstore");
    $conn->query("USE ipstore");
    $conn->query("CREATE TABLE IP(ipadresses varchar(16))");
    $hits=mysqli_fetch_array($conn->query("SELECT COUNT(*) FROM IP"));
    echo "Number of Hits : ".((int)$hits[0]+1); //plus one because IP address is added only after this statement
    if($conn->query("INSERT INTO IP VALUES('".$ip."')")===TRUE)
    {
    	$table=(mysqli_query($conn,"SELECT * FROM IP"));
        echo "<table style='border:1px solid black'>";
        echo "<tr>";
        echo "<th>IP Addresses</th>";
        while($row=mysqli_fetch_array($table))
        {
        	echo "<tr>";
        	echo "<td>".$row['ipadresses']."</td>";
        	echo "</tr>";
        }
        echo "</table>";
    }
    $conn->close();
?>
</body>
</html>