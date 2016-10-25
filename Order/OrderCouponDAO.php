<?php

	require_once  __DIR__ . '/OrderCouponClass.php';
	require_once  __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface IOrderCouponDAO
	{
		public function getOrder($order_id);
		public function searchOrderCoupon(OrderCoupon $ob);
		public function emptyorder($order_id);
		public function addCouponToOrder(OrderCoupon $ob);
		public function updateCouponFromOrder(OrderCoupon $ob);
		public function removeCouponFromOrder($order_id, $coupon_id);
	}

	class OrderCouponDAO implements IOrderCouponDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(OrderCouponDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(OrderCouponDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				OrderCouponDAO::$singleInstance = new SingletonClass();
			}
			return OrderCouponDAO::$singleInstance;
		}

		/*  INPUT: OrderCoupon object
			OUTPUT: True if the coupon added to the order in the database, False if not.
		*/
		public function addCouponToOrder(OrderCoupon $ob)
		{
			$result= $this->insertQuery('order_coupons', $ob->getArray(), null);
			return $result;
		}

		/*
			INPUT: order id
			OUTPUT: array of OrderCoupon class objects that holds all coupons in that order.
		*/
		public function getOrder($order_id)
		{
			$filter= ['order_id' => $order_id];
			$ob = $this->getFilteredQuery(['order_coupons'], ['*'] , $filter, 'OrderCoupon');
			return $ob;
		}

		/*
			INPUT: OrderCoupon object
			OUTPUT: True if we find coupon in the order table with the same order_id and coupon_id.
					False if we did not find.
		*/
		public function searchOrderCoupon(OrderCoupon $ob)
		{
			$filter= ['order_id' => $ob->getOrderId(), 'coupon_id' => $ob->getCouponId()];
			$ob = $this->getFilteredQuery(['order_coupons'], ['*'] , $filter, 'OrderCoupon');
			if ($ob!=null)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/*  INPUT: OrderCoupon object
			OUTPUT: True if the coupon has been updated in the order database, False if not.
		*/
		public function updateCouponFromOrder(OrderCoupon $ob)
		{
			$filter= ['order_id' => $ob->getOrderId(), 'coupon_id' => $ob->getCouponId()];
			$result= $this->updateQuery('order_coupons', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: order id and coupon id
			OUTPUT: True if the coupon removed from the order in the database, False if not.
		*/
		public function removeCouponFromOrder($order_id, $coupon_id)
		{
			$filter= ['order_id' => $order_id, 'coupon_id' => $coupon_id];
			$result= $this->deleteQuery('order_coupons', $filter);
			return $result;
		}

		/*  INPUT: order id
			OUTPUT: True if user order has been cleared, False if not.
		*/
		public function emptyOrder($order_id)
		{
			$orderOfCoupons= $this->getOrder($order_id);
			foreach ($orderOfCoupons as $orderCoupon)
			{
				if ($this->removeCouponFromOrder($orderCoupon)==false)
				{
					return false;
				}
			}

			return true;
		}
	}

?>
