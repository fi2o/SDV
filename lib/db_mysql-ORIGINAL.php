<?php
/**
 * DB_MySQL Class
 *
 * Esta clase permite tener una interaccion extremadamente
 * sencilla con una base de datos de MySQL.
 *
 * @version		08.06.04.09.04
 * @since  		March 2007
 * @author		Jose E. Robinson C. <jrobinsonc@gmail.com>
 * @copyright	(c) 2007-2008
 * @license 	Attribution-Non-Commercial 2.0
 */
class DB_MySQL {
	
	/** @var object : Almacena el identificador de la coneccion */
	public static $dblink;
	/** @var bool : Para definir si la coneccion es persistente o no */
	public $pconnect;
	/** @var object : Almacena el resultado del query */
	public $query;
	/** @var string : Almacena el sql que fue ejecutado */
	public $sql;
	/** @var string : El nombre de la base de datos en el servidro */
	private $dbname;
	/** @var string : El nombre del servidor MySQL */
	private $host;
	/** @var string : El usuario de la base de datos */
	private $user;
	/** @var string : La contraseña para la base de datos */
	private $pass;
	
	/**
	 * Asigna los valores de las constantes a las variables internas de la clase.
	 * 
	 * @access	public
	 * @param	string $host El nombre del servidor MySQL.
	 * @param	string $user El usuario de la base de datos.
	 * @param	string $pass La contraseña para la base de datos.
	 * @param	string $dbname El nombre de la base de datos.
	 * @param	bool $pconnect Para indicar si la coneccion es persistente o no.
	 * @return	bool Devuelve true si la coneccion se realizo con exito.
	 */
	public function __construct($defined_config=array()) {
		$default_config = array(
			'host'=> defined('DB_HOST') ? DB_HOST : '',
			'user'=> defined('DB_USER') ? DB_USER : '',
			'pass'=> defined('DB_PASS') ? DB_PASS : '',
			'dbname'=> defined('DB_NAME') ? DB_NAME : '',
			'pconnect' => FALSE
		);
		$current_config = array_merge($default_config,$defined_config);
		
		if (is_array($current_config) && count($current_config)>0) {
			foreach($current_config as $key=>$value) {
				$this->{$key} = $value;
			}
		}
	}
	
	/**
	 * Destructor de la clase.
	 * 
	 * Si la clase no es finalizada como es debido, llamando la 
	 * funcion close, esta se finaliza automaticamente al finalizar
	 * el script en ejecucion.
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __destruct() {
		$this->close();
	}
	
	/**
	 * Hace la coneccion con el servidor.
	 * 
	 * @access	public
	 * @return	void
	 */
	public function connect(){
		if (!is_resource(self::$dblink)) {
			if ($this->pconnect===TRUE) {
				self::$dblink = @mysql_pconnect($this->host,$this->user,$this->pass) or die($this->error());
			} else if ($this->pconnect===FALSE) {
				self::$dblink = @mysql_connect($this->host,$this->user,$this->pass) or die($this->error());
			}
		}
	}

	/**
	 * Abre la base de datos.
	 * 
	 * @access	public
	 * @return	void
	 */
	public function select_db() {
		@mysql_select_db($this->dbname,self::$dblink) or die($this->error());
	}
	
	/**
	 * Ejecuta el SQL en la base de datos.
	 * Devuelve un array si se hace un SELECT o un DESCRIBE, devuelve un integer
	 * si se hace un INSERT, de lo contrario devuelve un OBJECT.
	 * 
	 * @access	public
	 * @param	string $sql SQL a ejecutar.
	 * @param	bool $return_records Para definir si el resultado es devuelto automaticamente.
	 * @return	mixed array|int|object SELECT|DESCRIBE => array, INSERT => int, Object.
	 */
	public function query($sql='',$return_records=TRUE) {
		$this->connect();
		$this->select_db();
		$this->query = @mysql_query($sql,self::$dblink) or die ($this->error());
		$this->sql = $sql;

		if ($return_records===TRUE) {
			return $this->result();
		}
	}
	
