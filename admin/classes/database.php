<?php

include_once("config.php");

class Database{
	private $db_host = SERVIDOR_HOST; 
	private $db_name = BASE_DE_DATOS; 
	private $db_user = USUARIO_BD; 
	private $db_pass = PASSWORD_BD;
	private $result = array(); 			// Results that are returned from the query
    private $con = false;               // Checks to see if the connection is active
	private $numResults = 0;

	public function connect($database = null)
    {
        if(!$this->con)
        {
            $myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
            if($myconn)
            {
				if($database != null){
					$this->db_name = $database;
				}
				
                $seldb = @mysql_select_db($this->db_name,$myconn);
                if($seldb)
                {
					//mysql_query ("SET NAMES 'utf8'");
					
                    $this->con = true; 
                    return true; 
                } else
                {
                    return false; 
                }
            } else
            {
                return false; 
            }
        } else
        {
            return true; 
        }
    }

	public function disconnect()
	{
		if($this->con)
		{
			if(@mysql_close())
			{
				$this->con = false; 
				return true; 
			}
			else
			{
				return false; 
			}
		}
	}	

	public function select($table, $rows = '*', $where = null, $order = null, $alias = null)
    {
		$tables_query = null;
		$tables = explode(",",$table);
		$alias_array = null;
		
		if($alias != null)
			$alias_array = explode(",",$alias);
		
		if(sizeof($tables)>1){
			for($i=0;$i<sizeof($tables);$i++){
				if(!($this->tableExists($tables[$i]))){
					return false;
				}
				if($i==0)
					$tables_query = $tables[$i]." ".trim($alias_array[$i]);
				else
					$tables_query.= ", ".$tables[$i]." ".trim($alias_array[$i]);
			}
	        $q = 'SELECT '.$rows.' FROM '.$tables_query;		
		}
		else{
			if(!($this->tableExists($table))){
				return false;
			}
	        $q = 'SELECT '.$rows.' FROM '.$table;		
		}
	
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;
		
		$query = @mysql_query($q);
		if($query)
		{
			$this->numResults = mysql_num_rows($query);
			for($i = 0; $i < $this->numResults; $i++)
			{
				$r = mysql_fetch_array($query);
				$key = array_keys($r); 
				for($x = 0; $x < count($key); $x++)
				{
					// Sanitizes keys so only alphavalues are allowed
					if(!is_int($key[$x]))
					{
						if(mysql_num_rows($query) > 1)
							$this->result[$i][$key[$x]] = $r[$key[$x]];
						else if(mysql_num_rows($query) < 1)
							$this->result = null; 
						else
							$this->result[$key[$x]] = $r[$key[$x]]; 
					}
				}
			}	            
			return true; 
		}
		else
		{
			return false; 
		}
    }
	
	public function openQuery($query = null)
    {
		if($query == null)
			return false;
					
		$query = @mysql_query($query);
		if($query)
		{
			$this->numResults = mysql_num_rows($query);
			for($i = 0; $i < $this->numResults; $i++)
			{
				$r = mysql_fetch_array($query);
				$key = array_keys($r); 
				for($x = 0; $x < count($key); $x++)
				{
					// Sanitizes keys so only alphavalues are allowed
					if(!is_int($key[$x]))
					{
						if(mysql_num_rows($query) > 1)
							$this->result[$i][$key[$x]] = $r[$key[$x]];
						else if(mysql_num_rows($query) < 1)
							$this->result = null; 
						else
							$this->result[$key[$x]] = $r[$key[$x]]; 
					}
				}
			}	            
			return true; 
		}
		else
		{
			return false; 
		}
    }	
	
	public function openTransaction($query = null)
    {
		if($query == null)
			return false;
					
		$query = @mysql_query($query) or die (mysql_error());
		if($query){	return true; }
		else
			return false; 
    }		
	
	public function getNumResults(){
		return $this -> numResults;
	}

	public function begin()
	{
		$begin = @mysql_query("BEGIN");            
		if($begin)
		{
			return true; 
		}
		else
		{
			return false; 
		}
	}
	
	
	public function commit()
	{
		$commit = @mysql_query("COMMIT");            
		if($commit)
		{
			return true; 
		}
		else
		{
			return false; 
		}
	}
	
	public function rollback()
	{
		$rollback = @mysql_query("ROLLBACK");            
		if($rollback)
		{
			return true; 
		}
		else
		{
			return false; 
		}
	}


	public function insert($table,$values,$rows = null)
    {
        if($this->tableExists($table))
        {
            $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')'; 
            }

            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';
            $ins = @mysql_query($insert);            
            if($ins)
            {
                return true; 
            }
            else
            {
                return false; 
            }
        }
    }

	public function delete($table,$where = null)
    {
        if($this->tableExists($table))
        {
            if($where == null)
            {
                $delete = 'DELETE '.$table; 
            }
            else
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; 
            }
            $del = @mysql_query($delete);

            if($del)
            {
                return true; 
            }
            else
            {
               return false; 
            }
        }
        else
        {
            return false; 
        }
    }

	public function update($table,$rows,$where)
    {
		$where_clause = null;
		
        if($this->tableExists($table))
        {            
            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows); 
            for($i = 0; $i < count($rows); $i++)
           {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }
                
                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ','; 
                }
            }
            $update .= ' WHERE '.$where;
            $query = @mysql_query($update) or die ($update);
            if($query)
            {
                return true; 
            }
            else
            {
                return false; 
            }
        }
        else
        {
            return false; 
        }
    }
	
    public function getResult()
    {
        return $this->result;
    }	

	private function tableExists($table)
    {
        $tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.trim($table).'"');
        if($tablesInDb)
        {
            if(mysql_num_rows($tablesInDb)==1)
            {
                return true; 
            }
            else
            { 
                return false; 
            }
        }
    }
	
	public function currentDate(){
		return date("Y-m-d H:i:s");
	}

	public function getSubString($string, $length=NULL)
	{
    //Si no se especifica la longitud por defecto es 50
    if ($length == NULL)
        $length = 50;
    //Primero eliminamos las etiquetas html y luego cortamos el string
    $stringDisplay = substr(strip_tags($string), 0, $length);
    //Si el texto es mayor que la longitud se agrega puntos suspensivos
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;
}
	
}
?>