<?php

	require_once  __DIR__ . '/Coupon/CouponsDAO.php';
	require_once  __DIR__ . '/Bussiness/BussinessDAO.php';
	require_once  __DIR__ . '/Category/CategorysDAO.php';
	require_once  __DIR__ . '/User/UsersDAO.php';
	require_once  __DIR__ . '/Cart/CartDAO.php';
	require_once  __DIR__ . '/Order/OrderDAO.php';
	require_once  __DIR__ . '/Order/OrderCouponDAO.php';
	require_once  __DIR__ . '/Image/ImagesDAO.php';

	try
	{
		$str= 'mysql:host=localhost;dbname=CouponShop';
		$myserver = new PDO($str, "root", "223322", array(PDO::ATTR_PERSISTENT => true));

		$myserver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$cpn_dao = new CouponsDAO ($myserver); // creating the singleton object the interacts with the coupons table

		$bus_dao = new BussinessDAO ($myserver); // creating the singleton object the interacts with the bussiness table

		$ctg_dao = new CategoryDAO ($myserver); // creating the singleton object the interacts with the category table

		$usr_dao = new UsersDAO ($myserver); // creating the singleton object the interacts with the users

		$crt_dao = new CartDAO ($myserver); // creating the singleton object the interacts with the cart table

		$ord_dao = new OrderDAO ($myserver); // creating the singleton object the interacts with the orders table

		$ord_cpn_dao = new OrderCouponDAO ($myserver); // creating the singleton object the interacts with the order coupons table

		$img_dao = new ImagesDAO ($myserver); // creating the singleton object the interacts with the images table
	}
	catch (PDOException $e)
	{
    	print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
?>
