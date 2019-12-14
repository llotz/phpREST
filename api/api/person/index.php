<?
include_once("../../Api.php");
include_once("models/Person.php");

class PersonAPI extends Api{
  public $username = "test";
  public $password = "password";

  public function GET($content){
    $person = new Person();
    $person->name="Lukas";
    $person->age=28;
    echo json_encode($person);
  }

  public function POST($content){
    if(!property_exists($content, "name")){
      $this->SendError("Property 'name' not set!");
      die();
    }
    $person = new Person();
    $person->name = $content->name;
    $person->age = rand(20, 80);
    echo json_encode($person);
  }
}

$api = new PersonAPI();
$api->HandleRequest();

?>