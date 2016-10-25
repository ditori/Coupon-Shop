<?php

	class Bussiness implements JsonSerializable
	{
		private $arr;
		
		function __construct ($arr)
		{
			$this->arr= $arr;
		}
				
		//      set methods
		public function setId ($id) {	$this->arr['bus_id'] = $id;	}
		public function setName ($name) {	$this->arr['name'] = $name;	}
		public function setCity ($city) {	$this->arr['city'] = $city;	}
		public function setStreet ($street) {	$this->arr['street'] = $street;	}
		public function setZip ($zip) {	$this->arr['zip'] = $zip;	}
		public function setTelephone ($tel) {	$this->arr['tel'] = $tel;	}
		public function setDescription ($desc) {	$this->arr['desc'] = $desc;	}
		//      set methods end
		
		//      get methods
		public function getId () {	return $this->arr['bus_id'];	}
		public function getName () {	return $this->arr['name'];	}
		public function getCity () {	return $this->arr['city'];	}
		public function getStreet () {	return $this->arr['street'];	}
		public function getZip () {	return $this->arr['zip'];	}
		public function getTelephone () {	return $this->arr['tel'];	}
		public function getDescription () {	return $this->arr['desc'];	}
		public function getArray () {	return $this->arr;	}
		//      get methods end
		
		public function jsonSerialize()
		{
			return $this->arr;
		}
	}

?>