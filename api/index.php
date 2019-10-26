<?php
header("Content-Type:application/json");
if(isset($_GET["name"]))
{
    http_response_code(200);
?>
{
    "Person":{
        "Name": "<?=$_GET["name"]?>",
        "Age": <?=rand(20, 80)?>
    }
}
<?
}
else{
    ?>
{"Error": "No data given"}
    <?
}
?> 