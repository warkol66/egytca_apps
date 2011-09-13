<?php

/*
 * Session Management for PHP3
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 *
 * $Id: db_mysql.inc,v 1.3 2001/05/17 00:57:31 chrisj Exp $
 *
 */ 

class DB_Sql {
  
  /* public: connection parameters */
  var $Host     = "";
  var $Database = "";
  var $User     = "";
  var $Password = "";
  var $CharSet  = "";

  /* public: configuration parameters */
  var $Auto_Free     = 0;     ## Set to 1 for automatic mysql_free_result()
  var $Debug         = 0;     ## Set to 1 for debugging messages.
  var $Halt_On_Error = "no"; ## "yes" (halt with message), "no" (ignore errors quietly), "report" (ignore errror, but spit a warning
  var $Seq_Table     = "db_sequence";

  /* public: result array and current row number */
  var $Record   = array();
  var $Row;

  /* public: current error number and error text */
  var $Errno    = 0;
  var $Error    = "";

  /* public: this is an api revision, not a CVS revision. */
  var $type     = "mysql";
  var $revision = "1.2";

  /* private: link and query handles */
  var $Link_ID  = 0;
  var $Query_ID = 0;
  


  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  /* public: some trivial reporting */
  function link_id() {
    return $this->Link_ID;
  }
  
  function getId() {
		return mysql_insert_id($this->Link_ID);
	}

  function query_id() {
    return $this->Query_ID;
  }
  /* public: connection management */
  function connect($Database = "", $Host = "", $User = "", $Password = "") {
    /* Handle defaults */
    if ("" == $Database)
      $Database = $this->Database;
    if ("" == $Host)
      $Host     = $this->Host;
    if ("" == $User)
      $User     = $this->User;
    if ("" == $Password)
      $Password = $this->Password;
      
    /* establish connection, select database */
    if ( 0 == $this->Link_ID ) {
      $this->Link_ID=mysql_connect($Host, $User, $Password);
      if (!$this->Link_ID) {
        $this->halt("connect($Host, $User, $Password) failed.");
        return 0;
      }

      if (!@mysql_select_db($Database,$this->Link_ID)) {
        $this->halt("cannot use database ".$this->Database);
        return 0;
      }
    }

    if (isset($this->CharSet))
    	mysql_query("SET NAMES $this->CharSet");
    
    return $this->Link_ID;
  }

  /* public: discard the query result */
  function free() {
      @mysql_free_result($this->Query_ID);
      $this->Query_ID = 0;
  }

  /* public: perform a query */
  function query($Query_String) {
    /* No empty queries, please, since PHP4 chokes on them. */
    if ($Query_String == "")
      /* The empty query string is passed on from the constructor,
       * when calling the class without a query, e.g. in situations
       * like these: '$db = new DB_Sql_Subclass;'
       */
      return 0;

    if (!$this->connect()) {
      return 0; /* we already complained in connect() about that. */
    };

    # New query, discard previous result.
    if ($this->Query_ID) {
      $this->free();
    }

    if ($this->Debug)
      printf("Debug: query = %s<br>\n", $Query_String);

    $this->Query_ID = mysql_query($Query_String,$this->Link_ID) or userErrorHandler(mysql_errno(), mysql_error(), 'db_mysql', 'query', $vars);
    $this->Row   = 0;
    $this->Errno = mysql_errno();
    $this->Error = mysql_error();
    if (!$this->Query_ID) {
      //$this->halt("Invalid SQL: ".$Query_String);
       userErrorHandler(mysql_errno(), mysql_error(), 'db_mysql', 'query', $vars);
    }

    # Will return nada if it fails. That's fine.
    return $this->Query_ID;
  }

  /* public: walk result set */
  function next_record() {
    if (!$this->Query_ID) {
      $this->halt("next_record called with no query pending.");
      return 0;
    }

    $this->Record = @mysql_fetch_array($this->Query_ID);
    $this->Row   += 1;
    $this->Errno  = mysql_errno();
    $this->Error  = mysql_error();

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_Free) {
      $this->free();
    }
    return $stat;
  }

