<?php

	require_once  __DIR__ . '/CategoryClass.php';
	require_once  __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface ICategoryDAO
	{
		public function getCategory($id);
		public function addCategory(Category $ob);
		public function getAllCategorys();
		public function updateCategory(Category $ob);
		public function removeCategory(Category $ob);
		public function getCategoryCoupons($id);
	}

	class CategoryDAO implements ICategoryDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(CategoryDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(CategoryDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				CategoryDAO::$singleInstance = new SingletonClass();
			}
			return CategoryDAO::$singleInstance;
		}

		/*  INPUT: id of the specific category
			OUTPUT: Categorys object that holds the category data
		*/
		public function getCategory($id)
		{
			// getting query that search for the category in the database
			$filter= ['category_id' => $id];
			$ob = $this->getFilteredQuery(['category'], ['*'] , $filter, 'Category');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		/*  INPUT: Category object
			OUTPUT: True if the category added to the database, False if not.
		*/
		public function addCategory(Category $ob)
		{
			// getting query that adds the category to the database
			$result= $this->insertQuery('category', $ob->getArray(), 'category_id');
			return $result;
		}

		/*
			OUTPUT: array of Category class objects that holds all the table categorys.
		*/
		public function getAllCategorys()
		{
			// getting an array that holds all the category in the database
			$ob = $this->getFilteredQuery(['category'], ['*'] , null, 'Category');
			return $ob;
		}

		/*  INPUT: Category object
			OUTPUT: True if the category updated in the database, False if not.
		*/
		public function updateCategory(Category $ob)
		{
			// getting query that search for the category in the database and update his data
			$filter= ['category_id' => $ob->getId()];
			$result= $this->updateQuery('category', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: Category object
			OUTPUT: True if the category removed from the database, False if not.
		*/
		public function removeCategory(Category $ob)
		{
			// getting query that search for the category in the database and remove his data
			$filter= ['category_id' => $ob->getId()];
			$result= $this->deleteQuery('category', $filter);
			return $result;
		}

		/*  INPUT: id of the specific category
			OUTPUT: array of Coupon class objects that holds all the coupon table with the given category id.
		*/
		public function getCategoryCoupons($id)
		{
			// returning all the coupons in the given category
			$filter= ['category_id'=>$id];
			$ob = $this->getFilteredQuery(['coupons'], ['*'] , $filter, 'Coupon');
			return $ob;
		}
	}

?>
