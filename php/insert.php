<?php
header("connect-type:text/html;charset=utf-8");

$conn=@mysql_connect("localhost","root","xdvi213");

@mysql_select_db("test");

mysql_query("set name as utf8");

$username=$_POST['username'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];


if($password===$repassword){
	$sql="insert into users(username,password) values('{$username}','{$password}')";
	if(mysql_query($sql)){
		echo "<script>alert('success')</script>";
		echo "<script>location='log.html'</script>";
	}else{
		echo "<script>alert('error')</script>";
		echo "<script>location='reg.html'</script>";
	}
}
else{
	echo "<script>alert('error')</script>";
	echo "<script>location='reg.html'</script>";
}
?>
