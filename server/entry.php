<?php

include_once 'dbh.inc.php';

$data = json_decode(file_get_contents("php://input"));

if($_GET['page'] == 'signup') {
	$name = $data->name;
	$uname = $data->uname;
	$phnno = $data->phnno;
	$pwd = $data->pwd;

	if(empty($name) || empty($uname) || empty($phnno) || empty($pwd)) {
		echo 'empty';
		exit();
	}

	$sql = "SELECT * FROM users WHERE uname='$uname';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0)
		$phnnoValid = 0;
	else
		$phnnoValid = 1;

	if($phnnoValid) {
		$sql = "SELECT * FROM users WHERE uname='$uname';";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0)
			$unameValid = 0;
		else
			$unameValid = 1;
	}

	$status = 0;
	if($phnnoValid && $unameValid) {
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);

		$sql = "INSERT INTO users(name, uname, phnno, pwd) VALUES('$name', '$uname', '$phnno', '$pwd');";
		mysqli_query($conn, $sql);

		$sql = "SELECT * FROM users WHERE uname='$uname';";
		mysqli_query($conn, $sql);
		$uid = mysqli_fetch_assoc($result)['id'];		

		$status = 1;
	}

	echo '{';
	echo '	"phnno": '.$phnnoValid.', ';
	echo '	"uname": '.$unameValid.', ';
	if($status)
		echo '	"uid": '.$uid.', ';
	echo '	"status": '.$status;
	echo '}';
}

if($_GET['page'] == 'signin') {
	$phnno = $data->phnno;
	$pwd = $data->pwd;

	$sql = "SELECT * FROM users WHERE phnno='$phnno'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) != 1)
		$phnnoValid = 0;
	else
		$phnnoValid = 1;

	$status = 0;
	if($phnnoValid) {
		$row = mysqli_fetch_assoc($result);
		$hashedPwd = $row['pwd'];
		$uid = $row['id'];

		if(password_verify($pwd, $hashedPwd))
			$status = 1;
	}

	echo '{';
	echo '	"phnno": '.$phnnoValid.', ';
	if($status)
		echo '	"uid": '.$uid.', ';
	echo '	"status": '.$status;
	echo '}';
}