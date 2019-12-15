<?php

include_once("../../Api.php");

class TestAPI extends Api{
  // no username declaration -> no auth required

  // GET implemented -> overrides GET Method of base class
  // gets invoked when Get request coming in
  public function GET($input){
    $this->SendOk("Test works, baby!");
  }
}

$api = new TestAPI();
$api->HandleRequest();

?>