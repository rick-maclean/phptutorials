<?php
//import the definition of SuperHTML
include "SuperHTMLDef.php";

//instantiate and use a superHTML page

$s = new SuperHTML("My Super Duper Page!");
$s->setTitle("SuperHTML Demo");
$s->buildTop();

$s->h3("Using the tag method");
$s->tag("i", "This line should be italicized");

$s->h3("adding arbitrary text");
$s->addText("I used the addText method here");

$s->h3("build table from 2d array");
$myArray = array(
  array("English", "Spanish", "Japanese"),
  array("One", "Uno", "Ichi"),
  array("Two", "Dos", "Nii"),
  array("Three", "Tres", "San")
);
$s->buildTable($myArray);

$s->h3("build table row-by-row");
$s->startTable(3);
$s->tRow(array("English", "Greek"), "th");
$s->tRow(array("a", "alpha"));
$s->tRow(array("b", "beta"));
$s->endTable();

$s->h3("build an unordered list");
$s->buildList(array("alpha", "beta", "gamma", "delta"));

$s->h3("build an ordered list");
$s->buildList(array("alpha", "beta", "gamma", "delta"), "ol type = 'a'");

$s->h3("form elements");

$s->addText("<form> \n");
$s->textbox("user name", "Joe");


$s->h3("create select object from associative array");

$numArray = array(
  "1"=>"ichii",
  "2"=>"nii",
  "3"=>"san",
  "4"=>"shi"
);

$s->buildSelect("options", $numArray);

$s->h3("make form elements inside a table!");

$myArray = array(
  array($s->gTag("b","name"), $s->gTextbox("name")),
  array($s->gAddText("address"), $s->gTextbox("address")),
  array($s->gAddText("phone"), $s->gTextbox("phone")),
  array($s->gAddText("favorite number"), $s->gSelect("numbers", $numArray))
);

$s->buildTable($myArray);
$s->submit();

$s->addText("</form> \n");

print $s->getPage();

?>
