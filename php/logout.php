<?php 
session_start();
unset($_SESSION['username']); 
unset($_SESSION['password']); 
unset($_SESSION['userflag']); 
echo "logout success"; 
echo "<a href='log.html'> back to login page</a>"
?>
