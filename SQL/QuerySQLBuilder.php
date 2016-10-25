<?php

	trait QuerySQLBuilder
	{
		/*  INPUT: array of the tables names, tags data to show, array of the filters
			OUTPUT: SQL query that finds in the tables all the data related to the filters and returns data with the relevent tags
		*/
		public function getFilteredQuery ($tables, $tags, $filters, $ob_type)
		{
			// starting bulding the SQL query
			$tgs = implode(',', $tags);
			$tbls = implode(',', $tables);

			$qry= "SELECT $tgs FROM $tbls";

			if ($filters==null) 	// in case there are no filters
				return $this->runQuery($qry, null, $ob_type);

			$qry= "$qry WHERE";

			$cnt= 0;	// flag to know if we are in the first item
			$vals= array();

			foreach ($filters as $tag => $val)
			{
				$vals[$cnt]= $val;
				if (($cnt++)!=0)	{	$qry= "$qry AND";	} // as long as it is not the first value add comma

				$qry= "$qry $tag = ?";
			}
			// end of SQL query

			return $this->runQuery($qry, $vals, $ob_type);

		}


		/*  INPUT: table name, array of the values and their tags and the tag name of the table index
			OUTPUT: SQL query that insert to the table the recived data
		*/
		public function insertQuery ($table, $arr, $index)
		{
			$qry= "INSERT INTO $table (";

			$cnt= 0;	// flag to know if we are in the first item
			$vals= array();
			// creating the query tags array
			foreach ($arr as $tag => $val)
			{
				if ($tag != $index) // not prime key thet get value from the server.
				{
					$vals[$cnt]= $val;
					if (($cnt++)!=0)	{	$qry= $qry . ', ';	} // as long as it is not the first value add comma

					$qry= $qry . $tag;
				}
			}

			$flg= 0; 	// restarting the flag

			$qry= $qry . ') VALUES (';

			$place_holder= implode (',', array_fill(0, count($vals), '?'));
			$qry = $qry . $place_holder;

			$qry= $qry . ")";
			// end of SQL query

			return $this->runQuery($qry, $vals, null);
		}

		/*  INPUT: tables name, array of the values and their tags, array of the filters
			OUTPUT: SQL query that update relevent item in the table with the recived data
		*/
		public function updateQuery ($table, $arr, $filters)
		{
			// starting bulding the SQL query
			$qry= "UPDATE $table SET ";

			$cnt= 0;	// flag to know if we are in the first item
			$vals= array();

			foreach ($arr as $tag => $val)
			{
				$vals[$cnt]= $val;
				if (($cnt++)!=0) // as long as it is not the first value add comma
				{
					$qry= $qry . ', ';
				}
				$qry= $qry . $tag . '= ? ';
			}

			$flg= 0;
			$qry= "$qry WHERE";
			foreach ($filters as $tg => $vl)
			{
				$vals[$cnt++]= $vl;
				if (($flg++)!=0) // as long as it is not the first value add comma
				{
					$qry= "$qry AND";
				}
				$qry= "$qry $tg  = ? ";
			}
			// end of SQL query

			return $this->runQuery($qry, $vals, null);
		}

		/*  INPUT: tables name and array of the filters
			OUTPUT: SQL query that delete relevent item in the table with the recived data
		*/
		public function deleteQuery ($table, $filters)
		{
			$cnt= 0;	// flag to know if we are in the first item
			$vals= array();

			// starting bulding the SQL query
			$qry= "DELETE FROM $table WHERE";

			foreach ($filters as $tg => $vl)
			{
				if ($cnt!=0) // as long as it is not the first value add comma
				{
					$qry= "$qry AND";
				}
				$vals[$cnt++]= $vl;
				$qry= "$qry $tg  = ? ";
			}
			// end of SQL query
			return $this->runQuery($qry, $vals, null);
		}
	}

?>
