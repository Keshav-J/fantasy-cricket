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

if($_GET['page'] == 'displayPlayers') {

	$sql = "SELECT * FROM players;";
	$result = mysqli_query($conn, $sql);

	$cnt = 0;
	$players = '[';

	while($row = mysqli_fetch_assoc($result)) {
		if($cnt++ > 0)
			$players .= ', ';

		$players .= '{ ';
		$players .= '"id": "' . $row['id'] . '", ';
		$players .= '"name": "' . $row['name'] . '", ';
		$players .= '"age": "' . $row['age'] . '", ';
		$players .= '"team": "' . $row['team'] . '", ';
		$players .= '"batting_style": "' . $row['batting_style'] . '", ';
		$players .= '"bowling_style": "' . $row['bowling_style'] . '", ';
		$players .= '"pool": "' . $row['pool'] . '", ';
		$players .= '"cost": "' . $row['cost'] . '"';
		$players .= ' }';
	}

	$players .= ' ]';

	echo '{';
	echo '	"players": '.$players.', ';
	echo '	"status": '.'1';
	echo '}';
}