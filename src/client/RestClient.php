<?php

class RestClient{

  private $baseUrl;
  private $baseAuthCredentials;
  private $request;

  function __construct($baseUrl){
    if($this->endsWith($baseUrl, "/"))
      $baseUrl = substr(0, -1); // truncate last char
    $this->baseUrl = $baseUrl;

    $this->ResetRequest();
  }

  public function AddJsonBody($data){
    $data = json_encode($data);
    curl_setopt($this->request, CURLOPT_POSTFIELDS , $data);
  }

  public function AddBaseAuthCredentials($name, $password){
    $this->baseAuthCredentials = base64_encode("$name:$password");
  }

  public function SetRequestMethod($method){
    if(strtolower($method) == "post")
      curl_setopt($this->request, CURLOPT_POST, true);
    else if(strtolower($method) == "put")
      curl_setopt($this->request, CURLOPT_PUT, true);
  }

  public function SetReturnHeader($returnHeader){
    curl_setopt($this->request, CURLOPT_HEADER, $returnHeader);
  }

  public function Request($endpoint){
    if(!$this->startsWith($endpoint, "/"))
      $endpoint = "/".$endpoint;
    if(!$this->endsWith($endpoint, "/"))
      $endpoint .= "/";
      
    $url = $this->baseUrl . $endpoint;
    curl_setopt($this->request, CURLOPT_URL, $url);
    curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
    $header = $this->GetAuthInfo();
    curl_setopt($this->request, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $header));
    $response = curl_exec($this->request);
    curl_close($this->request);
    $this->ResetRequest();
    return $response;
  }

  private function GetAuthInfo(){
    if($this->baseAuthCredentials != "")
    return "Authorization: Basic ".$this->baseAuthCredentials;
  }

  private function ResetRequest(){
    $this->request = curl_init();
  }

  private function endsWith($haystack, $needle)
  {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
  }

  function startsWith($haystack, $needle)
  {
      $length = strlen($needle);
      return (substr($haystack, 0, $length) === $needle);
  }

}

?>