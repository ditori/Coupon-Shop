<?php
	class Image implements JsonSerializable
	{
		private $arr;

		function __construct ($arr)
		{
			$this->arr= $arr;
		}

		//      set methods
		public function setId($id) 	{	$this->arr['image_id']= $id;	}
		public function setCouponId($coupon_id) 	{	$this->arr['coupon_id']= $coupon_id;	}
		public function setDescription($desc) 	{	$this->arr['description']= $desc;	}
		public function setSource($source) 	{	$this->arr['source']= $source;	}

		//      get methods
		public function getId() 	{	return $this->arr['image_id'];	}
		public function getCouponId() 	{	return $this->arr['coupon_id'];	}
		public function getDescription() 	{	return $this->arr['description'];	}
		public function getSource() 	{	return $this->arr['source'];	}

		public function jsonSerialize()
		{
			return $this->arr;
		}
	}
?>
