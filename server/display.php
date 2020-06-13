<?php

include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

if($_GET['page'] == 'displayMatches') {

	$sql = "SELECT * FROM matches;";
	$result = mysqli_query($conn, $sql);

	$cnt = 0;
	$matches = '[';

	while($row = mysqli_fetch_assoc($result)) {
		if($cnt++ > 0)
			$matches .= ', ';

		$matches .= '{ ';
		$matches .= '"id": "' . $row['id'] . '", ';
		$matches .= '"team1": "' . $row['team1'] . '", ';
		$matches .= '"team2": "' . $row['team2'] . '", ';
		$matches .= '"venue": "' . $row['venue'] . '", ';
		$matches .= '"schedule": "' . $row['schedule'] . '"';
		$matches .= ' }';
	}

	$matches .= ' ]';

	echo '{';
	echo '	"matches": '.$matches.', ';
	echo '	"status": '.'1';
	echo '}';
}