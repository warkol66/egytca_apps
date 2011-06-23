<?php
/**
 * BackupPeer
 *
 * @package backup
 */

	/**
	 * Generacion de Backups de la base
	 * Tanto para PHP4 como PHP5, y no tiene dependencias con propel
	 * Para que el mismo funcione, debe estar configurado DBConnection.inc.php en /config/
	 *
	 * @todo verificacion de prefijo de tablas.
	 *
	 */
class BackupPeer {

	var $header = '';
	var $pathIgnoreList = array('backups/','WEB-INF/smarty_tpl/templates_c');

	/**
	 * Verifica actualemente si la configuracion de la base tiene prefijo
	 *
	 * @return el prefijo de la tabla si lo tiene, false sino
	 */
	function configHasPrefix() {

		$prefix = $this->header;
		if (!empty($prefix))
			return $this->header;

		global $system;

		$tablePrefix = $system['config']['system']['parameters']['tablePrefix'];

		if (empty($tablePrefix))
			return false;

		return $tablePrefix;
	}

	/**
	 * Permite indicar una cabecera opcional para poder obtener solo un conjunto de tablas
	 * @param string table header
	 */
	function setTableHeader($header) {

		$this->header = $header;
		return true;
	}

	/**
	 * Obtiene el listado de backups almacenados en el servidor
	 *
	 * @return array de nombres de archivo
	 */
	function getBackupList() {

		$path = 'WEB-INF/../backups/';
		$dir = opendir($path);
		$filenames = array();

		while ($file = readdir($dir)) {

			if (preg_match("/\.zip/i",$file)) {
				$filename    = $path . $file;
				$file_object = array(
																'name' => $file,
																'size' => (filesize($filename) / 1024),
																'time' => filemtime($filename)
														);

				array_push($filenames,$file_object);
			}

		}
		//ordenamos los nombres de archivo
		sort($filenames);

		return $filenames;
	}

	/**
	 * Generacion del SQL con los datos del sistema
	 * @param $path String Ruta donde se guardaran los backups en el servidor
	 * @return $filecontents String SQL
	 */
	function buildDataBackup($filename,$path = 'WEB-INF/../backups/') {

		set_time_limit(ConfigModule::get("global","backupTimeLimit"));

		require_once('config/DBConnection.inc.php');
		$db = new DBConnection();
		$connection = @mysql_connect($db->Host,$db->User,$db->Password);

		require_once('mysql_dump.inc.php');
		$dumper = new MySQLDump($db->Database,$filename ? $path . $filename : false,false,false);

		//verificamos si tiene table prefix
		if (($tablePrefix = BackupPeer::configHasPrefix()) != false)
			$dumper->setTablePrefix($tablePrefix);

		$headerAndFooter = $this->getDumpHeaderAndFooter();
		$header = $headerAndFooter["header"];
		$footer = $headerAndFooter["footer"];
		$filecontent = $dumper->doDumpToString();
		$filecontents = $header.$filecontent.$footer;

		mysql_close($connection);

		return $filecontents;

	}

	/**
	 * Devuelve el datetime actual
	 * @return String
	 */
	function getCurrentDatetime() {

		$timezonePeer = new TimezonePeer();
		$timestamp = $timezonePeer->getServerTimeOnGMT0();
		$datetime = date('Y-m-d  H:i:s',$timestamp);
		$currentDatetime = Common::getDatetimeOnTimezone($datetime);

		return $currentDatetime;
	}

	/**
	 * Crea un backup
	 *	
	 * @return $zipContents si fue exitoso, false sino
	 */
	function createBackup($options, $path = 'WEB-INF/../backups/') {
		
		if (!isset($options['complete']))
			$options['complete'] = false;
			
		if (!isset($options['toFile']))
			$options['toFile'] = false;
		
		set_time_limit(ConfigModule::get("global","backupTimeLimit"));
		$filename = BackupPeer::getFileName();
		$filecontents = BackupPeer::buildDataBackup($options['toFile'] ? false : $filename,$path);
		
		$message = 'Se ha creado un backup';
		$message .= $options['complete'] ? ' de datos' : ' completo';
		$message .= $options['toFile'] ? ' para descarga' : ' en el servidor';
		BackupPeer::writeToBackupLog($message);
		$zipContents = BackupPeer::getZipFromDataFile($filecontents, $options['complete']);
		
		if (!$options['toFile']) {
			if (file_put_contents($path . $filename, $zipContents))
				return $zipContents;
			else
				return false;
		}
		return $zipContents;
	}
	
	public function getFileName() {
		$currentDatetime = BackupPeer::getCurrentDatetime();
		return Common::getSiteShortName() . '_' . date('Ymd_His',strtotime($currentDatetime)) . '.zip';
	}

