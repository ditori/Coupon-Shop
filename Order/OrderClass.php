<?php
	class Order implements JsonSerializable
	{
		private $arr;

		function __construct ($arr)
		{
			$this->arr= $arr;
		}

		//      set methods
		public function setOrderId($id) 	{	$this->arr['order_id']= $id;	}
		public function setUserId($id) 	{	$this->arr['user_id']= $id;	}
		public function setStatus($status) 	{	$this->arr['status']= $status;	}
		public function setTotalPrice($total_price) 	{	$this->arr['total_price']= $total_price;	}
		public function setOrderDate($order_date) 	{	$this->arr['order_date']= $order_date;	}

		//      get methods
		public function getOrderId() 	{	return $this->arr['order_id'];	}
		public function getUserId() 	{	return $this->arr['user_id'];	}
		public function getStatus() 	{	return $this->arr['status'];	}
		public function getTotalPrice() 	{	return $this->arr['total_price'];	}
		public function getOrderDate() 	{	return $this->arr['order_date'];	}
		public function getArray () {	return $this->arr;	}

		public function jsonSerialize()
		{
			return $this->arr;
		}
	}
?>