/* public: convertir a array una columna de un recordset */
 function convarray($keyColumn)  {

    $datos = array();
    $i     = 0;
    $continuar = true;

    $this->seek(0);
    while($this->next_record()) {
       $datos[$i] = $this->Record[$keyColumn];
       $i=$i+1;
    }

    return $datos;
 }

function recordset2Array() {
    $datos = array();
    $i     = 0;
    $this->seek(0);
    while($this->next_record()) {
       $datos[$i] = $this->Record;
       $i=$i+1;
    }
    return $datos;
} 


/* public: position in result set */
  function seek($pos = 0) {
    $status = @mysql_data_seek($this->Query_ID, $pos);
    if ($status)
      $this->Row = $pos;
    else {
      $this->halt("seek($pos) failed: result has ".$this->num_rows()." rows");

      /* half assed attempt to save the day, 
       * but do not consider this documented or even
       * desireable behaviour.
       */
      @mysql_data_seek($this->Query_ID, $this->num_rows());
      $this->Row = $this->num_rows;
      return 0;
    }

    return 1;
  }

  /* public: table locking */
  function lock($table, $mode="write") {
    $this->connect();
    
    $query="lock tables ";
    if (is_array($table)) {
      while (list($key,$value)=each($table)) {
        if ($key=="read" && $key!=0) {
          $query.="$value read, ";
        } else {
          $query.="$value $mode, ";
        }
      }
      $query=substr($query,0,-2);
    } else {
      $query.="$table $mode";
    }
    $res = @mysql_query($query, $this->Link_ID);
    if (!$res) {
      $this->halt("lock($table, $mode) failed.");
      return 0;
    }
    return $res;
  }
  
  function unlock() {
    $this->connect();

    $res = @mysql_query("unlock tables", $this->Link_ID);
    if (!$res) {
      $this->halt("unlock() failed.");
      return 0;
    }
    return $res;
  }


  /* public: evaluate the result (size, width) */
  function affected_rows() {
    return @mysql_affected_rows($this->Link_ID);
  }

  function num_rows() {
    return @mysql_num_rows($this->Query_ID);
  }

  function num_fields() {
    return @mysql_num_fields($this->Query_ID);
  }

  /* public: shorthand notation */
  function nf() {
    return $this->num_rows();
  }

  function np() {
    print $this->num_rows();
  }

  function f($Name) {
    return $this->Record[$Name];
  }

  function p($Name) {
    print $this->Record[$Name];
  }

  /* public: sequence numbers */
  function nextid($seq_name) {
    $this->connect();
    
    if ($this->lock($this->Seq_Table)) {
      /* get sequence number (locked) and increment */
      $q  = sprintf("select nextid from %s where seq_name = '%s'",
                $this->Seq_Table,
                $seq_name);
      $id  = @mysql_query($q, $this->Link_ID);
      $res = @mysql_fetch_array($id);
      
      /* No current value, make one */
      if (!is_array($res)) {
        $currentid = 0;
        $q = sprintf("insert into %s values('%s', %s)",
                 $this->Seq_Table,
                 $seq_name,
                 $currentid);
        $id = @mysql_query($q, $this->Link_ID);
      } else {
        $currentid = $res["nextid"];
      }
      $nextid = $currentid + 1;
      $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'",
               $this->Seq_Table,
               $nextid,
               $seq_name);
      $id = @mysql_query($q, $this->Link_ID);
      $this->unlock();
    } else {
      $this->halt("cannot lock ".$this->Seq_Table." - has it been created?");
      return 0;
    }
    return $nextid;
  }

  /* public: return table metadata */
  function metadata($table='',$full=false) {
    $count = 0;
    $id    = 0;
    $res   = array();

    /*
     * Due to compatibility problems with Table we changed the behavior
     * of metadata();
     * depending on $full, metadata returns the following values:
     *
     * - full is false (default):
     * $result[]:
     *   [0]["table"]  table name
     *   [0]["name"]   field name
     *   [0]["type"]   field type
     *   [0]["len"]    field length
     *   [0]["flags"]  field flags
     *
     * - full is true
     * $result[]:
     *   ["num_fields"] number of metadata records
     *   [0]["table"]  table name
     *   [0]["name"]   field name
     *   [0]["type"]   field type
     *   [0]["len"]    field length
     *   [0]["flags"]  field flags
     *   ["meta"][field name]  index of field named "field name"
     *   The last one is used, if you have a field name, but no index.
     *   Test:  if (isset($result['meta']['myfield'])) { ...
     */

    // if no $table specified, assume that we are working with a query
    // result
    if ($table) {
      $this->connect();
      $id = @mysql_list_fields($this->Database, $table);
      if (!$id)
        $this->halt("Metadata query failed.");
    } else {
      $id = $this->Query_ID; 
      if (!$id)
        $this->halt("No query specified.");
    }
 
    $count = @mysql_num_fields($id);

    // made this IF due to performance (one if is faster than $count if's)
    if (!$full) {
      for ($i=0; $i<$count; $i++) {
        $res[$i]["table"] = @mysql_field_table ($id, $i);
        $res[$i]["name"]  = @mysql_field_name  ($id, $i);
        $res[$i]["type"]  = @mysql_field_type  ($id, $i);
        $res[$i]["len"]   = @mysql_field_len   ($id, $i);
        $res[$i]["flags"] = @mysql_field_flags ($id, $i);
      }
    } else { // full
      $res["num_fields"]= $count;
    
      for ($i=0; $i<$count; $i++) {
        $res[$i]["table"] = @mysql_field_table ($id, $i);
        $res[$i]["name"]  = @mysql_field_name  ($id, $i);
        $res[$i]["type"]  = @mysql_field_type  ($id, $i);
        $res[$i]["len"]   = @mysql_field_len   ($id, $i);
        $res[$i]["flags"] = @mysql_field_flags ($id, $i);
        $res["meta"][$res[$i]["name"]] = $i;
      }
    }
    
    // free the result only if we were called on a table
    if ($table) @mysql_free_result($id);
    return $res;
  }

  /* private: error handling */
  function halt($msg) {
    $this->Error = @mysql_error($this->Link_ID);
    $this->Errno = @mysql_errno($this->Link_ID);
    if ($this->Halt_On_Error == "no")
      return;

    $this->haltmsg($msg);

    if ($this->Halt_On_Error != "report")
      die("Session halted.");
  }

  function haltmsg($msg) {
    printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
    printf("<b>MySQL Error</b>: %s (%s)<br>\n",
      $this->Errno,
      $this->Error);
  }

  function table_names() {
    $this->query("SHOW TABLES");
    $i=0;
    while ($info=mysql_fetch_row($this->Query_ID))
     {
      $return[$i]["table_name"]= $info[0];
      $return[$i]["tablespace_name"]=$this->Database;
      $return[$i]["database"]=$this->Database;
      $i++;
     }
   return $return;
  }

}


