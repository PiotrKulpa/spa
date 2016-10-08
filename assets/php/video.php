<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once('connection.php');

$result = $conn->query("SELECT id, mtitle, msrc, mdate FROM video");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";};
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"title":"'   . $rs["mtitle"]        . '",';
	$outp .= '"src":"'   . $rs["msrc"]        . '",';
    $outp .= '"date":"'. $rs["mdate"]     . '"}'; 
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);


?>








