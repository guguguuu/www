<?php 
@mysql_connect("localhost", "root","xdvi213")  
or die("failed to connect database"); 
@mysql_select_db("test")  
or die("database cannot be used"); 
$username = $_POST['username']; 
$password = $_POST['password']; 
$query = @mysql_query("select username, userflag from users " 
."where username = '$username' and password = '$password'") 
or die("failed to excute sql command"); 
if($row = mysql_fetch_array($query)) 
{ 
session_start();  
if($row['userflag'] == 1 or $row['userflag'] == 0) 
{ 
$_SESSION['username'] = $row['username']; 
$_SESSION['userflag'] = $row['userflag']; 
echo "<a href='main.php'>Welcome click there to to index page</a>"; 
} 
else  
{ 
echo "Permission denied"; 
} 
} 
else  
{ 
echo "<script>alert('account does not exist or wrong password')</script>";
echo "<script>location='log.html'</script>";
} 
?>
