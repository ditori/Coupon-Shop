<?php

	require  __DIR__ . '/../ServerConnection.php';

	$user_id= $_POST['user_id'];
	$coupon_id= $_POST['coupon_id'];

	echo $crt_dao->removeCouponFromCart($user_id, $coupon_id);

?>
