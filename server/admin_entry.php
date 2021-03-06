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

	$sql = "SELECT * FROM admins WHERE uname='$uname';";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0)
		$phnnoValid = 0;
	else
		$phnnoValid = 1;

	if($phnnoValid) {
		$sql = "SELECT * FROM admins WHERE uname='$uname';";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0)
			$unameValid = 0;
		else
			$unameValid = 1;
	}

	$status = 0;
	if($phnnoValid && $unameValid) {
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);

		$sql = "INSERT INTO admins(name, uname, phnno, pwd) VALUES('$name', '$uname', '$phnno', '$pwd');";
		mysqli_query($conn, $sql);

		$status = 1;
	}

	echo '{';
	echo '	"phnno": '.$phnnoValid.', ';
	echo '	"uname": '.$unameValid.', ';
	echo '	"status": '.$status;
	echo '}';
}

if($_GET['page'] == 'signin') {
	$phnno = $data->phnno;
	$pwd = $data->pwd;

	$sql = "SELECT * FROM admins WHERE phnno='$phnno'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) != 1)
		$phnnoValid = 0;
	else
		$phnnoValid = 1;

	$status = 0;
	if($phnnoValid) {
		$hashedPwd = mysqli_fetch_assoc($result)['pwd'];

		if(password_verify($pwd, $hashedPwd))
			$status = 1;
	}

	echo '{';
	echo '	"phnno": '.$phnnoValid.', ';
	echo '	"status": '.$status;
	echo '}';
}