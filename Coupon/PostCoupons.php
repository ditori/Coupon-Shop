<?php

	require_once  __DIR__ . '/../ServerConnection.php';

	$arr= $cpn_dao->getAllCoupons();

	echo json_encode($arr);
?>
