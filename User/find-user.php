<?php

	require  __DIR__ . '/../ServerConnection.php';
	//var_dump($_POST);
	$username= $_POST['username'];
	$pass= $_POST['pass'];
	$res= $usr_dao->getUserByUserName($username);

	if($res->getPassword() != $pass) // doent metter if it is null
	{
		$msg= '{"user_id":"(-1)"}';
		echo $msg;
	}
	else
	{
		echo json_encode($res);
	}
?>
