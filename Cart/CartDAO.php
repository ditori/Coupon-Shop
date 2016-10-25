<?php

	require_once  __DIR__ .'/CartClass.php';
	require_once  __DIR__ .'/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ .'/../SQL/QuerySQLRunner.php';

	interface ICartDAO
	{
		public function getCart($user_id);
		public function searchCartCoupon(Cart $ob);
		public function emptyCart($user_id);
		public function addCouponToCart(Cart $ob);
		public function updateCouponFromCart(Cart $ob);
		public function removeCouponFromCart($user_id, $coupon_id);
	}

	class CartDAO implements ICartDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(CartDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(CartDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				CartDAO::$singleInstance = new SingletonClass();
			}
			return CartDAO::$singleInstance;
		}

		/*  INPUT: Cart object
			OUTPUT: True if the coupon added to user cart in the database, False if not.
		*/
		public function addCouponToCart(Cart $ob)
		{
			$result= $this->insertQuery('cart', $ob->getArray(), null);
			return $result;
		}

		/*
			INPUT: user id
			OUTPUT: array of Cart class objects that holds all coupons in the user cart.
		*/
		public function getCart($user_id)
		{
			$filter= ['user_id' => $user_id];
			$ob = $this->getFilteredQuery(['cart'], ['*'] , $filter, 'Cart');
			return $ob;
		}

		/*
			INPUT: Cart object
			OUTPUT: True if we find coupon in the Cart table with the same user_id and coupon_id. (image_id and quantity these not matter).
					False if we did not find.
		*/
		public function searchCartCoupon(Cart $ob)
		{
			$filter= ['user_id' => $ob->getUserId(), 'coupon_id' => $ob->getCouponId()];
			$ob = $this->getFilteredQuery(['cart'], ['*'] , $filter, 'Cart');
			if ($ob!=null)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/*  INPUT: Cart object
			OUTPUT: True if the cart updated in the database, False if not.
		*/
		public function updateCouponFromCart(Cart $ob)
		{
			$filter= ['user_id' => $ob->getUserId(), 'coupon_id' => $ob->getCouponId()];
			$result= $this->updateQuery('cart', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: user id and coupon id
			OUTPUT: True if the coupon removed from the user cart in the database, False if not.
		*/
		public function removeCouponFromCart($user_id, $coupon_id)
		{
			$filter= ['user_id' => $user_id, 'coupon_id' => $coupon_id];
			$result= $this->deleteQuery('cart', $filter);
			return $result;
		}

		/*  INPUT: user id
			OUTPUT: True if user cart has been cleared, False if not.
		*/
		public function emptyCart($user_id)
		{
			$cartOfCoupons= $this->getCart($user_id);
			foreach ($cartOfCoupons as $cartCoupon)
			{
				if ($this->removeCouponFromCart($cartCoupon)==false)
				{
					return false;
				}
			}

			return true;
		}
	}

?>
