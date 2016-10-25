<?php

	require_once __DIR__ . '/UserClass.php';
	require_once __DIR__ . '/../SQL/QuerySQLBuilder.php';
	require_once __DIR__ . '/../SQL/QuerySQLRunner.php';

	interface IUsersDAO
	{
		public function getUser($id);
		public function getUserByUserName($username);
		public function addUser(User $ob);
		public function getAllUsers();
		public function updateUser(User $ob);
		public function removeUser(User $ob);
		public function checkUser($username);
		public function checkEmail($email);
	}

	class UsersDAO implements IUsersDAO
	{
		private $myserver;
		private static $singleInstance;

		use QuerySQLBuilder;
		use QuerySQLRunner;

		function __construct ($server)
		{
			if(UsersDAO::$singleInstance==null)
			{
				$this->myserver= $server;
			}
		}

		public static function getInstance()
		{
			if(UsersDAO::$singleInstance==null) // checking if the object exist
			{ // in case the object does not exist we create a new one
				UsersDAO::$singleInstance = new SingletonClass();
			}
			return UsersDAO::$singleInstance;
		}

		/*  INPUT: id of a specific user
			OUTPUT: the user object if was found, else null.
		*/
		public function getUser ($id)
		{
			$filter= ['user_id' => $id];
			$ob = $this->getFilteredQuery(['users'], ['*'] , $filter, 'User');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}


		/*  INPUT: user name of a specific user
			OUTPUT: the user object if found, else null.
		*/
		public function getUserByUserName ($username)
		{
			$filter= ['username' => $username];
			$ob = $this->getFilteredQuery(['users'], ['*'] , $filter, 'User');
			if ($ob!=null)
				return $ob[0];
			else
				return null;
		}

		/*  INPUT: User object
			OUTPUT: True if the user added to the database, False if not.
		*/
		public function addUser(User $ob)
		{
			//checking if it is a valid email
			if (!filter_var($ob->getEmail(), FILTER_VALIDATE_EMAIL))
			{
  				return "Invalid";
			}

			// getting query that adds the user to the database
			$result= $this->insertQuery('users', $ob->getArray(), 'user_id');
			return $result;
		}

		/*
			OUTPUT: array of User class objects that holds all the table users.
		*/
		public function getAllUsers()
		{
			// returning all the users in the database
			$ob = $this->getFilteredQuery(['users'], ['*'] , null, 'User');
			return $ob;
		}

		/*  INPUT: User object
			OUTPUT: True if the user updated in the database, False if not.
		*/
		public function updateUser(User $ob)
		{
			//checking if it is a valid email
			if (!filter_var($ob->getEmail(), FILTER_VALIDATE_EMAIL))
			{
  				return "Invalid";
			}

			// getting query that search for the user in the database and update his data
			$filter= ['user_id' => $ob->getId()];
			$result= $this->updateQuery('users', $ob->getArray(), $filter);
			return $result;
		}

		/*  INPUT: User object
			OUTPUT: True if the user removed from the database, False if not.
		*/
		public function removeUser(User $ob)
		{
			// getting query that search for the user in the database and remove his data
			$filter= ['user_id' => $ob->getId()];
			$result= $this->deleteQuery('users', $filter);
			return $result;
		}

		/*  INPUT: username of the specific user
			OUTPUT: true if the user was found in the table, else false.
		*/
		public function checkUser($username)
		{
			// getting query that search for the username in the database
			$filter= ['username' => $username];
			$result= $this->getFilteredQuery(['users'], ['*'], $filter, 'User');
			if ($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/*  INPUT: email
			OUTPUT: true if there is a user with the same email in the table, else false.
		*/
		public function checkEmail($email)
		{
			//checking if it is a valid email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
  				return "Invalid";
			}

			// getting query that search for the email in the database
			$filter= ['email' => $email];
			$result= $this->getFilteredQuery(['users'], ['*'], $filter, 'User');
			if ($result!=null)
				return true;
			else
				return false;
		}
	}

?>
