<?php

	require  __DIR__ . '/../ServerConnection.php';

	$arr= array();
	$arr['user_id']= (-1);
	$arr['username']= $_POST['username'];
	$arr['password']= $_POST['pass'];
	$arr['sign_up_date'] = date('Y-m-d H:i:s');
	$arr['email']= $_POST['email'];
	$arr['permissions']= 'customer';
	$arr['first_name']= $_POST['fname'];
	$arr['last_name']= $_POST['lname'];

	$ob= new User ($arr);
	$res= $usr_dao->addUser($ob);
	$usr= $usr_dao->getUserByUserName($ob["username"]);

	echo json_encode($usr);

?>
