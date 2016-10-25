<?php

	require __DIR__ .'/../ServerConnection.php';

	$arr= array();
	$arr['user_id']= $_POST['user_id'];
	$arr['coupon_id']= $_POST['coupon_id'];
	$arr['quantity'] = $_POST['quantity'];

	$ob= new Cart ($arr);
	if ($crt_dao->searchCartCoupon($ob)==true) // if the coupon is already in the user cart
	{
		$res= $crt_dao->updateCouponFromCart($ob);
	}
	else // if the coupon is not in the user cart
	{
		$res= $crt_dao->addCouponToCart($ob);
	}


	echo $res;

?>
