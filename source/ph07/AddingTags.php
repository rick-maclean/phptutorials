<?
include "SuperHTMLDef.php";
$s = new SuperHTML("Adding Text and Tags");
$s->buildTop();

$s->addText("This is ordinary text added to the document");
$s->addText("<div>You can also add HTML code <hr> like the HR above</div>");

$s->h3("Use h1-h6 methods to add headings");
$s->tag("i", "this line is italicized");

$s->buildBottom();
print $s->getPage();
?>




