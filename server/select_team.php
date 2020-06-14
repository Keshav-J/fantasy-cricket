<?php

include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

if($_GET['page'] == 'fetchSelectedTeam') {
	$match_id = $data->match_id;
	$user_id = $data->user_id;

	if(empty($match_id) || empty($user_id)) {
		echo 'empty';
		exit();
	}

	$sql = "SELECT * FROM selections WHERE match_id='$match_id' AND user_id='$user_id';";
	$result = mysqli_query($conn, $sql);

	$status = 1;
	if(mysqli_num_rows($result) != 1)
		$selectedTeam = '';
	else {
		$selectedTeam = mysqli_fetch_assoc($result)['team'];
		$status = 2;
	}

	echo '{';
	echo '	"selectedTeam": ['.$selectedTeam.'], ';
	echo '	"status": '.$status;
	echo '}';
}

if($_GET['page'] == 'selectTeam') {
	$match_id = $data->match_id;
	$user_id = $data->user_id;
	$team = $data->team;
	$cost = $data->cost;


	if(empty($match_id) || empty($user_id) || empty($team) || empty($cost)) {
		echo 'empty';
		exit();
	}

	$sql = "SELECT * FROM selections WHERE match_id='$match_id' AND user_id='$user_id';";
	$result = mysqli_query($conn, $sql);


	$status = 1;
	if(mysqli_num_rows($result) == 0) {
		$sql = "INSERT INTO selections(match_id, user_id, team, cost) VALUES('$match_id', '$user_id', '$team', '$cost');";
		mysqli_query($conn, $sql);
	}
	else {
		$selectionId = mysqli_fetch_assoc($result)['id'];

		$sql = "UPDATE selections SET match_id='$match_id', user_id='$user_id', team='$team', cost='$cost' WHERE id='$selectionId';";
		mysqli_query($conn, $sql);
		$status = 2;
	}



	echo '{';
	echo '	"status": '.$status;
	echo '}';
}