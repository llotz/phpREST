<?

include_once("RestClient.php");

function rutime($ru, $rus, $index) {
  return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
   -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

$client = new RestClient("http://phpRestBackEnd/api");
$requests = 50;
  
$rustart = getrusage();
$msstart = round(microtime(true) * 1000);

for($i = 0; $i<$requests; $i++){
  $client->AddBaseAuthCredentials("test", "password");
  $client->AddJsonBody(array('name'=>"test"));
  $client->SetRequestMethod("POST");
  $result = $client->Request("/person/");
}
$ruend = getrusage();
$msend = round(microtime(true) * 1000);

$msdiff = $msend-$msstart;


echo "ran $requests requests synchroneously<br>";
echo "took $msdiff ms to run the script<br> ";
echo "used " . rutime($ruend, $rustart, "utime") .
  " ms for client computations<br>";
echo "spent " . rutime($ruend, $rustart, "stime") .
  " ms in system calls\n";

?>