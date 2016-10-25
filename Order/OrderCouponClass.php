<?php

	class OrderCoupon implements JsonSerializable
	{
		private $arr;

		function __construct ($arr)
		{
			$this->arr = $arr;
		}

		// set methods
		public function setOrderId ($order_id) {	$this->arr['order_id']= $order_id;	}
		public function setCouponId ($coupon_id) {	$this->arr['coupon_id']= $coupon_id;	}
		public function setQuantity ($qnt) {	$this->arr['quantity']= $qnt;	}
		// set methods end

		// get methods
		public function getOrderId () {	return $this->arr['order_id'];	}
		public function getCouponId () {	return $this->arr['coupon_id'];	}
		public function getQuantity () {	return $this->arr['quantity'];	}
		public function getArray () {	return $this->arr;	}
		// get methods end

		public function jsonSerialize()
		{
			return $this->arr;
		}
	}

?>
