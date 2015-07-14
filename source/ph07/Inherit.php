<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
<title>Glitter Critter</title>
</head>
<body>
<?

// Incorporating Inheritance

//pull up the Critter class
include "critter.php";

//create new Glitter Critter based on Critter

class GlitterCritter extends Critter{
  //add one method
  function glow(){
    print $this->name . " gently shimmers...<br> \n";
  } // end glow

  //over-ride the setName method
  function setName($newName){
    $this->name = "Glittery " . $newName;
  } // end setName

} // end GC class def

//make an instance of the new critter
$theCritter = new GlitterCritter("Gloria");

//GC has no constructor, so it 'borrows' from its parent

print "Critter name: " . $theCritter->getName() . "<br>\n";

//invoke new glow method
$theCritter->glow();



?>
</body>
</html>








