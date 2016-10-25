<?php

	class User implements JsonSerializable
	{
		private $arr;

		function __construct ($arr)
		{
			$this->arr= $arr;
		}

		//      set methods
		public function setId ($id) {	$this->arr['user_id'] = $id;	}
		public function setName ($name) {	$this->arr['username'] = $name;	}
		public function setPassword ($pass) {	$this->arr['password'] = $pass;	}
		public function setSignUp ($signup) {	$this->arr['sign_up_date'] = $signup;	}
		public function setEmail ($email) {	$this->arr['email'] = $email;	}
		public function setPermissions ($perm) {	$this->arr['permissions'] = $perm;	}
		public function setFirstName ($f_name) {	$this->arr['first_name'] = $f_name;	}
		public function setLastName ($l_name) {	$this->arr['last_name'] = $l_name;	}
		public function setBussinessId ($bus_id) {	$this->arr['business_id'] = $bus_id;	}
		//      set methods end

		//      get methods
		public function getId () {	return $this->arr['user_id'];	}
		public function getName () {	return $this->arr['username'];	}
		public function getPassword () {	return $this->arr['password'];	}
		public function getSignUp () {	return $this->arr['sign_up_date'];	}
		public function getEmail () {	return $this->arr['email'];	}
		public function getPermissions () {	return $this->arr['permissions'];	}
		public function getFirstName () {	return $this->arr['first_name'];	}
		public function getLastName () {	return $this->arr['last_name'];	}
		public function getBussinessId () {	return $this->arr['business_id'];	}
		public function getArray () {	return $this->arr;	}
		//      get methods end

		public function jsonSerialize()
		{
			return $this->arr;
		}
	}

?>
