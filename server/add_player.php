<?php

include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

if($_GET['page'] == 'addPlayer') {
	$name = $data->name;
	$age = $data->age;
	$battingStyle = $data->battingStyle;
	$bowlingStyle = $data->bowlingStyle;
	$pool = $data->pool;
	$cost = $data->cost;
	$authCode = $data->authCode;


	if(empty($name) || empty($age) || empty($battingStyle) || empty($bowlingStyle) || empty($pool) || empty($cost) || empty($authCode)) {
		echo 'empty';
		exit();
	}

	if($authCode != 'add')
		$authValid = 0;
	else
		$authValid = 1;

	$status = 0;
	if($authValid) {
		$sql = "INSERT INTO players(name, age, batting_style, bowling_style, pool, cost) VALUES('$name', '$age', '$battingStyle', '$bowlingStyle', '$pool', '$cost');";
		mysqli_query($conn, $sql);

		$status = 1;
	}

	echo '{';
	echo '	"auth": '.$authValid.', ';
	echo '	"status": '.$status;
	echo '}';
}