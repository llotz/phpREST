<?php

include_once("../../Api.php");

class TestAPI extends Api{
  // no username declaration -> no auth required

  // GET implemented -> overrides GET Method of base class
  // gets invoked when Get request coming in
  public function GET($input){
    return $this->GetOk("Test works, baby!");
  }

  // overrides SendAnswer function. Allows you to manipulate body content
  public function SendAnswer($body){
    echo $body;
  }
}

$api = new TestAPI();
$api->HandleRequest();

?>