	/**
	 * Retorna el resultado del ultimo query.
	 *
	 * @access	public
	 * @return	mixed array|int|bool
	 */
	public function result($mysql_fetch='MYSQL_ASSOC') {
		$result = '';
		
		if (preg_match("/^SELECT/",$this->sql) || preg_match("/^DESCRIBE/",$this->sql) || preg_match("/^SHOW/",$this->sql)) {
			switch($mysql_fetch) {
				case 'MYSQL_ASSOC' : $mysql_fetch = 'mysql_fetch_assoc'; break;
				case 'MYSQL_BOTH' : $mysql_fetch = 'mysql_fetch_array'; break;
				case 'MYSQL_NUM' : $mysql_fetch = 'mysql_fetch_row'; break;
				default : $this->error('The result type should be either MYSQL_NUM, MYSQL_ASSOC or MYSQL_BOTH');
			}
	
			$result = array();
			if ($this->num_rows()>0) {
				$records = $mysql_fetch($this->query);
				
				do {
					$result[] = $records;
				} while($records = $mysql_fetch($this->query));
			}
		} else if (preg_match("/^INSERT/",$this->sql)) {
			$result = @mysql_insert_id(self::$dblink) or die ($this->error());
		} else {
			$result = $this->query;
		}
		
		return $result;
	}
	
	/**
	 * Devuelve el numero de registros afectados.
	 * 
	 * @access	public
	 * @return	integer
	 */
	public function affected_rows() {
		$affected_rows = @mysql_affected_rows(self::$dblink);
		return $affected_rows;
	}

	/**
	 * Devuelve el numero de resultados obtenidos por el query.
	 * 
	 * @access	public
	 * @return	integer
	 */
	public function num_rows() {
		$num_rows = @mysql_num_rows($this->query);
		return $num_rows;
	}

	/**
	 * Devuelve el numero de columnas obtenidas por el query.
	 * 
	 * @access	public
	 * @return	integer
	 */
	public function num_fields() {
		$num_fields = @mysql_num_fields($this->query);
		return $num_fields;
		
	}
	
	/**
	 * Esta funcion hace un select en la DB.
	 * 
	 * @access	public
	 * @param	string $table_name El nombre de la tabla.
	 * @param	mixed $fields Campos a extraer de la base de datos.
	 * @param	mixed $where El numero del registro.
	 * @return	array.
	 */
	public function select($table_name,$fields=FALSE,$where=FALSE,$limit=FALSE) {
		if ($fields===FALSE) {
			$fields = '*';
		} else if (is_array($fields)) {
			$fields_array = array();
			
			foreach ($fields as $field) {
				$fields_array[] = "`$field`";
			}
			
			$fields = implode(',',$fields_array);
		}
		
		// -------------------------------------------------------
		if (ctype_digit($where)) {
			$key = 'ID'.strtoupper($table_name);
			
			$where = "`$key`='$where'";
		} else if ($where===FALSE) {
			$where = '1';
		}

		// -------------------------------------------------------
		$limit = (!$limit) ? '' : ' LIMIT '.$limit;
		
		// -------------------------------------------------------
		$sql = "SELECT $fields FROM `$table_name` WHERE $where $limit";	
		
		// -------------------------------------------------------
		return $this->query($sql);
	}
	
	/**
	 * Esta funcion inserta datos en la base de datos.
	 * 
	 * @access	public
	 * @param	string $table Table name.
	 * @param	array $record Los campos de la tabla.
	 * @return	integer
	 */
	public function insert($table,$record) {
		$fields = array();
		$values = array();
		while (list($field,$value)=each($record)) {
			$fields[] = "`". $field ."`";
			$values[] = "'". $this->escape($value) ."'";
		}
		
		$sql = "INSERT INTO `$table` (". implode(",",$fields) .") VALUES (". implode(",",$values) .")";
		return $this->query($sql);
	}

