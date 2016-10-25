<?php

	require  __DIR__ . '/../ServerConnection.php';

	$username= $_POST['user_id'];

	$res= $usr_dao->getUser($username);

	if ($res!=null)
	{
		// cleaning unnecessary data
		$res->setPassword("");
		$res->setPermissions("");
		$res->setBussinessId("");
	}

	echo json_encode($res);
?>
