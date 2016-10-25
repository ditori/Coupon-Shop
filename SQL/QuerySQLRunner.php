<?php

	trait QuerySQLRunner
	{
		/*  INPUT: SQL query, array of values to insert to the preapared query, object type
			OUTPUT: run the query and if needed return an object, else return true value
		*/
		public function runQuery($qry, $vals, $ob_type)
		{
			$myserver= $this->myserver;
			$result = $myserver->prepare($qry, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

			$result->execute($vals);
			$arr= array();
			$cnt= 0;
			if ($result) // checking if the coupon was found in the database
			{ 		// in case the query succeeded
				if ($ob_type!=null)
				{
					while ($fetch= $result->fetch(PDO::FETCH_ASSOC))
					{
						$ob= new $ob_type ($fetch); 	// creating new coupon that holds the SQL query result
						$arr[$cnt++]= $ob;
					}

					$result= null;
					return $arr;
				}
				else
				{
					$result= null;
					return true;
				}
			}
			else
			{ 		// in case the query failed
				if ($ob_type!=null)
					return null;
				else
					return false;
			}
		}
	}

?>
