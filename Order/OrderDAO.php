<?php

	require_once  __DIR__ . '/OrderClass.php';
	require_once  __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface IOrderDAO
	{
		public function getOrder($order_id);
		public function getOrderByOrderObject(Order $ob);
		public function addOrder(Order $ob);
		public function getAllOrders($user_id);
		public function updateOrder(Order $ob);
		public function removeOrder($order_id);
	}

	class OrderDAO implements IOrderDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(OrderDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(OrderDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				OrderDAO::$singleInstance = new SingletonClass();
			}
			return OrderDAO::$singleInstance;
		}

		/*  INPUT: order id
			OUTPUT: Order object that holds that Order data
		*/
		public function getOrder($order_id)
		{
			// getting query that search for the order in the database
			$filter= ['order_id' => $order_id];
			$ob = $this->getFilteredQuery(['orders'], ['*'] , $filter, 'Order');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		public function getOrderByOrderObject(Order $ob)
		{
			// getting query that search for the order in the database
			$filter= [ 'user_id' => $ob->getUserId(), 'status' => $ob->getStatus(),'order_date' => $ob->getOrderDate(), 'total_price' => $ob->getTotalPrice() ];
			$ob = $this->getFilteredQuery(['orders'], ['*'] , $filter, 'Order');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		/*  INPUT: Order object
			OUTPUT: True if the order added to the database, False if not.
		*/
		public function addOrder(Order $ob)
		{

			// getting query that adds the order to the database
			$result= $this->insertQuery('orders', $ob->getArray(), 'order_id');
			return $result;
		}

		/*	INPUT: user id
			OUTPUT: array of Order class objects that holds all the orders that belongs to the user.
		*/
		public function getAllOrders($user_id)
		{
			// getting an array that holds all the orders that belongs to the user in the database
			$ob = $this->getFilteredQuery(['orders'], ['*'] , null, 'Order');
			return $ob;
		}

		/*  INPUT: Order object
			OUTPUT: True if the order updated in the database, False if not.
		*/
		public function updateOrder(Order $ob)
		{
			// getting query that search for the order in the database and update his data
			$filter= ['order_id' => $ob->getOrderId()];
			$result= $this->updateQuery('orders', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: Order object
			OUTPUT: True if the order removed from the database, False if not.
		*/
		public function removeOrder($order_id)
		{
			// getting query that search for the order in the database and remove his data
			$filter= ['order_id' => $order_id];
			$result= $this->deleteQuery('orders', $filter);
			return $result;
		}
	}

?>
