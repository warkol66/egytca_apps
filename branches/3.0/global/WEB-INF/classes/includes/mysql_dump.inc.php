<?php
/**
* Dump MySQL database
*
* Here is an inline example:
* <code>
* $connection = @mysql_connect($dbhost,$dbuser,$dbpsw);
* $dumper = new MySQLDump($dbname,'filename.sql',false,false);
* $dumper->doDump();
* </code>

*
* @name    MySQLDump
* @author  Daniele Vigan� - CreativeFactory.it <daniele.vigano@creativefactory.it> - based on a version by Andrea Ingaglio <andrea@coders4fun.com>
* @version 2.0 - 02/10/2007
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

class MySQLDump {
	/**
	* @access private
	*/
	var $database = null;

	/**
	* @access private
	*/
	var $compress = false;

	/**
	* @access private
	*/
	var $hexValue = false;

  /**
	* The output filename
	* @access private
	*/
	var $filename = null;

	/**
	* The pointer of the output file
	* @access private
	*/
	var $file = null;

	/**
	* @access private
	*/
	var $isWritten = false;
	
	/**
	 * Prefijo de Tabla
	 * @access private
	 */
	var $tablePrefix = null;
	
	/**
	* Class constructor
	* @param string $db The database name
	* @param string $filepath The file where the dump will be written
	* @param boolean $compress It defines if the output file is compress (gzip) or not
	* @param boolean $hexValue It defines if the outup values are base-16 or not
	*/
	function MYSQLDump($db = null, $filepath = 'dump.sql', $compress = false, $hexValue = false){
		$this->compress = $compress;
		if ( ($filepath != false) && (!$this->setOutputFile($filepath)) )
			return false;
		return $this->setDatabase($db);
	}

	/**
	* Sets the database to work on
	* @param string $db The database name
	*/
	function setDatabase($db){
		$this->database = $db;
		if ( !@mysql_select_db($this->database) )
			return false;
		return true;
  }

	/**
	* Returns the database where the class is working on
	* @return string
	*/
  function getDatabase(){
		return $this->database;
	}

	/**
	* Sets the output file type (It can be made only if the file hasn't been already written)
	* @param boolean $compress If it's true, the output file will be compressed
	*/
	function setCompress($compress){
		if ( $this->isWritten )
			return false;
		$this->compress = $compress;
		$this->openFile($this->filename);
		return true;
  }

	/**
	* Returns if the output file is or not compressed
	* @return boolean
	*/
  function getCompress(){
		return $this->compress;
	}

	/**
	* Sets the output file
	* @param string $filepath The file where the dump will be written
	*/
	function setOutputFile($filepath){
		if ( $this->isWritten )
			return false;
		$this->filename = $filepath;
		$this->file = $this->openFile($this->filename);
		return $this->file;
  }

  /**
	* Returns the output filename
	* @return string
	*/
  function getOutputFile(){
		return $this->filename;
	}

	/**
	* Writes to file the $table's structure
	* @param string $table The table name
	*/
  function getTableStructure($table){
		if ( !$this->setDatabase($this->database) )
			return false;
		// Structure Header
		$structure = "-- --------------------------------------------------------\n\n";
		$structure .= "-- \n";
		$structure .= "-- Table structure for table `{$table}` \n";
		$structure .= "-- \n\n";
		// Dump Structure
		$structure .= 'DROP TABLE IF EXISTS `'.$table.'`;'."\n";
		$records = @mysql_query('SHOW CREATE TABLE `'.$table.'`');
		$records = @mysql_fetch_assoc($records);
		$structure .= $records['Create Table'];

		$structure .= ";\n\n";
		
		$this->saveToFile($this->file,$structure);
	}

	/**
	* Writes to file the $table's data
	* @param string $table The table name
	* @param boolean $hexValue It defines if the output is base 16 or not
	*/
	function getTableData($table,$hexValue = true) {
		if ( !$this->setDatabase($this->database) )
			return false;
		// Header
		$data = "-- \n";
		$data .= "-- Dumping data for table `$table` \n";
		$data .= "-- \n\n";
		$this->saveToFile($this->file,$data);
		$data = "";

		$records = mysql_query('SHOW FIELDS FROM `'.$table.'`');
		$num_fields = @mysql_num_rows($records);
		if ( $num_fields == 0 )
			return false;
		// Field names
		$selectStatement = "SELECT ";
		$insertStatement = "INSERT INTO `$table` (";
		$hexField = array();
		for ($x = 0; $x < $num_fields; $x++) {
			$record = @mysql_fetch_assoc($records);
			if ( ($hexValue) && ($this->isTextValue($record['Type'])) ) {
				$selectStatement .= 'HEX(`'.$record['Field'].'`)';
				$hexField [$x] = true;
			}
			else
				$selectStatement .= '`'.$record['Field'].'`';
			$insertStatement .= '`'.$record['Field'].'`';
			$insertStatement .= ", ";
			$selectStatement .= ", ";
		}
		$insertStatement = @substr($insertStatement,0,-2).') VALUES';
		$selectStatement = @substr($selectStatement,0,-2).' FROM `'.$table.'`';

		$records = @mysql_query($selectStatement);
		$num_rows = @mysql_num_rows($records);
		$num_fields = @mysql_num_fields($records);
		// Dump data
		$data = $insertStatement;
		for ($i = 0; $i < $num_rows; $i++) {
			$record = @mysql_fetch_assoc($records);
			$registerData = ' (';
			for ($j = 0; $j < $num_fields; $j++) {
				$field_name = @mysql_field_name($records, $j);
				if ( $hexField[$j] && (@strlen($record[$field_name]) > 0) )
					$registerData .= "0x".$record[$field_name];
				else
					if ($record[$field_name] === NULL)
						$registerData .= " NULL";
					else
						$registerData .= '\''.@str_replace('\"','"',@mysql_escape_string($record[$field_name])).'\'';
				$registerData .= ',';
			}
			$registerData = @substr($registerData,0,-1)."),\n";
			//if data in greather than 1MB save
			if (strlen($data) + strlen($registerData) >= 524288) {
				$data = @substr($data,0,-2).";\n\n";
				$this->saveToFile($this->file,$data);
				$data = $insertStatement . $registerData;
			} else {
				$data .= $registerData;
			}
		}
		if ($num_rows > 0)
			$data = @substr($data,0,-2).";\n\n";
		else 
			$data = "\n";
		$this->saveToFile($this->file,$data);
	}
	
	function getTablesQuery() {
		
		$tablePrefix = $this->getTablePrefix();
			if (!empty($tablePrefix)) {
			//escapeamos los caracteres '_' para la sentencia de LIKE
			$tablePrefix = str_replace('_','\_',$tablePrefix);
			$sqlQuery =  "SHOW TABLES LIKE '$tablePrefix%'";
		}
		else
			$sqlQuery = "SHOW TABLES";
			
		return $sqlQuery;
	}

  /**
	* Writes to file all the selected database tables structure
	* @return boolean
	*/
	function getDatabaseStructure() {
		
		$sqlQuery = $this->getTablesQuery();
		$records = @mysql_query($sqlQuery);
		if ( @mysql_num_rows($records) == 0 )
			return false;
		while ( $record = @mysql_fetch_row($records) ) {
			$structure .= $this->getTableStructure($record[0]);
		}
		return true;
  }

	/**
	* Writes to file all the selected database tables data
	* @param boolean $hexValue It defines if the output is base-16 or not
	*/
	function getDatabaseData($hexValue = true) {
		
		$sqlQuery = $this->getTablesQuery();
		$records = @mysql_query($sqlQuery);
		if ( @mysql_num_rows($records) == 0 )
			return false;
		while ( $record = @mysql_fetch_row($records) ) {
			$this->getTableData($record[0],$hexValue);
		}
  }
	
	function getDatabaseCompleteDump($hexValue = true) {
		$sqlQuery = $this->getTablesQuery();
		$records = @mysql_query($sqlQuery);
		if ( @mysql_num_rows($records) == 0 )
			return false;
		while ( $record = @mysql_fetch_row($records) ) {
			$this->getTableStructure($record[0]);
			$this->getTableData($record[0],$hexValue);
		}
	}

	/**
	* Writes to file the selected database dump
	*/
	function doDump() {
		$this->saveToFile($this->file,"SET FOREIGN_KEY_CHECKS = 0;\n\n");
		$this->saveToFile($this->file,"SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n\n");
		$databaseHeader = '--\n';
		$databaseHeader .= '-- Database: `'.$this->database.'`\n';
		$databaseHeader .= '--\n\n';
		$this->getDatabaseCompleteDump($this->hexValue);
		$this->saveToFile($this->file,"SET FOREIGN_KEY_CHECKS = 1;\n\n");
		$this->closeFile($this->file);
		return true;
	}
	
	/**
	* @deprecated Look at the doDump() method
	*/
	function writeDump($filename) {
		if ( !$this->setOutputFile($filename) )
			return false;
		$this->doDump();
    $this->closeFile($this->file);
    return true;
	}

	/**
	* @access private
	*/
	function getSqlKeysTable ($table) {
		$primary = "";
		unset($unique);
		unset($index);
		unset($fulltext);
		$results = mysql_query("SHOW KEYS FROM `{$table}`");
		if ( @mysql_num_rows($results) == 0 )
			return false;
		while($row = mysql_fetch_object($results)) {
			if (($row->Key_name == 'PRIMARY') AND ($row->Index_type == 'BTREE')) {
				if ( $primary == "" )
					$primary = "  PRIMARY KEY  (`{$row->Column_name}`";
				else
					$primary .= ", `{$row->Column_name}`";
			}
			if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '0') AND ($row->Index_type == 'BTREE')) {
				if ( (!is_array($unique)) OR ($unique[$row->Key_name]=="") )
					$unique[$row->Key_name] = "  UNIQUE KEY `{$row->Key_name}` (`{$row->Column_name}`";
				else
					$unique[$row->Key_name] .= ", `{$row->Column_name}`";
			}
			if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'BTREE')) {
				if ( (!is_array($index)) OR ($index[$row->Key_name]=="") )
					$index[$row->Key_name] = "  KEY `{$row->Key_name}` (`{$row->Column_name}`";
				else
					$index[$row->Key_name] .= ", `{$row->Column_name}`";
			}
			if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'FULLTEXT')) {
				if ( (!is_array($fulltext)) OR ($fulltext[$row->Key_name]=="") )
					$fulltext[$row->Key_name] = "  FULLTEXT `{$row->Key_name}` (`{$row->Column_name}`";
				else
					$fulltext[$row->Key_name] .= ", `{$row->Column_name}`";
			}
		}
		$sqlKeyStatement = '';
		// generate primary, unique, key and fulltext
		if ( $primary != "" ) {
			$sqlKeyStatement .= ",\n";
			$primary .= ")";
			$sqlKeyStatement .= $primary;
		}
		if (is_array($unique)) {
			foreach ($unique as $keyName => $keyDef) {
				$sqlKeyStatement .= ",\n";
				$keyDef .= ")";
				$sqlKeyStatement .= $keyDef;

			}
		}
		if (is_array($index)) {
			foreach ($index as $keyName => $keyDef) {
				$sqlKeyStatement .= ",\n";
				$keyDef .= ")";
				$sqlKeyStatement .= $keyDef;
			}
		}
		if (is_array($fulltext)) {
			foreach ($fulltext as $keyName => $keyDef) {
				$sqlKeyStatement .= ",\n";
				$keyDef .= ")";
				$sqlKeyStatement .= $keyDef;
			}
		}
		return $sqlKeyStatement;
	}

  /**
	* @access private
	*/
	function isTextValue($field_type) {
		switch ($field_type) {
			case "tinytext":
			case "text":
			case "mediumtext":
			case "longtext":
			case "binary":
			case "varbinary":
			case "tinyblob":
			case "blob":
			case "mediumblob":
			case "longblob":
				return True;
				break;
			default:
				return False;
		}
	}
	
	/**
	* @access private
	*/
	function openFile($filename) {
		$file = false;
		if ( $this->compress )
			$file = @gzopen($filename, "w9");
		else
			$file = @fopen($filename, "w");
		return $file;
	}

  /**
	* @access private
	*/
	function saveToFile($file, $data) {
		if ( $this->compress )
			@gzwrite($file, $data);
		else
			@fwrite($file, $data);
		$this->isWritten = true;
	}

  /**
	* @access private
	*/
	function closeFile($file) {
		if ( $this->compress )
			@gzclose($file);
		else
			@fclose($file);
	}
	
	// Modificaciones agregadas para el Framework Egytca
	
	/**
	 * Version agregada para generar una salida a string
	 *
	 * @return string contenido del dump generado
	 */
	function doDumpToString() {
		//usamos un archivo temporal para generar la salida con la libreria
		$this->file = tmpfile();
		$this->saveToFile($this->file,"SET FOREIGN_KEY_CHECKS = 0;\n\n");
		$this->saveToFile($this->file,"SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n\n");
		$databaseHeader = '--\n';
		$databaseHeader .= '-- Database: `'.$this->database.'`\n';
		$databaseHeader .= '--\n\n';
		$this->getDatabaseCompleteDump($this->hexValue);
		$this->saveToFile($this->file,"SET FOREIGN_KEY_CHECKS = 1;\n\n");
		
		//vamos al inicio del archivo
		rewind($this->file);
		
		while (!feof($this->file))
			$output .= fgets($this->file);
		
		fclose($this->file);
		return $output;
		
	}
	
	/**
	 * Sirve para especificar un prefijo de tabla 
	 * @param string prefijo de tabla
	 * @return true en caso de exito
	 */
	function setTablePrefix($prefix = '') {
		
		$this->tablePrefix = $prefix;
		return true;
	}

	/**
	 * Sirve para especificar un prefijo de tabla 
	 * 
	 * @return string prefijo de tabla
	 */
	function getTablePrefix() {
		
		return $this->tablePrefix;
		
	}

}
?>
