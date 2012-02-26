<?php


class Database {

	protected $_dbHandle;
    protected $_result;
		
	function __construct() {
		
	 	
	}
	

    /** Connects to database **/

    function connect($address, $account, $pwd, $name) {
        $this->_dbHandle = @mysql_connect($address, $account, $pwd);
        if ($this->_dbHandle != 0) {
            if (mysql_select_db($name, $this->_dbHandle)) {
                return 1;
            }
            else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }

    /** Disconnects from database **/

    function disconnect() {
        if (@mysql_close($this->_dbHandle) != 0) {
            return 1;
        }  else {
            return 0;
        }
    }

    function selectAll() {
    	$query = 'select * from `'.$this->_table.'`';
    	return $this->query($query);
    }

    function select($id) {
    	$query = 'select * from `'.$this->_table.'` where `id` = \''.mysql_real_escape_string($id).'\'';
    	return $this->query($query, 1);
    }

    /** Custom SQL Query **/

	function query($query, $singleResult = 0) {

		$this->_result = mysql_query($query, $this->_dbHandle);

		if (preg_match("/select/i",$query)) {
		$result = array();
		$table = array();
		$field = array();
		$tempResults = array();
		$numOfFields = mysql_num_fields($this->_result);
		for ($i = 0; $i < $numOfFields; ++$i) {
		    array_push($table,mysql_field_table($this->_result, $i));
		    array_push($field,mysql_field_name($this->_result, $i));
		}

			while ($row = mysql_fetch_row($this->_result)) {
				for ($i = 0;$i < $numOfFields; ++$i) {
					$table[$i] = trim(ucfirst($table[$i]),"s");
					$tempResults[$table[$i]][$field[$i]] = $row[$i];
				}
				if ($singleResult == 1) {
		 			mysql_free_result($this->_result);
					return $tempResults;
				}
				array_push($result,$tempResults);
			}
			mysql_free_result($this->_result);
			return($result);
		}

	}

    /** Get number of rows **/
    function getNumRows() {
        return mysql_num_rows($this->_result);
    }

	function getInsertId() {
		return mysql_insert_id();
	}
	
    /** Free resources allocated by a query **/

    function freeResult() {
        mysql_free_result($this->_result);
    }

    /** Get error string **/

    function getError() {
        return mysql_error($this->_dbHandle);
    }
	
	public function query_old($query)
	{
		$result = mysql_query($query) or die(mysql_error());
		
		//start making an associative array containing returned results
		$fetch = array();
		$i = 0;
		while($fetch[$i] = mysql_fetch_assoc($result)) $i++;
		
		return $fetch;
	
	}
}

