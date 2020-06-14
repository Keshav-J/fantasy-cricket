<?php

include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

if($_GET['page'] == 'selectTeam') {
	$match_id = $data->match_id;
	$player_id = $data->player_id;
	$team = $data->team;
	$cost = $data->cost;


	if(empty($match_id) || empty($player_id) || empty($team) || empty($cost)) {
		echo 'empty';
		exit();
	}

	$sql = "INSERT INTO selections(match_id, player_id, team, cost) VALUES('$match_id', '$player_id', '$team', '$cost');";
	mysqli_query($conn, $sql);

	$status = 1;

	echo '{';
	echo '	"status": '.$status;
	echo '}';
}