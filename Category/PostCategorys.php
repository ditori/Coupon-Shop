<?php
	require_once  __DIR__ . '/../ServerConnection.php';

	$arr= $ctg_dao->getAllCategorys();

	echo json_encode($arr);
?>
