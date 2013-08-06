<?php
function generateNonce() {
	$nonce = '';
    for ($i = 0; $i < 8; ++$i) {
            $nonce .= dechex(rand(0, 15));
        }
        return $nonce;
    }


$user="hoyajigi";
$user_key="51069392";
$APP_KEY="d075f9abcf307e48b2c67e30bc7f0781";

$auth=$nonce.md5($nonce.$user_key);

// include a library
require_once("Stomp.php");
// make a connection
try{
$con = new Stomp("tcp://nc.me2day.net:10001");
}catch(Stomp_Exception $e){
echo $e;
}
//exit();



// connect
try{
$con->connect($user."@".$APP_KEY,$auth);
}catch(Stomp_Exception $e){
echo $e;
}
exit();





// send a message to the queue

//$con->send("/queue/test", "test");
// subscribe to the queue
$con->subscribe("/queue/me2day/nc/".$user);

while(1){
flush();
// receive a message from the queue
$msg = $con->readFrame();

// do what you want with the message
	if ( $msg->body === "test") {
	    echo "Worked\n";
	    // mark the message as received in the queue
	    $con->ack($msg);
	} else {
	    echo "Failed\n";
	}
}



// disconnect
$con->disconnect();
?>