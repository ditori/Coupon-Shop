<?php

	require_once  __DIR__ . '/BussinessClass.php';
	require_once  __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface IBussinessDAO
	{
		public function getBussiness($id);
		public function addBussiness(Bussiness $ob);
		public function getAllBussiness();
		public function updateBussiness(Bussiness $ob);
		public function removeBussiness(Bussiness $ob);
		public function getBussinessCoupons($id); // find all the coupons that belongs to this bussiness
	}

	class BussinessDAO implements IBussinessDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(BussinessDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(BussinessDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				BussinessDAO::$singleInstance = new SingletonClass();
			}
			return BussinessDAO::$singleInstance;
		}

		/*  INPUT: id of the specific bussiness
			OUTPUT: Bussiness object that holds the companys data
		*/
		public function getBussiness($id)
		{
			// getting query that search for the bussiness in the database
			$filter= ['bussiness_id' => $id];
			$ob = $this->getFilteredQuery(['bussiness'], ['*'] , $filter, 'Bussiness');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		/*  INPUT: Bussiness object
			OUTPUT: True if the bussiness added to the database, False if not.
		*/
		public function addBussiness(Bussiness $ob)
		{
			// getting query that adds the bussiness to the database
			$result= $this->insertQuery('bussiness', $ob->getArray(), 'bussiness_id');
			return $result;
		}

		/*
			OUTPUT: array of Bussiness class objects that holds all the table bussiness.
		*/
		public function getAllBussiness()
		{
			// returning all the bussiness in the database
			$ob = $this->getFilteredQuery(['bussiness'], ['*'] , null, 'Bussiness');
			return $ob;
		}

		/*  INPUT: Bussiness object
			OUTPUT: True if the bussiness updated in the database, False if not.
		*/
		public function updateBussiness(Bussiness $ob)
		{
			// getting query that search for the bussiness in the database and update his data
			$filter= ['bussiness_id' => $ob->getId()];
			$result= $this->updateQuery('bussiness', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: Bussiness object
			OUTPUT: True if the bussiness removed from the database, False if not.
		*/
		public function removeBussiness(Bussiness $ob)
		{
			// getting query that search for the bussiness in the database and remove his data
			$filter= ['bussiness_id' => $ob->getId()];
			$result= $this->deleteQuery('bussiness', $filter);
			return $result;
		}

		/*  INPUT: id of the specific bussiness
			OUTPUT: array of Coupon class objects that holds all the coupon table with the given bussiness id.
		*/
		public function getBussinessCoupons($id)
		{
			// returning all the coupons in the given bussiness
			$filter= ['bussiness_id'=>$id];
			$ob = $this->getFilteredQuery(['coupons'], ['*'] , $filter, 'Coupon');
			return $ob;
		}
	}

?>
