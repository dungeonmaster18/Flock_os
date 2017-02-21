<?php

	$myAuth=array("appId"=>"49caa02f-ec1b-4fee-ad3c-aed8477a6b57","appSecret"=>"cb31fbc7-0f5e-4079-90d4-408d0fe88948");

$myJSON  = json_encode($myAuth);

echo $myJSON;
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
 $fp=fopen("response.txt","a+");
  fwrite($fp, $input["name"]);

echo $input;
header("HTTP/1.1 200 OK");


?>