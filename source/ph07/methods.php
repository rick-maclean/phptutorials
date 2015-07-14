<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
<title>Critter</title>
</head>
<body>
<?
// Adding methods

//define the critter class
class Critter{

  var $name;

  function __construct($handle = "anonymous"){
    $this->name = $handle;
  } // end constructor

  function setName($newName){
    $this->name = $newName;
  } // end setName

  function getName(){
    return $this->name;
  } // end getName

} // end Critter class

//make an instance of the critter
$theCritter = new Critter();

//print original name
print "Initial name: " . $theCritter->getName() . "<br>\n";

print "Changing name...<br>\n";
$theCritter->setName("Melville");
print "New name: " . $theCritter->getName() . "<br>\n";


?>
</body>
</html>








