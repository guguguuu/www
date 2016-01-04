<?php
echo 'sdfsdfsadf';
$conn=mysql_connect("localhost","root","xdvi213");

mysql_select_db("test");

mysql_query("set names utf8");

$username="user1";
$password="123";

$sql="insert into y1(username,password) values('{$username}','{$password}')";
echo $sql;
var_dump(mysql_query($sql));

mysql_close($conn);
?>
