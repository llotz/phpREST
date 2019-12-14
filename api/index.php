<h2>phpREST</h2>
<p>This is a API library implemented in php.</p>
<p>API description will bee added soon.</p>

<h2>Endpoints</h2>

<?php
$baseLink = getBaseLink();
$apis = scandir("api");
if(count($apis) > 2){
	for($i = 2; $i < count($apis); $i++){
		$apiName = $apis[$i];
		echo "<p><a href='$baseLink/api/$apiName'>$baseLink/api/$apiName/</a></p>";
	}
}

function getBaseLink(){
	$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
	$host = $_SERVER['HTTP_HOST'];
	$baseLink = "$http://$host";
	return $baseLink;
}



?> 