<?
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

if(isset($_POST['submit'])) {
  $name = $_POST['name'];
  $url = "http://phpRestBackEnd/?name=".$name;
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  $response = curl_exec($client);
  $data = json_decode($response);
  if(property_exists($data, "Error"))
    $output="Error: ".$data->Error;
  else
    $output="Name: ".$data->Person->Name."<br>Age: ".$data->Person->Age;

} 
?>

<div class="content">
    <form class="form-inline" action="" method="POST">
      <div class="form-group">
        <label for="name">Search Person</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Person Name" required/>
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