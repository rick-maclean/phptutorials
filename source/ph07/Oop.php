<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
<title>OOP Demo</title>
</head>
<body>
<?
// OOP DEMO

class Critter{
  var $name;
  
  function __construct($handle = "Anonymous"){
  	//constructor
  	$this->name = $handle;
  } // end constructor
  
  function sayName(){
	  return("My name is $this->name<br>\n");
  } // end sayName
} // end Critter class

class GlitterCritter extends Critter {

  // note there is no constructor and no name property
  // yet they are available
  function glow(){
    print("$this->name gently shimmers...<br>\n");
  } // end glow

} // end GC class def

class BitterCritter extends Critter {
  function __construct(){
    $this->name = "none of your business";
  } // end BC constructor

  function glower(){
    return "Grrrrr...<br>\n";
  } // end glower
} // end BitterCritter class def

$first = new Critter("Orville");
$second = new Critter();
$third = new BitterCritter("George");
$fourth = new GlitterCritter("Gloria");

print($first->sayName());
print($second->sayName());
print($third->sayName());
print($third->glower());
print($fourth->glow());

?>
</body>
</html>