	/**
	 * Restauracion de Backup de sql
	 * @param $sqlQuery string query a ejecutar
	 */
	function restoreSQL($sqlQuery, $complete = false) {

		require_once('config/DBConnection.inc.php');
		$db = new DBConnection();
		$connection = @mysql_connect($db->Host,$db->User,$db->Password);

		//nos guardamos un dump de la tabla de logs para hacerla trascender al respaldo que se está cargando
		//esta tabla no se debe alterar al cargar un respaldo.
		$this->setTableHeader('actionLogs_log');
		$logsDump = $this->buildDataBackup();
		$sqlQuery .= $logsDump; //ponemos la tabla de logs actual para que se cargue al final de todo.
		
		$queries = explode(";\n",$sqlQuery);

		foreach ($queries as $query) {
			$query = trim($query);
			if (!empty($query))
				$db->query($query);
		}

		mysql_close($connection);
		return true;
	}


	/**
	 * Restaura un backup en del servidor
	 *
	 * @return true si fue exitoso, false sino
	 */
	function restoreBackup($zipFilename, $originalFileName = null) {
		if ($originalFileName === null)
			$originalFileName = $zipFilename;
			
		set_time_limit(ConfigModule::get("global","backupTimeLimit"));

		require_once("zip.class.php");

		$zipfile = new zipfile;
		$zipfile->read_zip($zipFilename);

		$sql = '';
		
		$complete = false;
		
		foreach($zipfile->files as $filea) {
			// condicion de busqueda del archivo SQL
			if ($filea["name"] == "dump.sql" && ($filea["dir"] == './db' || empty($filea["dir"])))
				$sql = $filea["data"];

			//condicion para detectar archivos a reemplazar
			if (strpos($filea["dir"],'./files') !== false) {
				$complete = true;

				if ($filea['dir'] === './files')
					$path = '';
				else {
					$clearRoute = explode('\.\/files\/',$filea['dir']);
					$path = $clearRoute[1] . '/';
				}
				//guardamos el archivo en su ubicacion
				file_put_contents('WEB-INF/../' . $path . $filea["name"] , $filea['data']);
			}
		}

		//hay procesamiento de SQL
		if (!empty($sql))
			$ret = BackupPeer::restoreSQL($sql, $complete);
			
		if (!$ret)
			return false;

		//obtencion de filename sin ruta
		$parts = explode('/', $originalFileName);
		$filename = $parts[count($parts)-1];

		$text = 'Se ha restaurado el backup en el servidor de nombre de archivo: ' . $filename;
		$this->writeToBackupLog($text);

		//mail a administrador
		require_once('EmailManagement.php');

		global $system;

		$subject = 'Notificacion de Restauracion usando Modulo de Backup';
		$destination = $system["config"]["system"]["parameters"]["webmasterMail"];
		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
		$manager = new EmailManagement();

		//creamos el mensaje multipart
		$message = $manager->createMultipartMessage($subject,$text);

		//realizamos el envio
		$result = $manager->sendMessage($destination,$mailFrom,$message);

		return true;

	}

	/**
	 * Genera un zip de un archivo de datos
	 * @param $datafile contenido del data file
	 * @param $complete el backup es completo o solo de la base de datos?
	 */
	function getZipFromDataFile($datafile, $complete = false) {
		require_once("zip.class.php");
		$zipfile = new zipfile;
		$zipfile->create_dir(".");
		$zipfile->create_dir("./db/");
		$zipfile->create_file($datafile, "./db/dump.sql");

		if ($complete) {
			$zipfile->create_dir("./files/");
			$listing = array();
			$dirHandler = @opendir('WEB-INF/../');
			BackupPeer::directoryList(&$listing,$dirHandler,'WEB-INF/../');
	
			foreach ($listing as $route) {
				$clearRoute = explode('WEB-INF/../',$route);
	
				if (!BackupPeer::routeHasToBeIgnored($clearRoute[1])) {
					if (is_dir($route))
						$zipfile->create_dir("./files/" . $clearRoute[1]);
					if (is_file($route)) {
						$contents = file_get_contents($route);
						$zipfile->create_file($contents,'./files/' . $clearRoute[1]);
					}
				}
			}
		}
		
		return $zipfile->zipped_file();
	}

	/**
	 * Indica si una ruta debe ser ignorada o no
	 * @param $route string
	 * @return boolean
	 */
	function routeHasToBeIgnored($route) {
		foreach ($this->pathIgnoreList as $toIgnore) {
			if (strpos($route,$toIgnore) !== false)
				return true;
		}
		return false;
	}

	function directoryList($listing,$dirHandler,$path) {
		while (false !== ($file = readdir($dirHandler))) {
			$dir = $path . $file;
			if(is_dir($dir) && $file != '.' && $file !='..' ) {
				$handle = @opendir($dir);
				array_push($listing, $dir . '/');
				BackupPeer::directoryList(&$listing,$handle, $dir . '/');
			}
			elseif($file != '.' && $file !='..')
				array_push($listing,$dir);
		}
		closedir($dirHandle);
	}

