<?php

class DB
{
	private $pdo;
	private $stmt;
	
	public $result;
	public $num_rows;
	public $result_array = array();
	public $result_object = array();



/*
//	DB Driver
*/
	public function __construct()
	{
		if (file_exists(APPPATH .'config/database.php'))
		{
			include(APPPATH .'config/database.php');
		}
		// Validate & get reserved routes
		if (isset($dbconfig) && is_array($dbconfig))
		{
			$hostname = $dbconfig['hostname'];
			$username = $dbconfig['username'];
			$password = $dbconfig['password'];
			$dbname = $dbconfig['dbname'];
			$charset = $dbconfig['charset'];
		}
		
		$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$hostname.";charset=".$charset, $username, $password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	public function query($sql)
	{
		$this->stmt = $this->pdo->prepare($sql);
		$this->stmt->execute();
		
		return $this;
	}



/*
//	DB Query Driver
*/
	public function insert($table, $data = array())
	{
		$keys = array_keys($data);
		$values = array_values($data);
		// Prepare sql
		$sql = 'INSERT INTO `'.$table
				.'` (`'.implode('`, `', $keys).'`)'
				.' VALUES (\''.implode('\', \'', $values).'\')';
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function update($table, $where, $data = array())
	{
		foreach($where as $key => $val)
		{
			$val = is_int($val) ? $val : '\''.$val.'\'';
			$whr[] = '`'.$key.'` = '.$val;
		}
		
		foreach($data as $key => $value)
		{
			$value = is_int($value) ? $value : '\''.$value.'\'';
			$set[] = '`'.$key.'` = '.$value;
		}
		// Prepare sql
		$sql = 'UPDATE `'.$table
				.'` SET '.implode(', ', $set)
				.' WHERE '.implode(' AND ', $whr);
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function delete($table, $where = array())
	{
		if (is_array($table))
		{
			foreach ($table as $single_table)
			{
				$this->delete($single_table, $where);
			}
			return;
		}
		
		foreach($where as $key => $val)
		{
			$val = is_int($val) ? $val : '\''.$val.'\'';
			$whr[] = '`'.$key.'` = '.$val;
		}
		// Prepare sql
		$sql = 'DELETE FROM `'.$table
				.'` WHERE '.implode(' AND ', $whr);
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function get($table, $orderby = array(), $limits = '')
	{
		if(count($orderby) > 1){
			$last = end($orderby);
			array_pop($orderby);
			$order = ' ORDER BY `' . implode('`, `', $orderby) . '` ' . $last;
		} else { $order = ''; }
		$limit = (!empty($limits)) ? ' LIMIT ' . $limits : '';
		
		if($table != '')
		{
			// Prepare sql
			$sql = "SELECT * FROM `"
					. $table . "`"
					. $order
					. $limit;
		}
		
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function get_where_in($table, $keys, $values, $data = array(), $orderby = array())
	{
		if(count($orderby) > 1){
			$last = end($orderby);
			array_pop($orderby);
			$order = ' ORDER BY `' . implode('`, `', $orderby) . '` ' . $last;
		} else { $order = ''; }
		
		foreach($data as $key => $value)
		{
			$value = is_int($value) ? $value : "'" . $value . "'";
			$where[] = '`' . $key . '` = ' . $value;
		}
		$whr = (isset($where) && count($where) > 0) ? ' AND ' . implode(' AND ', $where) : $whr = '';
		
		if(!is_array($values))	$values = array($values);
		$where_in = array();
		foreach ($values as $val)
		{
			$val = is_int($val) ? $val : "'" . $val . "'";
			$where_in[] = $val;
		}
		// Prepare sql
		$sql = "SELECT * FROM `".$table
				. "` WHERE `" . $keys . "` IN (" . implode(', ', $where_in) . ")"
				. $whr
				. $order;
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function get_where_not_in($table, $keys, $values, $data = array(), $orderby = array())
	{
		if(count($orderby) > 1){
			$last = end($orderby);
			array_pop($orderby);
			$order = ' ORDER BY `' . implode('`, `', $orderby) . '` ' . $last;
		} else { $order = ''; }
		
		foreach($data as $key => $value)
		{
			$value = is_int($value) ? $value : "'" . $value . "'";
			$where[] = '`' . $key . '` = ' . $value;
		}
		$whr = (isset($where) && count($where) > 0) ? ' AND ' . implode(' AND ', $where) : $whr = '';
		
		if(!is_array($values))	$values = array($values);
		$where_in = array();
		foreach ($values as $val)
		{
			$val = is_int($val) ? $val : "'" . $val . "'";
			$where_in[] = $val;
		}
		// Prepare sql
		$sql = "SELECT * FROM `".$table
				. "` WHERE `" . $keys . "` NOT IN (" . implode(', ', $where_in) . ")"
				. $whr
				. $order;
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function get_where($table, $data = array(), $orderby = array(), $groupby = array(), $limits = 0)
	{
		if(count($orderby) > 1){
			$last = end($orderby);
			array_pop($orderby);
			$order = ' ORDER BY `' . implode('`, `', $orderby) . '` ' . $last;
		} else { $order = ''; }
		$group = (count($groupby) > 1) ? ' GROUP BY `' . implode('` ', $groupby) : $group = '';
		$limit = (!empty($limits)) ? ' LIMIT ' . $limits : '';
		
		foreach($data as $key => $value)
		{
			$value = is_int($value) ? $value : "'" . $value . "'";
			$where[] = '`' . $key . '` = ' . $value;
		}
		// Prepare sql
		$sql = "SELECT *"
				. " FROM `" . $table
				. "` WHERE " . implode(' AND ', $where)
				. $order
				. $group
				. $limit;
		// Query sql
		$this->query($sql);
		
		return $this;
	}
	
	public function count_all($table = '')
	{
		if ($table === '')
		{
			return 0;
		}
		// Prepare sql
		$sql = 'SELECT * FROM ' . $table;
		//	Query sql
		$this->query($sql);
		
		if ($this->num_rows() === 0)
		{
			return 0;
		}
		
		return (int)$this->num_rows;
	}
	
	public function select_sum($table, $val, $val_sum, $where = array())
	{
		foreach($where as $key => $value)
		{
			$value = is_int($value) ? $value : '\'' . $value . '\'';
			$where[] = '`' . $key . '` = ' . $value;
		}
		$whr = (count($where) > 1) ? 'WHERE ' . implode(' AND ', $where) : '';
		
		// Prepare sql
		$sql = 'SELECT SUM(' . $val . ') AS ' . $val_sum
				. ' FROM `' . $table . '`'
				. $whr;
		//	Query sql
		$this->query($sql);
		
		return $this;
	}



/*
//	DB Result
*/
	public function num_rows()
	{
		// Retrieve query result
		$this->num_rows = $this->stmt->rowCount();
		
		return $this->num_rows;
	}
	
	public function result($type = 'object')
	{
		if($type === 'array')
		{
			return $this->result_array();
		}
		elseif($type === 'object')
		{
			return $this->result_object();
		}
	}
	
	public function result_array()
	{
		$this->result_array = array();
		
		if ($this->num_rows() > 0)
		{
			while($row = $this->stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->result_array[] = $row;
			}
		}
		
		return $this->result_array;
	}
	
	public function result_object()
	{
		$this->result_object = array();
		
		if ($this->num_rows() > 0)
		{
			while($row = $this->stmt->fetch(PDO::FETCH_OBJ))
			{
				$this->result_object[] = $row;
			}
		}
		
		return $this->result_object;
	}
	
	public function row()
	{
		// Retrieve query result
		$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
		
		return $this->result;
	}
	
	public function first_row($type = 'object')
	{
		$result = $this->result($type);
		return (count($result) === 0) ? NULL : $result[0];
	}
	
	public function last_row($type = 'object')
	{
		$result = $this->result($type);
		return (count($result) === 0) ? NULL : $result[count($result) - 1];
	}
	
	public function insert_id()
	{
		return $this->pdo->lastInsertId();
	}
	
}