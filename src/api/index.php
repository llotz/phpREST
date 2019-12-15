<h2>phpREST</h2>
<p>This is an API library implemented in php.</p>
<p>API description and automatic endpoint detection (request methods) will be added soon.</p>

<h2>Endpoints</h2>

<?php
$baseLink = getBaseLink();
$endpoints = scandir("api");
printEndpoints($baseLink, $endpoints);


function getBaseLink(){
	$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
	$host = $_SERVER['HTTP_HOST'];
	$baseLink = "$http://$host";
	return $baseLink;
}

function printEndpoints($baseLink, $endpoints){
	if(count($endpoints) > 2){
		for($i = 2; $i < count($endpoints); $i++){
			$apiName = $endpoints[$i];
			echo "<p><a href='$baseLink/api/$apiName'>/api/$apiName/</a></p>";
		}
	}
}



?> 