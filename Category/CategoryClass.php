<?php
	class Category implements JsonSerializable
	{
		private $arr;

		function __construct ($arr)
		{
			$this->arr= $arr;
		}

		//      set methods
		public function setId($id) 	{	$this->arr['category_id']= $id;	}
		public function setName($name) 	{	$this->arr['name']= $name;	}

		//      get methods
		public function getId() 	{	return $this->arr['category_id'];	}
		public function getName() 	{	return $this->arr['name'];	}
		public function getArray () {	return $this->arr;	}

		public function jsonSerialize()
		{
			return $this->arr;
		}
	}
?>
