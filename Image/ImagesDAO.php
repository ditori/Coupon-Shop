<?php

	require_once  __DIR__ . '/ImageClass.php';
	require_once  __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once  __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface IImagesDAO
	{
		public function getImage($id);
		public function addImage(Image $ob);
		public function getAllImages();
		public function updateImage(Image $ob);
		public function removeImage(Image $ob);
		public function getImagesByCouponId($coupon_id);
		public function removeImagesByCouponId($coupon_id);
	}

	class ImagesDAO implements IImagesDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(ImagesDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(ImagesDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				ImagesDAO::$singleInstance = new SingletonClass();
			}
			return ImagesDAO::$singleInstance;
		}

		/*  INPUT: id of the specific image
			OUTPUT: Image object that holds image data
		*/
		public function getImage($id)
		{
			// getting query that search for the image in the database
			$filter= ['image_id' => $id];
			$ob = $this->getFilteredQuery(['images'], ['*'] , $filter, 'Image');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		/*  INPUT: Image object
			OUTPUT: True if the image added to the database, False if not.
		*/
		public function addImage(Image $ob)
		{
			// getting query that adds the image to the database
			$result= $this->insertQuery('images', $ob->getArray(), 'image_id');
			return $result;
		}

		/*
			OUTPUT: array of Image class objects that holds all the table images.
		*/
		public function getAllImages()
		{
			// getting an array that holds all the images in the database
			$ob = $this->getFilteredQuery(['images'], ['*'] , null, 'Image');
			return $ob;
		}

		/*  INPUT: Image object
			OUTPUT: True if the image updated in the database, False if not.
		*/
		public function updateImage(Image $ob)
		{
			// getting query that search for the image in the database and update his data
			$filter= ['image_id' => $ob->getId()];
			$result= $this->updateQuery('images', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: Image object
			OUTPUT: True if the image removed from the database, False if not.
		*/
		public function removeImage(Image $ob)
		{
			// getting query that search for the image in the database and remove his data
			$filter= ['image_id' => $ob->getId()];
			$result= $this->deleteQuery('images', $filter);
			return $result;
		}

		/*  INPUT: coupon id
			OUTPUT: array of Image class objects that holds all the images table
			that belongs to the  given coupon.
		*/
		public function getImagesByCouponId($coupon_id)
		{
			// returning all the images that belongs to the given coupon
			$filter= ['coupon_id'=>$coupon_id];
			$ob = $this->getFilteredQuery(['images'], ['*'] , $filter, 'Image');
			return $ob;
		}

		/*  INPUT: coupon id
			OUTPUT: True if the images of the given coupon has been removed from
			the database, False if not.
		*/
		public function removeImagesByCouponId($coupon_id)
		{
			// returning all the images that belongs to the given coupon
			$arr= $this->getImagesByCouponId($coupon_id);
			$size= count($arr);

			// removing all Images
			for ($i=0; $i<$size; $i++)
			{
				if (removeImage($arr[$i]->getId())==false)
				{
					$arr= null;
					return false;
				}
			}

			$arr=null;
			return true;
		}
	}

?>
