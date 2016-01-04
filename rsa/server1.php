<?php
set_time_limit(0);
include "rsa.php";
$ip = '127.0.0.1';
$port = 1935;

/*
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {

    $a = isset($_GET['a']) ? $_GET['a'] : 'test123';  

	$pubfile1='cert_s.pem';
	$prifile1='key_s.pem';
	$g = new RSA($pubfile1,$prifile1);
	$encrypt_s2c = $g->encrypt($a);

    if(!socket_write($msgsock, $encrypt_s2c, strlen($encrypt_s2c))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "$encrypt_s2c";
}


while($encrypt_c4s = socket_read($msgsock,8192)){
	echo "received client cert\n";
	echo "encryption content is:$encrypt_c2s";
	}
        $prifile='key_s.pem';
	$m = new RSA($pubfile,$prifile);
	$decrypt_c2s= $m->decrypt($encrypt_c2s);
	var_dump($decrypt_c2s);
        if($a=!$decrypt_c2s){
            break;
        };
    }
    socket_close($msgsock);

} while (true);

socket_close($sock);
?>