/*
 * Definición de la Conexión a la Base de Datos
 *
 * @package Config
 */

class DBConnection extends DB_Sql {

	function DBConnection() {

		//Para utilizar conexión de Propel
		global $moduleRootDir;		
		$configDbFromPropel = include("$moduleRootDir/config/application-conf.php");
		
		$configDbData = $configDbFromPropel["datasources"]["application"]["connection"];
		$dsnParts = explode("=",$configDbData["dsn"]);
		$database = $dsnParts[2];
		$dsnParts2 = explode(";",$dsnParts[1]);
		$host = $dsnParts2[0];
		$user = $configDbData["user"];
		$password = $configDbData["password"];
		$port = "";

		$charSet = $configDbData["settings"]["charset"]["value"];

		//Para conectar directamente, cargar valores en esta sección
		$this->Database = $database;
		$this->Host = $host;
		$this->User = $user;
		$this->Password = $password;
		$this->Port = $port;

    if (!empty($charSet))
			$this->CharSet = $charSet;

		//Verifico que se puede conectar a la base, de lo contrario die
		if (!$this->connect())
			die("No db conection!!!");

	}

}


$backupPeer = new BackupPeer();

if (!empty($_FILES['backup'])) {
	$filename = $_FILES["backup"]['tmp_name'];
	$originalFileName = $_FILES["backup"]['name'];
	restoreBackup($backupPeer, $filename, $originalFileName);
}
else if (!empty($_GET['filename'])) {
	$filename = $_GET['filename'];
	$originalFileName = $filename;
	restoreBackup($backupPeer, $filename, $originalFileName);
}
else {
	echo "No ha seleccionado un archivo para instalar<br />";
	echo "Seleccione el archivo<br />";
	$files = $backupPeer->getBackupList();
	foreach ($files as $file) {
		echo "<a href=\"install.php?filename=". $file['name'] . "\">" . $file['name'] . "</a><br />";
	}
	echo "<form id=\"backupLoaderForm\" action=\"install.php\" method=\"post\" enctype=\"multipart/form-data\">";
	echo "<p>A continuacion indique el archivo local a restaurar en el sistema:</p>";
	echo "<p><label>Archivo:</label><input type=\"file\" name=\"backup\" size=\"40\" /></p>";
	echo "<p><input type=\"submit\" value=\"Restaurar respaldo local\" accept=\"txt/sql\" onclick=\"return confirm('Esta opción reemplazará la información en el sistema por la información en este respaldo. ¿Está seguro que desea continuar?');\"/></p>";
	echo "</form>";
}

