<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<html>
<head>
<title>Distance Calculator</title>
</head>
<body>
<h1>Distance Calculator</h1>

<?
//create arrays
$indy = array (
  "Indianapolis" => 0,
  "New York" => 648,
  "Tokyo" => 6476,
  "London" => 4000
  );
$ny = array (
  "Indianapolis" =>648,
  "New York" => 0,
  "Tokyo" => 6760,
  "London" => 3470
  );
$tokyo = array (
  "Indianapolis" => 6476,
  "New York" => 6760,
  "Tokyo" => 0,
  "London" => 5956
  );
$london = array (
  "Indianapolis" => 4000,
  "New York" => 3470,
  "Tokyo" => 5956,
  "London" => 0
  );

//set up master array
$distance = array (
  "Indianapolis" => $indy,
  "New York" => $ny,
  "Tokyo" => $tokyo,
  "London" => $london
  );

$result = $distance[$cityA][$cityB];
print "<h3>The distance between $cityA and $cityB is $result miles.</h3>";

?>

</body>
</html>
