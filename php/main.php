<?php 
session_start(); 
if(isset($_SESSION['username'])) 
{ 
@mysql_connect("localhost", "root","xdvi213")  
or die("failed to connect database"); 
@mysql_select_db("test")  
or die("database cannot be used"); 
$username = $_SESSION['username']; 
$query = @mysql_query("select userflag from users " 
."where username = '$username'") 
or die("failed to execute sql command"); 
$row = mysql_fetch_array($query); 
if($row['userflag'] != $_SESSION['userflag']) 
{ 
$_SESSION['userflag'] = $row['userflag']; 
} 
if($_SESSION['userflag'] == 1) 
echo "Welcome admin! ".$_SESSION['username']." login system"; 
if($_SESSION['userflag'] == 0) 
echo "Welcome user! ".$_SESSION['username']." login system"; 
echo "<a href='logout.php'> logout</a>"; 
} 
else 
{ 
echo "Permission denied"; 
} 
?>
