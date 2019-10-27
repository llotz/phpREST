<?php
header("Content-Type:application/json");
if(isset($_GET["name"]) && $_GET["name"]!="")
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
{"Error": {"Message": "No data given"}}
    <?
    http_response_code(204);
}
?> 