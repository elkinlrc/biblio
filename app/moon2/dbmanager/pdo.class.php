<?php
class Moon2_DBmanager_PDO{
    private $_index;
    private $_driver;
    private $_objPdo;
    private $_msgError;
    private $_parameters;
    protected $_conexion;

    protected $_CONFIG;
    protected $_DOM;
    protected $_arrFields;
    protected $_arrSearch;
    protected $_table;
    protected $_Pkey;
    protected $_sequence;

public function __construct($test = false, $index = 1){
    global $CONFIG;
    global $DOM;

    $this->_DOM = &$DOM;
    $this->_CONFIG = &$CONFIG;

    $this->_table = "";
    $this->_sequence = "";
    $this->_Pkey = array();
    $this->_index = $index;
    $this->_arrFields = array();
    $this->_arrSearch = array();
    $this->_driver = $this->_CONFIG["DRIVER"][$this->_index];

    try {
        $strConexion = $this->_driver.":host=".$this->_CONFIG["HOST"][$this->_index].";dbname=".$this->_CONFIG["DBNAME"][$this->_index];
        $this->_conexion = new PDO($strConexion, $this->_CONFIG["USERNAME"][$this->_index], $this->_CONFIG["PASSWORD"][$this->_index], $this->_CONFIG["DRIVER_OPTIONS"][$this->_index]);
    }catch (PDOException $Error){
        if ($test){
            //This code is used to prove the existence of the database, the username and password
            $this->_msgError = $Error->getMessage();
        }else{
            echo "<p><strong>Message Framework MOON2:</strong><br />";
            echo "Error configuration database:<br />".$Error->getMessage()."</p>";
            die();
        }
    }
}

/**
 * Return string with error
 *
 * @return [string]     string
*/
public function get_msgError(){
    return $this->_msgError;
}


/**
 * Return true or false for sql statement. 
 *
 * @param [sql]			SQL statement
 * @param [inputArr]	input bind array 
 *
 * @return [flag]		boolean
*/
public function ExecuteSql($sql, $inputArr = array()){
	$this->_parameters = $inputArr;
	$this->_objPdo = $this->_conexion->prepare($sql);
	$result = $this->_objPdo->execute($this->_parameters);
	$this->_objPdo->closeCursor();
	$this->debug();
	return $result;
}


/**
 * Return full array.
 *
 * @param [sql]			SQL statement
 * @param [inputArr]	input bind array 
 *
 * @return [outputArr] 	array
*/
public function GetAll($sql, $inputArr = array()){
	$this->_parameters = $inputArr;
	$this->_objPdo = $this->_conexion->prepare($sql);
	$this->_objPdo->execute($this->_parameters);
	$outputArr = $this->_objPdo->fetchAll(PDO::FETCH_ASSOC);
	$this->_objPdo->closeCursor();
	$this->debug();
	return $outputArr;
}


/**
 * Return first element of first row of sql statement.
 *
 * @param [sql]			SQL statement
 * @param [inputArr]		input bind array
 *
 * @return [value]		data field value
*/
public function GetOne($sql, $inputArr = array()){
	$this->_parameters = $inputArr;
	$this->_objPdo = $this->_conexion->prepare($sql);
	$this->_objPdo->execute($this->_parameters);
	$value = $this->_objPdo->fetchColumn();
	$this->_objPdo->closeCursor();
	$this->debug();
	return $value;
}


/**
 * Return first row of sql statement.
 *
 * @param [sql]			SQL statement
 * @param [inputArr]	input bind array
 *
 * @return [outputArr]	array data
*/
public function GetRow($sql, $inputArr = array()){
	$this->_parameters = $inputArr;
	$this->_objPdo = $this->_conexion->prepare($sql);
	$this->_objPdo->execute($this->_parameters);
	$outputArr = $this->_objPdo->fetch(PDO::FETCH_ASSOC);
	$this->_objPdo->closeCursor();
	$this->debug();
	return $outputArr;
}


/**
 * return whole recordset as a 2-dimensional associative array if there are more than 2 columns. 
 * The first column is treated as the key and is not included in the array. 
 * If there is only 2 columns, it will return a 1 dimensional array of key-value pairs.
 *
 * @param [sql]			SQL statement
 * @param [inputArr]	input bind array
 *
 * @return an associative array indexed by the first column of the array, 
 * 	or false if the data has less than 2 cols.
*/
public function GetAssoc($sql, $inputArr = array()){
	$this->_parameters = $inputArr;
	$this->_objPdo = $this->_conexion->prepare($sql);
	$this->_objPdo->execute($this->_parameters);
	$numCols = $this->_objPdo->columnCount();
	if ($numCols > 1 ){
		$outputArr = array();
		$row = $this->_objPdo->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		while ($row){
			$cols = 1;
			if ($numCols == 2 ){
				foreach ($row as $key => $value){
					if ($cols == 1){
						$llave = $value;
						$cols++;
					}else{
						$outputArr[$llave] = $value;
					}
				}
			}else{
				foreach ($row as $key => $value){
					if ($cols == 1){
						$llave = $value;
						$cols++;
					}else{
						$temp[$key] = $value;
					}
				}
				reset($temp);
				$outputArr[$llave] = $temp;
			}
			$row = $this->_objPdo->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		}
	}else{
		$outputArr = false;
	}
	$this->_objPdo->closeCursor();
	$this->debug();
	return $outputArr;
}


/**
 * Will select, getting rows from $offset (1-based), for $nrows. 
 * This simulates the MySQL "select * from table limit $offset,$nrows" , and
 * the PostgreSQL "select * from table limit $nrows offset $offset". Note that
 * MySQL and PostgreSQL parameter ordering is the opposite of the other.
 *
 * @param [sql]			SQL statement
 * @param [offset]		is the row to start calculations from (1-based)
 * @param [nrows]		is the number of rows to get
 * @param [inputarr]	array of bind variables
 *
 * @return [outputArr] 	array
*/
public function SelectLimit($sql, $nrows=-1, $offSet=-1, $inputArr = array()){
    switch ($this->_driver){
        case "pgsql":
                $sql.=" LIMIT ".$nrows." OFFSET ".$offSet;
        break;
    }
    $outputArr = $this->GetAll($sql, $inputArr);
    return $outputArr;
}


/**
* Show errors and sql.
*
* @return [true]		boolean
*/
private function debug(){
    if ($this->_objPdo instanceof PDOStatement && $this->_CONFIG["DB_DEBUG"][$this->_index]) {
        $this->_indexError = 2;
        ob_start();
            $this->_objPdo->debugDumpParams();
            $output = ob_get_contents();
        ob_end_clean();
        $sql = strstr($output, "Params:", true);
        echo "<p>".$sql."</p>";
        if (!empty($this->_parameters)){
            echo "<p>Parameters:<br />";
            foreach ($this->_parameters as $key => $value){
                echo $key.": ? => ".$value."<br />";
            }
            echo "</p>";
        }
        $Error = $this->_objPdo->errorInfo();
        echo "<p>".$Error[$this->_indexError]."</p>";
    }
    return true;
}


/**
 * Set field search.
 *
 * @param [key]			array key
 * @param [field]		field value
 *
 * @return [true]		boolean, always true
*/
public function add_searchField($key, $field) {
    $this->_arrSearch[$key] = $field;
    return true;
}


/**
 * Build Translate search condition.
 *
 * @param [field]		field search
 * @param [strWords]	Words search
 * @param [operator]	And - OR
 *
 * @return [Where]		SQL condition for Where
*/
protected function strWhere($field, $strWords, $operator){
    $Where = "";
    $strWords = trim($strWords);
    $arr_Words = explode(" ",$strWords);
    $arr_keys = array_keys($arr_Words);
    $last = array_pop($arr_keys);
    foreach($arr_Words as $key => $word){
        if(trim($arr_Words[$key]) != "") {
            $Where.="translate(lower(cast(".$field." as text)),'áàéèíìóòúù','aaeeiioouu') LIKE lower(('%' || translate(lower('".trim($arr_Words[$key])."'),'áàéèíìóòúù','aaeeiioouu') || '%'))";
            if ($last != $key) $Where.=" ".$operator." ";
        }
    }
    return $Where;
}


/**
 * Build Translate search condition.
 *
 * @param [arrSearch]		field search and value
 *
 * @return [Where]			SQL condition for Where
*/
protected function get_where($arrSearch, $other=""){
    $where = "";
    if (!array_key_exists (null, $arrSearch)){
        $arr_keys = array_keys($arrSearch);
        $key = array_shift($arr_keys);
        $search_value = $arrSearch[$key];
        $search_field = $this->_arrSearch[$key];
        $where = $this->strWhere($search_field, $search_value, "AND");
    }
    if (!empty($where)){
        $where = " {$other} ".$where;
        if (empty($other)){
                $where = " WHERE ".$where;
        }
    }
    return $where;
}

//pendiente para ajuste y actualizacion
public function AutoExecute($mode, $where = FALSE, $index = FALSE){
    $strSql = "";
    $flag = false;
    $strFields = "";
    switch((string) $mode){
        case "INSERT":
            foreach($this->_arrFields as $field => $value){
                $strFields.= $field.",";
            }
            $strFields = substr($strFields, 0, (strlen($strFields)-1));
            $strSql = "INSERT INTO {$this->_table}({$strFields}) VALUES (?".str_repeat(",?",count($this->_arrFields)-1).")";

            $flag = $this->ExecuteSql($strSql, array_values($this->_arrFields));
            if ($index != false){
                $last_value = $this->_conexion->lastInsertId($index);			
                $flag = $last_value;
            }
        break;
        case "UPDATE":
            foreach($this->_arrFields as $field => $value){
                $strFields.= $field."= ?,";
            }
            $strFields = substr($strFields, 0, (strlen($strFields)-1));
            $strSql ="UPDATE {$this->_table} SET {$strFields} {$where}";
            $flag = $this->ExecuteSql($strSql, array_values($this->_arrFields));
        break;
        case "DELETE":
            if ($where == FALSE){ $where = "";}
            $strSql ="DELETE FROM {$this->_table} {$where}";
            $flag = $this->ExecuteSql($strSql, array_values($this->_arrFields));
        break;
        default:
        break;
    }
    return $flag;
}


/**
 * Load object by primary key.
 *
 * @param [Obj]			input Object with value for primary key
 *
 * @return [Obj]		output Object with all properties fill
*/
public function loadOne($Obj){
	$fields = "";
	$set_method = "set";
	$get_method = "get";
	$Ro = new ReflectionObject($Obj);
	$properties = $Ro->getProperties();
	foreach($properties as $property){ 
		$name = $property->getName();
		$name = substr($name, 1);
		$fields.=$name.",";
	}
	$fields = substr($fields, 0, strlen($fields)-1);
	$method = $get_method."_".$this->_Pkey["key"];
	$this->_Pkey["value"] = $Obj->$method(); 

	$sql = "SELECT {$fields} FROM {$this->_table} WHERE ".$this->_Pkey["key"]." = ?";
	$Arr = $this->GetRow($sql, array($this->_Pkey["value"]));
	foreach($properties as $property){ 
		$name = $property->getName();
		$field = substr($name, 1);
		$method = $set_method.$name;
		$Obj->$method($Arr[$field]); 
	}
	return $Obj;
}


/**
 * Save object by Moon Model.
 *
 * @param [Obj]			input Object with value for primary key
 *
 * @return [Obj]		output Object with all properties fill
*/
public function add($Obj){
	$fields = "";
	$Params = array();
	$set_method = "set";
	$get_method = "get";

	$Ro = new ReflectionObject($Obj);
	$properties = $Ro->getProperties();
	foreach($properties as $property){ 
		$name = $property->getName();
		$name = substr($name, 1);
		if ($this->_Pkey["key"] != $name){
			$fields.=$name.",";		
			$method = $get_method."_".$name;
			$Params[] = $Obj->$method();
		}
	}
	$numParams = count($Params) - 1;
	$fields = substr($fields, 0, strlen($fields)-1);

	$sql = "INSERT INTO {$this->_table}({$fields}) VALUES (?".str_repeat(",?", $numParams).")";  
        //echo $sql;
        //exit();
        //if($this->_table<>'libros'){
            
        //exit();
       // }
	$flag = $this->ExecuteSql($sql, $Params);
	if ($flag == false) return false;
	$last_id = $this->_conexion->lastInsertId($this->_sequence);			
	$method = $set_method."_".$this->_Pkey["key"];
	$Obj->$method($last_id);
	return $Obj;
}

/**
 * Update object by Moon Model.
 *
 * @param [Obj]			input Object with value for primary key
 *
 * @return [flag]		output Boolean, false failed, true succesfully
*/
public function update($Obj){
    $fields = "";
    $Params = array();
    $get_method = "get";

    $Ro = new ReflectionObject($Obj);
    $properties = $Ro->getProperties();
    foreach($properties as $property){
        $name = $property->getName();
        $name = substr($name, 1);
        $method = $get_method."_".$name;
        if ($this->_Pkey["key"] != $name){
            $fields.=$name."=?,";
            $Params[] = $Obj->$method();
        }else{
            $this->_Pkey["value"] = $Obj->$method();
        }
    }
    $numParams = count($Params) - 1;
    $fields = substr($fields, 0, strlen($fields)-1);

    $sql = "UPDATE {$this->_table} SET {$fields} WHERE {$this->_Pkey["key"]} = {$this->_Pkey["value"]}";
    $flag = $this->ExecuteSql($sql, $Params);
    return $flag;
}


/**
 * Delete object by Moon Model.
 *
 * @param [Obj]			input Object with value for primary key
 *
 * @return [flag]		output Boolean, false failed, true succesfully
*/
public function delete($Obj){
    $fields = "";
    $Params = array();
    $get_method = "get";

    $Ro = new ReflectionObject($Obj);
    $properties = $Ro->getProperties();
    foreach($properties as $property){
        $name = $property->getName();
        $name = substr($name, 1);
        $method = $get_method."_".$name;
        if ($this->_Pkey["key"] == $name){
            $Params[] = $Obj->$method();
        }
    }
    $numParams = count($Params) - 1;
    $fields = substr($fields, 0, strlen($fields)-1);

    $sql = "DELETE FROM  {$this->_table} WHERE {$this->_Pkey["key"]} = ?";
    $flag = $this->ExecuteSql($sql, $Params);
    return $flag;
}


}//End class
?>