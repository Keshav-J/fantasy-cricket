<?php

include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

if($_GET['page'] == 'createMatch') {
	$team1 = $data->team1;
	$team2 = $data->team2;
	$venue = $data->venue;
	$schedule = $data->schedule;
	$authCode = $data->authCode;


	if(empty($team1) || empty($team2) || empty($venue) || empty($schedule) || empty($authCode)) {
		echo 'empty';
		exit();
	}

	if($authCode != 'add')
		$authValid = 0;
	else
		$authValid = 1;

	$status = 0;
	if($authValid) {
		$sql = "INSERT INTO matches(team1, team2, venue, schedule) VALUES('$team1', '$team2', '$venue', '$schedule');";
		mysqli_query($conn, $sql);

		$status = 1;
	}

	echo '{';
	echo '	"auth": '.$authValid.', ';
	echo '	"status": '.$status;
	echo '}';
}