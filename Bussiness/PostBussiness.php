<?php
	require_once  __DIR__ . '/../ServerConnection.php';

	$arr= $bus_dao->getAllBussiness();

	echo json_encode($arr);
?>
