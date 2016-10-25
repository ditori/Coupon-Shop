<?php
	require_once  __DIR__ . '/../ServerConnection.php';
	$id= $_GET['id'];
	$arr= $ctg_dao->getCategoryCoupons($id);

	echo json_encode($arr);
?>
