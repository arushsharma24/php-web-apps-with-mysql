<?php
require_once "pdo.php";

if(isset($_GET['name'])) $name = $_GET["name"];
else die("Name parameter missing");

$make = isset($_POST["make"])?htmlentities($_POST["make"]):'';
$year = isset($_POST["year"])?htmlentities($_POST["year"]):'';
$mileage = isset($_POST["mileage"])?htmlentities($_POST["mileage"]):'';
if(isset($_POST["logout"])) header('Location: index.php');

$text = '';

if($make != ''){
    if(is_numeric($year)&&is_numeric($mileage)) $text = "Record inserted";
    else $text = "Mileage and year must be numeric";
}   
else {
    if(isset($_POST["add"])) $text = "Make is required";
}

if($text == "Record inserted"){
    $sql = "INSERT INTO autos (make, year, mileage) VALUES
            (:make, :year, :mileage)";
    //echo "<pre>\n".$sql."</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $make,
        ':year' => $year,
        ':mileage' => $mileage));
}
$stmt2 = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- ----------------------------------------------------------------------------------------------------------- -->
<html>
<head>
    <title>Arush Sharma Automobile Tracker</title>
</head>
<body>
<h1>Tracking Autos for <?= $name ?> </h1>
<?php
if($text == "Record inserted"){
    echo "<p style='color: green;'>",$text,"</p>" ;
}
else echo "<p style='color: red;'>",$text,"</p>";
?>
<form action="autos.php?name=<?=$name?>" method="post">
<p>Make: <input name="make"></p>
<p>Year: <input name="year"></p>
<p>Mileage: <input name="mileage"></p>
<input type="submit" name="add" value="Add">
&nbsp;
<input type="submit" name="logout" value="Logout">
<hr>
<h2>Automobiles</h2>
<pre>
<?php
foreach ($rows as $row){
    echo "<ul><li>";
    echo($row['make']);
    echo "&nbsp;";
    echo($row['year']);
    echo "&nbsp;";
    echo($row['mileage']);
    echo "</li></ul><hr>";
}
?>
</pre>

