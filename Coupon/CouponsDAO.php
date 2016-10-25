<?php

	require_once  __DIR__ . '/CouponClass.php';
	require_once  __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface ICouponsDAO
	{
		public function getCoupon($id);
		public function addCoupon(Coupon $ob);
		public function getAllCoupons();
		public function updateCoupon(Coupon $ob);
		public function removeCoupon(Coupon $ob);
	}

	class CouponsDAO implements ICouponsDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(CouponsDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(CouponsDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				CouponsDAO::$singleInstance = new SingletonClass();
			}
			return CouponsDAO::$singleInstance;
		}


		/*  INPUT: id of the specific coupon
			OUTPUT: Coupon object that holds the coupon data
		*/
		public function getCoupon($id)
		{
			// getting query that search for the coupon in the database
			$filter= ['coupon_id' => $id];
			$ob = $this->getFilteredQuery(['coupons'], ['*'] , $filter, 'Coupon');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		/*  INPUT: Coupon object
			OUTPUT: True if the coupon added to the database, False if not.
		*/
		public function addCoupon(Coupon $ob)
		{
			// getting query that adds the coupon to the database
			$result= $this->insertQuery('coupons', $ob->getArray(), 'coupon_id');
			return $result;
		}

		/*
			OUTPUT: array of Coupon class objects that holds all the table coupon.
		*/
		public function getAllCoupons()
		{
			// returning all the coupons in the database
			$ob = $this->getFilteredQuery(['coupons'], ['*'] , null, 'Coupon');
			return $ob;
		}

		/*  INPUT: Coupon object
			OUTPUT: True if the coupon updated in the database, False if not.
		*/
		public function updateCoupon(Coupon $ob)
		{
			// getting query that search for the coupon in the database and update his data
			$filter= ['coupon_id' => $ob->getId()];
			$result= $this->updateQuery('coupons', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: Coupon object
			OUTPUT: True if the coupon removed from the database, False if not.
		*/
		public function removeCoupon(Coupon $ob)
		{
			// getting query that search for the coupon in the database and delete his data
			$filter= ['coupon_id' => $ob->getId()];
			$result= $this->deleteQuery('coupons', $filter);
			return $result;
		}
	}

?>
