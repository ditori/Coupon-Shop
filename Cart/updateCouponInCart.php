<?php

	require  __DIR__ . '/../ServerConnection.php';

	$arr= array();
	$arr['user_id']= $_POST['user_id'];
	$arr['coupon_id']= $_POST['coupon_id'];
	$arr['quantity'] = $_POST['quantity'];

	$ob= new Cart ($arr);

	$result= $crt_dao->updateCouponFromCart($ob);
	echo $result;

?>
