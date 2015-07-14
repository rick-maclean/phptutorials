<?
// Critter definition

//define the critter class
class Critter{

  var $name;

  function __construct($handle = "anonymous"){
    $this->setName($handle);
  } // end constructor

  function setName($newName){
    $this->name = $newName;
  } // end setName

  function getName(){
    return $this->name;
  } // end getName

} // end Critter class

?>








