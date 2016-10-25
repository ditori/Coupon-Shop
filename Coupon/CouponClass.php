<?php

	class Coupon implements JsonSerializable
	{
		private $arr; 
		
		function __construct ($arr)
		{
			$this->arr = $arr;
		}
		
		// set methods
		public function setId ($id) {	$this->arr['coupon_id']= $id;	}
		public function setName ($name) {	$this->arr['coupon_name']= $name;	}
		public function setCategory ($ctg) {	$this->arr['category_id']= $ctg;	}
		public function setDescription ($desc) {	$this->arr['description']= $desc;	}
		public function setImage ($img) {	$this->arr['image']= $img;	}
		public function setBusinesId  ($bus_id) {	$this->arr['business_id']= $bus_id;	}
		public function setNormalPrice  ($nrm_prc) {	$this->arr['normal_price']= $nrm_prc;	}
		public function setNewPrice  ($new_prc) {	$this->arr['new_price']= $new_prc;	}
		// set methods end
		
		// get methods
		public function getId () {	return $this->arr['coupon_id'];	}
		public function getName () {	return $this->arr['coupon_name'];	}
		public function getCategory () {	return $this->arr['category_id'];	}
		public function getDescription () {	return $this->arr['description'];	}
		public function getImage () {	return $this->arr['image'];	}
		public function getBussinessId () {	return $this->arr['bussiness_id'];	}
		public function getNormalPrice () {	return $this->arr['normal_price'];	}
		public function getNewPrice () {	return $this->arr['new_price'];	}
		public function getArray () {	return $this->arr;	}
		// get methods end
		
		public function jsonSerialize()
		{
			return $this->arr;
		}
	}

?>