function restoreBackup($backupPeer, $filename, $originalFileName) {
	
	if ($backupPeer->restoreBackup($filename, $originalFileName))
		echo "Instalación completa";
	else
		echo "No se pudo realizar la instalación";
}

/**
 * BackupPeer
 * Modificado de WEB-INF/classes/moduyles/backup/classes/BackupPeer.php
 * @package backup
 */
class BackupPeer {

	private $db;
	
	function BackupPeer() {
		$this->db = new DBConnection();
	}
	
	/**
	 * Restauracion de Backup de sql
	 * @param $sqlQuery string query a ejecutar
	 */
	function restoreSQL($sqlQuery) {
		$osType = PHP_OS;
		$queries = explode(";\n",$sqlQuery);
		foreach ($queries as $query) {
			$query = trim($query);
			if ($query == "#Renombre de tablas con camelcase." && stristr($osType,"WIN") !== FALSE) //Fin de ejecucion de sql en Windows
				break;
			if (!empty($query))
				$this->db->query($query);
		}
		return true;
	}

	/**
	 * Restaura un backup en del servidor
	 * @return true si fue exitoso, false sino
	 */
	function restoreBackup($zipFilename, $originalFileName = null) {
		if ($originalFileName === null)
			$originalFileName = $zipFilename;

		set_time_limit(900);

		$zipfile = new zipfile;
		$zipfile->read_zip($zipFilename);

		$sql = '';

		foreach($zipfile->files as $filea) {
			// condicion de busqueda del archivo SQL
			if ($filea["name"] == "dump.sql" && (($filea["dir"] == './db' || empty($filea["dir"])) || ($filea["dir"] == '_/db' || empty($filea["dir"]))) )
				$sql = $filea["data"];
			
			//condicion para detectar archivos a reemplazar
			if (strpos($filea["dir"],'_/files') !== false) {
				if ($filea['dir'] === '_/files')
					$path = '';
				else {
					$clearRoute = explode('_/files/',$filea['dir']);
					$path = $clearRoute[1] . '/';
				}
				//guardamos el archivo en su ubicacion
				file_put_contents('WEB-INF/../' . $path . $filea["name"] , $filea['data']);
			}
		}

		//hay procesamiento de SQL
		if (!empty($sql))
			$ret = BackupPeer::restoreSQL($sql);

		if (!$ret)
			return false;

		return true;

	}

	/**
	 * Obtiene el listado de backups almacenados en el servidor
	 *
	 * @return array de nombres de archivo
	 */
	function getBackupList($order = "asc") {

		$path = dirname(__FILE__) . "/";
		$dir = opendir($path);
		$filenames = array();

		while ($file = readdir($dir)) {

			if (preg_match("/\.zip/i",$file)) {
				$filename = $path . $file;
				$data = array(
									'name' => $file,
									'size' => (filesize($filename) / 1024),
									'time' => filemtime($filename)
								);
				array_push($filenames,$data);
			}

		}
		//ordenamos los nombres de archivo
		if ($order == "desc")
			rsort($filenames);
		else
			sort($filenames);

		return $filenames;

	}

	/**
	 * Ontiene el contenido de un backup guardado en el servidor
	 *
	 * @param string nombre del archivo en el servidor
	 * @return string contenido del archivo
	 */
	function getBackupContents($filename) {

		if (file_exists($filename) == false)
			return false;
		$contents = file_get_contents($filename);

		return $contents;

	}

}

