<?php
include_once("src/api/Api.php");

use PHPUnit\Framework\TestCase;

class BaseApiTests extends TestCase{
  
  protected $restApi;

  public function setUp():void{
    $this->restApi = new Api();
  }

  public function testTrueEqualsTrue(){
    $this->assertTrue(true);
  }

  public function testObjectSetupIsOk(){
    $this->assertEquals($this->restApi->username, "");
    $this->assertEquals($this->restApi->password, "");
  }

  public function testAuthorizedIsTrue(){
    $this->assertTrue($this->restApi->IsAuthorized(""));
  }

  public function testJsonBodyContentIsEmpty(){
    $this->assertEquals($this->restApi->GetJsonBodyContent(), "");
  }

  public function testIsAuthorizedIsTrueForCorrectCredentials(){
    $username = "user";
    $password = "userpassword";
    $credentials = array($username, $password);
    $this->restApi->username = $username;
    $this->restApi->password = $password;
    $this->assertTrue($this->restApi->IsAuthorized($credentials));
  }

  public function testIsAuthorizedIsFalseForWrongCredentials(){
    $username = "user";
    $password = "userpassword";
    $credentials = array($username, "otherPass");
    $this->restApi->username = $username;
    $this->restApi->password = $password;
    $this->assertFalse($this->restApi->IsAuthorized($credentials));
  }
}

?>