	/**
	 * Esta funcion actualiza datos en la base de datos.
	 * 
	 * @access	public
	 * @param	string $table Table name.
	 * @param	array $record Los campos de la tabla.
	 * @param	mixed $where array|integer Las condiciones para la actualizacion.
	 * @param	bool $limit El limite de registros a actualizar.
	 * @return	mixed Retorna el resultado de $this->query().
	 */
	public function update($table,$record,$where,$limit=false) {
		$sql_record = array();
		while (list($field,$value)=each($record)) {
			$sql_record[] = '`'. $field ."`='". $this->escape($value) ."'";
		}
		$record = implode(",",$sql_record);
		
		if (is_array($where) && count($where)>0) {
			$sql_where = array();
			while (list($field,$value)=each($where)) {
				$sql_where[] = '`'. $field ."`='". $this->escape($value) ."'";
			}
			$where = implode(" AND ",$sql_where);
		} else if (ctype_digit($where)) {
			$key = 'ID'.strtoupper($table);
			$where = $this->escape($where);
			$where = "`$key`='$where'";
		}

		$limit = (!$limit) ? '' : ' LIMIT '.$limit;
		
		$sql = "UPDATE `$table` SET $record WHERE $where $limit";
		return $this->query($sql);
	}
	
	/**
	 * Elimina uno o varios records de la DB.
	 *
	 * @param	string $table_name
	 * @param	int $where
	 */
	public function delete($table_name,$where) {
		$key = 'ID'.strtoupper($table_name);
		
		$sql = "DELETE FROM `$table_name` WHERE `$key`='$where';";
		return $this->query($sql);
	}
	
	/**
	 * Esta funcion extrae un registro (fila) a un array.
	 * 
	 * @access	public
	 * @param	string $table El nombre de la tabla.
	 * @param	integer $index El numero del registro.
	 * @param	array $fields Campos a extraer de la base de datos.
	 * @return	array
	 */
	public function get_row($table,$index,$fields=array('*')) {
		$primary_key = 'ID'.strtoupper($table);
		
		if (count($fields)==1 && $fields[0]=='*') {
			$fields = '*';
		} else {
			$fields = implode(',',$fields);
		}
		$this->sql = "SELECT $fields FROM `$table` WHERE `$primary_key`='$index' LIMIT 1";

		$record = $this->query($this->sql);
		
		return @$record[0];
	}
	
	/**
	 * Esta funcion extrae el contenido de una celda.
	 *
	 * @param	string $table_name
	 * @param	string $column_name
	 * @param	integer $record_id
	 * @return	mixed
	 */
	public function get_cell($table_name,$column_name,$record_id) {
		$primary_key = 'ID'.strtoupper($table_name);
		
		$this->sql = "SELECT $column_name FROM `$table_name` WHERE `$primary_key`='$record_id' LIMIT 1;";
		
		$record = $this->query($this->sql);
		
		if ($this->num_rows()==1) {
			return $record[0][$column_name];
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Escapa caracteres especiales de una cadena para su uso en una sentencia SQL
	 * 
	 * @access	public
	 * @param	string $str
	 * @return	string
	 */
	public function escape($value) {
		return (!get_magic_quotes_gpc()) ? addslashes($value) : $value;
	}
	
	/**
	 * Cierra la coneccion con la base de datos y libera los recursos usados.
	 * 
	 * @access	public
	 * @return	void
	 */
	public function close() {
		/** Si se usaron recursos para almacenar algun resultado, son liberados */
		if (is_resource($this->query)) {
			@mysql_free_result($this->query);
		}
		/** Cierra la coneccion */
		if (is_resource(self::$dblink)) {
			@mysql_close(self::$dblink);
		}
	}
	
	/**
	 * Si sucede algún error en tiempo de ejecucion este se muestra
	 * y para toda la aplicacion.
	 * Si la funcion debug() esta definida le manda el error como
	 * parametro, si no, le da salida en el navegador.
	 * 
	 * @access	private
	 * @param	string $error especifica el error a mostrar si se deja vacio coje el ultimo error de mysql.
	 * @return	void
	 */
	private function error($error='') {
		$error = ($error!='') ? $error : mysql_errno() .' '. mysql_error();
		
		$error = 'MySQL ERROR: '. $error;

		if (function_exists('debug')) {
			debug($error);
		} else {
			exit($error);
		}
	}
}
?>