	/**
	 * Devuelve el contenido de un backup del archivo que este almacenado en el servidor
	 * @param string $filename nombre del archivo
	 * @return string contenido del backup en SQL
	 */
	function deleteBackup($filename){

		$path = 'WEB-INF/../backups/'.$filename;
		if (!file_exists($path))
			return false;
		$status = unlink($path);
		if ($status)
			BackupPeer::writeToBackupLog('Se ha eliminado el backup del servidor de nombre de archivo: ' . $filename);
		return $status;

	}

	/**
	 * Ontiene el contenido de un backup guardado en el servidor
	 *
	 * @param string nombre del archivo en el servidor
	 * @return string contenido del archivo
	 */
	function getBackupContents($filename) {

		if (file_exists('WEB-INF/../backups/' . $filename) == false)
			return false;
		$contents = file_get_contents('WEB-INF/../backups/' . $filename);

		return $contents;

	}

	function writeToBackupLog($message) {
		//El archivo de log lo ponemos bajo el directorio de backups para que sea omitido
		//por backups completos. Los logs deben ser resistentes a la restauracion de respaldos.
		if (!is_dir('WEB-INF/../backups/logs') && !mkdir('WEB-INF/../backups/logs'))
			return false;
		$fd = fopen('WEB-INF/../backups/logs/backupActivity.log','a+');
		require_once('TimezonePeer.php');

		$currentDatetime = BackupPeer::getCurrentDatetime();

		fprintf($fd,"%s\n", $currentDatetime . ' - ' . $message);
		fclose($fd);

		return true;
	}

	/*
	 * Obtiene el header y el footer del dump, con los drop tables y rename con las tablas con camelcase.
	 *
	 * @return array Header en elemento "header" y footer en elemento "footer"
	 */
	function getDumpHeaderAndFooter() {

		global $moduleRootDir,$osType;
		$header = "";
		$footer = "";
		if ($osType == "WINDOWS" || $osType == "WINNT" || $osType == "WIN") {
			$pathToXml = $moduleRootDir.'/WEB-INF/classes/propel/schema.xml';

			//Path a schemas
			$path = "WEB-INF/propel";
			$schemasFile = scandir($path);

			$schemas = Array();

			foreach ($schemasFile as $schema) {
				if (substr($schema, -3) == "xml")
					$schemas[] = $schema;
			}

			$tables = array();

			foreach ($schemas as $schema) {
				$xml = file_get_contents($path."/".$schema);

				require_once("xml2ary.php");
				$xml2ary = new Xml2ary();
				$array = $xml2ary->getArray($xml);

				$arrayTables = $array["database"]["_c"]["table"];

				foreach ($arrayTables as $tableElement) {
					$tableName = $tableElement["_a"]["name"];
					if (ereg("[A-Z]",$tableName))
						$tables[] = $tableName;
				}
			}

			$header = "#Eliminacion de tablas con camelcase.\n";
			$footer = "#Renombre de tablas con camelcase.\n";

			foreach ($tables as $table) {
				$header .= "DROP TABLE IF EXISTS ". $table .";\n";
				$footer .= "RENAME TABLE ". strtolower($table) . " TO " . $table .";\n";
			}

			$header .= "\n\n";
			$footer .= "\n\n";
		}
		return array("header"=>$header, "footer"=>$footer);
	}

	/**
	 * Envio de un BackupExistente Por Email
	 * @param string nombre del archivo a enviar
	 * @param string email del destinatario
	 */
	function sendBackupToEmail($email = null, $filename = null, $complete = null) {
		require_once('EmailManagement.php');
		
		$systemConfig = Common::getConfiguration('system');
		
		if ($complete === null)
			$complete = false;
		
		if ($email === null) {
			$recipients = $systemConfig['receiveMailBackup'];
			$email = explode(',', $recipients);
		}
		
		if ($filename === null) {
			$filename = BackupPeer::getFileName();
			BackupPeer::createBackup(array('toFile'=>false, 'complete'=>$complete));
		}
		if (file_exists('WEB-INF/../backups/' . $filename) == false)
			return false;
		//creamos el attach utilizando el wrapper de archivo de Swift.
		$attachment = Swift_Attachment::fromPath('WEB-INF/../backups/' . $filename, 'application/zip'); 

		global $system;

		$subject = 'Envio de Respaldo ' . $filename;
		$destination = $email;
		$mailFrom = $systemConfig["parameters"]["fromEmail"];
		$text = 'Adjunto a este mensaje se encuentra el respaldo ' . $filename . ' enviado.';
		$manager = new EmailManagement();

		//creamos el mensaje multipart
		$message = $manager->createMultipartMessage($subject,$text);

		$message->attach($attachment);

		//realizamos el envio
		$result = $manager->sendMessage($destination,$mailFrom,$message);
		return $result;		
	}
}
