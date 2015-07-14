<?
include "SuperHTMLDef.php";
$s = new SuperHTML("Working with Forms");
$s->buildTop();

$s->h3("form elements");

$s->addText("<form> \n");
$s->textbox("userName", "Joe");

$s->h3("create select object from associative array");

$numArray = array(
  "1"=>"ichii",
  "2"=>"nii",
  "3"=>"san",
  "4"=>"shi"
);

$s->select("options", $numArray);

$s->h3("make form elements inside a table!");

$myArray = array(
  array($s->gTag("b","name"), $s->gTextbox("name")),
  array("address", $s->gTextbox("address")),
  array("phone", $s->gTextbox("phone")),
  array("favorite number", $s->gSelect("number", $numArray))
);

$s->buildTable($myArray);
$s->submit();

$s->addText("</form> \n");

$s->h3("results from previous form (if any)");
$s->formResults();

$s->buildBottom();
print $s->getPage();
?>




