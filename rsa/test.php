<?php  
header('Content-Type:text/html;Charset=utf-8;');  
  
include "rsa.php";  
  
echo '<pre>';  
$a = isset($_GET['a']) ? $_GET['a'] : 'test123';  
//////////////////////////////////////  
$pubfile = 'cert.pem';  
$prifile = 'key.pem';  
  
$m = new RSA($pubfile, $prifile);  
$x = $m->sign($a);  
$y = $m->verify($a, $x);  
var_dump($x, $y);  
  
  
$x = $m->encrypt($a);  
$y = $m->decrypt($x);  
var_dump($x, $y); 