class zipfile
{
	/*
		zipfile class, for reading or writing .zip files
		See http://www.gamingg.net for more of my work
		Based on tutorial given by John Coggeshall at http://www.zend.com/zend/spotlight/creating-zip-files3.php
		Copyright (C) Joshua Townsend and licensed under the GPL
		Version 1.0
	*/
	var $datasec = array(); // array to store compressed data
	var $files = array(); // array of uncompressed files
	var $dirs = array(); // array of directories that have been created already
	var $ctrl_dir = array(); // central directory
	var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00"; //end of Central directory record
	var $old_offset = 0;
	var $basedir = ".";

	function create_dir($name) // Adds a directory to the zip with the name $name
	{
		$name = str_replace("\\", "/", $name);

		$fr = "\x50\x4b\x03\x04";
		$fr .= "\x0a\x00";	// version needed to extract
		$fr .= "\x00\x00";	// general purpose bit flag
		$fr .= "\x00\x00";	// compression method
		$fr .= "\x00\x00\x00\x00"; // last mod time and date

		$fr .= pack("V",0); // crc32
		$fr .= pack("V",0); //compressed filesize
		$fr .= pack("V",0); //uncompressed filesize
		$fr .= pack("v",strlen($name)); //length of pathname
		$fr .= pack("v", 0); //extra field length
		$fr .= $name;
		// end of "local file header" segment

		// no "file data" segment for path

		// "data descriptor" segment (optional but necessary if archive is not served as file)
		$fr .= pack("V",0); //crc32
		$fr .= pack("V",0); //compressed filesize
		$fr .= pack("V",0); //uncompressed filesize

		// add this entry to array
		$this->datasec[] = $fr;

		$new_offset = strlen(implode("", $this->datasec));

		// ext. file attributes mirrors MS-DOS directory attr byte, detailed
		// at http://support.microsoft.com/support/kb/articles/Q125/0/19.asp

		// now add to central record
		$cdrec = "\x50\x4b\x01\x02";
		$cdrec .="\x00\x00";	// version made by
		$cdrec .="\x0a\x00";	// version needed to extract
		$cdrec .="\x00\x00";	// general purpose bit flag
		$cdrec .="\x00\x00";	// compression method
		$cdrec .="\x00\x00\x00\x00"; // last mod time and date
		$cdrec .= pack("V",0); // crc32
		$cdrec .= pack("V",0); //compressed filesize
		$cdrec .= pack("V",0); //uncompressed filesize
		$cdrec .= pack("v", strlen($name) ); //length of filename
		$cdrec .= pack("v", 0 ); //extra field length
		$cdrec .= pack("v", 0 ); //file comment length
		$cdrec .= pack("v", 0 ); //disk number start
		$cdrec .= pack("v", 0 ); //internal file attributes
		$cdrec .= pack("V", 16 ); //external file attributes  - 'directory' bit set

		$cdrec .= pack("V", $this->old_offset); //relative offset of local header
		$this->old_offset = $new_offset;

		$cdrec .= $name;
		// optional extra field, file comment goes here
		// save to array
		$this->ctrl_dir[] = $cdrec;
		$this->dirs[] = $name;
	}


