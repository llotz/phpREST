<?php
include_once("models/Status.php");

class Api {
  public $username = "";
  public $password = "";

  // Base class for all API implementations
  public function HandleRequest(){
    header("Content-Type:application/json");
    $responseBody = "";

    $credentials = $this->GetAuthorization();
    if(!$this->IsAuthorized($credentials)){
      $responseBody = $this->SendNotAuthorized();
    }else{
      $input = $this->GetJsonBodyContent();
      $method = $_SERVER['REQUEST_METHOD'];
      if($method == "GET"){
        $responseBody = $this->GET($input);
      }else if($method == "POST"){
        $responseBody = $this->POST($input);
      }else if($method == "PUT"){
        $responseBody = $this->PUT($input);
      }
    }
    $this->SendAnswer($responseBody);
  }

  public function GET($input){
    return $this->SendNotImplementedStatus();
  }

  public function POST($input){
    return $this->SendNotImplementedStatus();
  }

  public function PUT($input){
    return $this->SendNotImplementedStatus();
  }

  public function SendAnswer($body){
    echo $body;
  }

  function GetJsonBodyContent(){
    $input = "";
    try{
      $jsonBody = file_get_contents('php://input');
      $input = json_decode($jsonBody);
    }catch(Exception $e){
      $this->SendError($e, 400);
      die();
    }
    if(!isset($input)) $input = "";
    return $input;
  }

  function IsAuthorized($credentials){
    if($this->username =="" && $this->password=="")
      return true;

    if(is_array($credentials)){
      if($this->username == $credentials[0] &&
        $this->password == $credentials[1])
        return true;
      else 
        return false;
    }
    else{
      if($this->username!="" && $this->password != "")
        return false;
      else 
        return true;
    }
  }

  public function GetAuthorization(){
    $jsonHead = getallheaders();
    if(array_key_exists("Authorization", $jsonHead))
    {
      $encoded = trim(str_replace("Basic", "", $jsonHead["Authorization"]));
      $decoded = base64_decode($encoded);
      $credentials = explode(':', $decoded);
      return $credentials;
      //$username = $credentials[0];
      //$password = $credentials[1];
    }
    return "";
  }

  private function SendNotImplementedStatus(){
    return $this->SendError("This endpoint is not implemented.");
  }

  private function SendNotAuthorized(){
    return $this->SendError("You're not authorized to use this endpoint", 403);
  }

  public function SendError($message, $statusCode = 400){
    $status = new Status();
    $status->status = "Error";
    $status->message = $message;
    http_response_code($statusCode);
    return json_encode($status);
  }

  public function SendOK($message, $statusCode = 200){
    $status = new Status();
    $status->status = "OK";
    $status->message = $message;
    http_response_code($statusCode);
    return json_encode($status);
  }

}

?>