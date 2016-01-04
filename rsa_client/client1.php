<?php
error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";
include "rsa.php";
$port = 1935;
$ip = "127.0.0.1";

/*
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
 */

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "OK.\n";
}

echo "Trying to connect '$ip' port '$port'...\n";

$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
}else {
    echo "connect OK\n";
}
	$a = isset($_GET['a']) ? $_GET['a'] : 'test123';  

	$pubfile='cert_c.pem';
	$prifile='key_c.pem';
	$u= new RSA($pubfile,$prifile);
	$encrypt_c2s = $u->encrypt($a);

if(!socket_write($socket, $encrypt_c2s, strlen($encrypt_c2s))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo $encrypt_c2s;
}
	
	$pubfile = 'cert_c.pem';
	$prifile = 'key_c.pem';  
    	$m = new RSA($pubfile, $prifile);  

while($encrypt_s2c = socket_read($socket, 8192)) {
    echo $encrypt_s2c;
    $decrypt_s2c = $m->decrypt($encrypt_s2c);  
    var_dump($decrypt_s2c);  
    break;
}
    
if($decrypt_s2c!=$a){
echo "y!=a...\n";
socket_close($socket);
echo "关闭OK\n";
}else{
	echo "connecting....";
}

?>