	function create_file($data, $name) // Adds a file to the path specified by $name with the contents $data
	{
		$name = str_replace("\\", "/", $name);

		$fr = "\x50\x4b\x03\x04";
		$fr .= "\x14\x00";	// version needed to extract
		$fr .= "\x00\x00";	// general purpose bit flag
		$fr .= "\x08\x00";	// compression method
		$fr .= "\x00\x00\x00\x00"; // last mod time and date

		$unc_len = strlen($data);
		$crc = crc32($data);
		$zdata = gzcompress($data);
		$zdata = substr($zdata, 2, -4); // fix crc bug
		$c_len = strlen($zdata);
		$fr .= pack("V",$crc); // crc32
		$fr .= pack("V",$c_len); //compressed filesize
		$fr .= pack("V",$unc_len); //uncompressed filesize
		$fr .= pack("v", strlen($name) ); //length of filename
		$fr .= pack("v", 0 ); //extra field length
		$fr .= $name;
		// end of "local file header" segment

		// "file data" segment
		$fr .= $zdata;

		// "data descriptor" segment (optional but necessary if archive is not served as file)
		$fr .= pack("V",$crc); // crc32
		$fr .= pack("V",$c_len); // compressed filesize
		$fr .= pack("V",$unc_len); // uncompressed filesize

		// add this entry to array
		$this->datasec[] = $fr;

		$new_offset = strlen(implode("", $this->datasec));

		// now add to central directory record
		$cdrec = "\x50\x4b\x01\x02";
		$cdrec .="\x00\x00";	// version made by
		$cdrec .="\x14\x00";	// version needed to extract
		$cdrec .="\x00\x00";	// general purpose bit flag
		$cdrec .="\x08\x00";	// compression method
		$cdrec .="\x00\x00\x00\x00"; // last mod time & date
		$cdrec .= pack("V",$crc); // crc32
		$cdrec .= pack("V",$c_len); //compressed filesize
		$cdrec .= pack("V",$unc_len); //uncompressed filesize
		$cdrec .= pack("v", strlen($name) ); //length of filename
		$cdrec .= pack("v", 0 ); //extra field length
		$cdrec .= pack("v", 0 ); //file comment length
		$cdrec .= pack("v", 0 ); //disk number start
		$cdrec .= pack("v", 0 ); //internal file attributes
		$cdrec .= pack("V", 32 ); //external file attributes - 'archive' bit set

		$cdrec .= pack("V", $this->old_offset); //relative offset of local header
		$this->old_offset = $new_offset;

		$cdrec .= $name;
		// optional extra field, file comment goes here
		// save to central directory
		$this->ctrl_dir[] = $cdrec;
	}

	function read_zip($name)
	{
		// Clear current file
		$this->datasec = array();

		// File information
		$this->name = $name;
		$this->mtime = filemtime($name);
		$this->size = filesize($name);

		// Read file
		$fh = fopen($name, "rb");
		$filedata = fread($fh, $this->size);
		fclose($fh);

		// Break into sections
		$filesecta = explode("\x50\x4b\x05\x06", $filedata);

		// ZIP Comment
		$unpackeda = unpack('x16/v1length', $filesecta[1]);
		$this->comment = substr($filesecta[1], 18, $unpackeda['length']);
		$this->comment = str_replace(array("\r\n", "\r"), "\n", $this->comment); // CR + LF and CR -> LF

		// Cut entries from the central directory
		$filesecta = explode("\x50\x4b\x01\x02", $filedata);
		$filesecta = explode("\x50\x4b\x03\x04", $filesecta[0]);
		array_shift($filesecta); // Removes empty entry/signature

		foreach($filesecta as $filedata)
		{
			// CRC:crc, FD:file date, FT: file time, CM: compression method, GPF: general purpose flag, VN: version needed, CS: compressed size, UCS: uncompressed size, FNL: filename length
			$entrya = array();
			$entrya['error'] = "";

			$unpackeda = unpack("v1version/v1general_purpose/v1compress_method/v1file_time/v1file_date/V1crc/V1size_compressed/V1size_uncompressed/v1filename_length", $filedata);

			// Check for encryption
			$isencrypted = (($unpackeda['general_purpose'] & 0x0001) ? true : false);

			// Check for value block after compressed data
			if($unpackeda['general_purpose'] & 0x0008)
			{
				$unpackeda2 = unpack("V1crc/V1size_compressed/V1size_uncompressed", substr($filedata, -12));

				$unpackeda['crc'] = $unpackeda2['crc'];
				$unpackeda['size_compressed'] = $unpackeda2['size_uncompressed'];
				$unpackeda['size_uncompressed'] = $unpackeda2['size_uncompressed'];

				unset($unpackeda2);
			}

			$entrya['name'] = substr($filedata, 26, $unpackeda['filename_length']);

			if(substr($entrya['name'], -1) == "/") // skip directories
			{
				continue;
			}

			$entrya['dir'] = dirname($entrya['name']);
			$entrya['dir'] = ($entrya['dir'] == "." ? "" : $entrya['dir']);
			$entrya['name'] = basename($entrya['name']);


			$filedata = substr($filedata, 26 + $unpackeda['filename_length']);

			if(strlen($filedata) != $unpackeda['size_compressed'])
			{
				$entrya['error'] = "Compressed size is not equal to the value given in header.";
			}

			if($isencrypted)
			{
				$entrya['error'] = "Encryption is not supported.";
			}
			else
			{
				switch($unpackeda['compress_method'])
				{
					case 0: // Stored
						// Not compressed, continue
					break;
					case 8: // Deflated
						$filedata = gzinflate($filedata);
					break;
					case 12: // BZIP2
						if(!extension_loaded("bz2"))
						{
							@dl((strtolower(substr(PHP_OS, 0, 3)) == "win") ? "php_bz2.dll" : "bz2.so");
						}

						if(extension_loaded("bz2"))
						{
							$filedata = bzdecompress($filedata);
						}
						else
						{
							$entrya['error'] = "Required BZIP2 Extension not available.";
						}
					break;
					default:
						$entrya['error'] = "Compression method ({$unpackeda['compress_method']}) not supported.";
				}

				if(!$entrya['error'])
				{
					if($filedata === false)
					{
						$entrya['error'] = "Decompression failed.";
					}
					elseif(strlen($filedata) != $unpackeda['size_uncompressed'])
					{
						$entrya['error'] = "File size is not equal to the value given in header.";
					}
					elseif(crc32($filedata) != $unpackeda['crc'])
					{
						$entrya['error'] = "CRC32 checksum is not equal to the value given in header.";
					}
				}

				$entrya['filemtime'] = mktime(($unpackeda['file_time']  & 0xf800) >> 11,($unpackeda['file_time']  & 0x07e0) >>  5, ($unpackeda['file_time']  & 0x001f) <<  1, ($unpackeda['file_date']  & 0x01e0) >>  5, ($unpackeda['file_date']  & 0x001f), (($unpackeda['file_date'] & 0xfe00) >>  9) + 1980);
				$entrya['data'] = $filedata;
			}

			$this->files[] = $entrya;
		}

		return $this->files;
	}

