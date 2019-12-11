<?php

include_once("models/Person.php");
include_once("models/Status.php");

function sendError($errorMessage){
	http_response_code(400);
	$status = new Status();
	$status->status = "error";
	$status->message = "No data given.";
	print(json_encode($status));
	exit;
}

header("Content-Type:application/json");
$jsonBody = file_get_contents('php://input');
$input = json_decode($jsonBody);

$jsonHead = getallheaders();
if(array_key_exists("Authorization", $jsonHead))
{
	$encoded = trim(str_replace("Basic", "", $jsonHead["Authorization"]));
	$decoded = base64_decode($encoded);
	$credentials = explode(':', $decoded);
	$username = $credentials[0];
	$password = $credentials[1];
	//echo "User: $username, Pass: $password";
}

if(isset($input->name))
{
	http_response_code(200);
	$person = new Person();
	$person->name = $input->name;
	$person->age = rand(20, 80);
	print(json_encode($person));
}
else{
	sendError("No data given.");
}
?> 