<?
include_once("RestClient.php");
ob_start (); // start buffering
?>

<html>
<head>
  <style>
    <?=file_get_contents("style.css");?>
  </style>
  <title>phpREST</title>
</head>
<body>

<?

if(isset($_GET["name"])) {
  $name = $_GET['name'];

  $client = new RestClient("http://phpRestBackEnd/api");
  $client->AddBaseAuthCredentials("test", "password");
  $client->AddJsonBody(array('name'=>"$name"));
  $client->SetRequestMethod("POST");
  $result = $client->Request("/person/");
  
  $data = json_decode($result);
  if(property_exists($data, "status") && $data->status == "error")
    $output="Error: ".$data->message;
  else
    $output="Name: ".$data->name."<br>Age: ".$data->age;

} 
?>

<div class="content">
    <form class="form-inline" action="" method="GET">
      <div class="form-group">
        <label for="name">Search Person</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Person Name" value=<?=$_GET['name'];?> />
      </div>
      <button type="submit" name="submit" class="btn btn-default">Find</button>
    </form>
</div>

<br>
<?=$output?>

</body>
</html>


<?
  $pageContents = ob_get_contents (); // Get all the page's HTML into a string
  ob_end_clean (); // Wipe the buffer
  echo $pageContents; // render page
?>