	function add_file($file, $dir = ".", $file_blacklist = array(), $ext_blacklist = array())
	{
		$file = str_replace("\\", "/", $file);
		$dir = str_replace("\\", "/", $dir);

		if(strpos($file, "/") !== false)
		{
			$dira = explode("/", "{$dir}/{$file}");
			$file = array_shift($dira);
			$dir = implode("/", $dira);
			unset($dira);
		}

		while(substr($dir, 0, 2) == "./")
		{
			$dir = substr($dir, 2);
		}
		while(substr($file, 0, 2) == "./")
		{
			$file = substr($file, 2);
		}
		if(!in_array($dir, $this->dirs))
		{
			if($dir == ".")
			{
				$this->create_dir("./");
			}
			$this->dirs[] = $dir;
		}
		if(in_array($file, $file_blacklist))
		{
			return true;
		}
		foreach($ext_blacklist as $ext)
		{
			if(substr($file, -1 - strlen($ext)) == ".{$ext}")
			{
				return true;
			}
		}

		$filepath = (($dir && $dir != ".") ? "{$dir}/" : "").$file;
		if(is_dir("{$this->basedir}/{$filepath}"))
		{
			$dh = opendir("{$this->basedir}/{$filepath}");
			while(($subfile = readdir($dh)) !== false)
			{
				if($subfile != "." && $subfile != "..")
				{
					$this->add_file($subfile, $filepath, $file_blacklist, $ext_blacklist);
				}
			}
			closedir($dh);
		}
		else
		{
			$this->create_file(implode("", file("{$this->basedir}/{$filepath}")), $filepath);
		}

		return true;
	}


	function zipped_file() // return zipped file contents
	{
		$data = implode("", $this->datasec);
		$ctrldir = implode("", $this->ctrl_dir);

		return $data.
				$ctrldir.
				$this->eof_ctrl_dir.
				pack("v", sizeof($this->ctrl_dir)). // total number of entries "on this disk"
				pack("v", sizeof($this->ctrl_dir)). // total number of entries overall
				pack("V", strlen($ctrldir)). // size of central dir
				pack("V", strlen($data)). // offset to start of central dir
				"\x00\x00"; // .zip file comment length
	}
}?>

