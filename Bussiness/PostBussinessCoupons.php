<?php
	require_once  __DIR__ . '/../ServerConnection.php';
	$id= $_GET['id'];
	$arr= $bus_dao->getBussinessCoupons($id);

	echo json_encode($arr);
?>
