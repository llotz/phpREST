<?
require_once("../../Api.php");
require_once("models/Person.php");

class PersonAPI extends Api{
  public $username = "test";
  public $password = "password";

  public function GET($content){
    $person = new Person();
    $person->name="Bob";
    $person->age=rand(18, 101);
    return json_encode($person);
  }

  public function POST($content){
    if(!property_exists($content, "name")){
      return $this->GetError("Property 'name' not set!");
    }

    if($content->name == ""){
      return $this->GetError("Property 'name' has no value!");
    }

    $person = new Person();
    $person->name = $content->name;
    $person->age = rand(20, 80);
    return json_encode($person);
  }
}

$api = new PersonAPI();
$api->HandleRequest();

?>