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
	var $pathIgnoreList = array('.svn/','.git/', 'install.php');
	var $pathContentIgnoreList = array('backups/','WEB-INF/smarty_tpl/templates_c/');
	private $ignoreHeaderAndFooter;

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
	 * Ignora la creación de encabezado y pie para correccion de camelcase
	 */
	function setIgnoreHeaderAndFooter() {
		$this->ignoreHeaderAndFooter = true;
	}

	/**
	 * Obtiene el listado de backups almacenados en el servidor
	 *
	 * @return array de nombres de archivo
	 */
	function getBackupList($order = "asc") {

		$path = 'WEB-INF/../backups/';
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
	 * Generacion del SQL con los datos del sistema
	 * @param $path String Ruta donde se guardaran los backups en el servidor
	 * @return $filecontents String SQL
	 */
	function buildDataBackup($filename,$path = 'WEB-INF/../backups/') {

		set_time_limit(ConfigModule::get("global","backupTimeLimit"));

		require_once('config/DBConnection.inc.php');
		$db = new DBConnection();

		require_once('mysql_dump.inc.php');
		$dumper = new MySQLDump($db->Database,$filename ? $path . $filename : false,false,false);

		//verificamos si tiene table prefix
		if (($tablePrefix = BackupPeer::configHasPrefix()) != false)
			$dumper->setTablePrefix($tablePrefix);

		if (!$this->ignoreHeaderAndFooter) {
			$headerAndFooter = $this->getDumpHeaderAndFooter();
			$header = $headerAndFooter["header"];
			$footer = $headerAndFooter["footer"];
			$filecontent = $dumper->doDumpToString();
			$filecontents = $header.$filecontent.$footer;
		}

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

		global $osType;

		require_once('config/DBConnection.inc.php');
		$db = new DBConnection();

		//nos guardamos un dump de la tabla de logs para hacerla trascender al respaldo que se está cargando
		//esta tabla no se debe alterar al cargar un respaldo.
		$this->setTableHeader('actionLogs_log');
		$this->setIgnoreHeaderAndFooter();
		$logsDump = $this->buildDataBackup();
		$sqlQuery .= $logsDump; //ponemos la tabla de logs actual para que se cargue al final de todo.

		$queries = explode(";\n",$sqlQuery);

		foreach ($queries as $query) {
			$query = trim($query);

			if ($query == "#Renombre de tablas con camelcase." && stristr($osType,"WIN") !== FALSE) //Fin de ejecucion de sql en Windows
				break;

			if (!empty($query))
				$db->query($query);
		}

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

		$rootDir = "";
		foreach($zipfile->files as $filea) {
			if ($rootDir == "" && $filea["dir"] != "") {
				if (strpos($filea["dir"], "./") === 0)
					$rootDir = "./";
				else
					$rootDir = "_/";
			}
			
			// condicion de busqueda del archivo SQL
			if ($filea["name"] == "dump.sql" && (($filea["dir"] == './db' || empty($filea["dir"])) || ($filea["dir"] == '_/db' || empty($filea["dir"]))) )
				$sql = $filea["data"];
			
			//condicion para detectar archivos a reemplazar
			if (strpos($filea["dir"], $rootDir.'files') !== false) {
				if ($filea['dir'] === $rootDir.'files')
					$path = '';
				else {
					$clearRoute = explode($rootDir.'files/',$filea['dir']);
					$path = $clearRoute[1] . '/';
					if (!empty($path) && !file_exists($path))
						mkdir($path, 0777, true);
				}
				//guardamos el archivo en su ubicacion
				file_put_contents($path . $filea["name"] , $filea['data']);
			}
		}
		
		foreach ($this->pathContentIgnoreList as $createme) {
			if (!file_exists($createme))
				mkdir($createme, 0777, true);
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
		$zipfile->create_dir("_");
		$zipfile->create_dir("_/db/");
		$zipfile->create_file($datafile, "_/db/dump.sql");

		if ($complete) {
			$zipfile->create_dir("_/files/");
			$listing = array();
			$dirHandler = @opendir('WEB-INF/../');
			BackupPeer::directoryList(&$listing,$dirHandler,'WEB-INF/../');

			foreach ($listing as $route) {
				$clearRoute = explode('WEB-INF/../',$route);

				if (!BackupPeer::routeHasToBeIgnored($clearRoute[1]) &&
					!BackupPeer::routeContentHasToBeIgnored($clearRoute[1]) ) {
					if (is_dir($route))
						$zipfile->create_dir("_/files/" . $clearRoute[1]);
					if (is_file($route)) {
						$contents = file_get_contents($route);
						$zipfile->create_file($contents,"_/files/" . $clearRoute[1]);
					}
				} else {
					if (in_array($clearRoute[1], $this->pathContentIgnoreList)) // Es el directorio ignorado raiz
						$zipfile->create_dir ("_/files/" . $clearRoute[1]);
				}
			}
		}

		return $zipfile->zipped_file();
	}
	
	function routeContentHasToBeIgnored($route) {
		foreach ($this->pathContentIgnoreList as $toIgnore) {
			if (strpos($route,$toIgnore) !== false)
				return true;
		}
		return false;
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
		if (stristr($osType,"WIN") !== FALSE) {

			//Path a schemas
			$path = "WEB-INF/propel";
			$schemasFile = scandir($path);

			$schemas = Array();

			foreach ($schemasFile as $schema) {
				if (substr($schema, -10) == "schema.xml")
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
					if (preg_match("/[A-Z]/",$tableName))
						$tables[] = $tableName;

					$tables = $this->addVersionableTableIfApplicable($tables, $tableElement);
				}
			}

			$header = "#Eliminacion de tablas con camelcase.;\n";
			$footer = "#Renombre de tablas con camelcase.;\n";

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
	 * Agrega la tabla proporcionada por el Behavior Versionable, al array
	 * de tablas para renombre, siempre y cuando este el Behavior definido.
	 *
	 * @param   array $tables
	 * @param   array $tableElement
	 * @return  array
	 */
	function addVersionableTableIfApplicable($tables, $tableElement) {

		if (empty($tableElement["_c"]["behavior"])) 
			return $tables;

		foreach ($tableElement["_c"]["behavior"] as $behavior) {

			if (!empty($behavior["_a"]["name"]) && ($behavior["_a"]["name"] != 'versionable'))
				continue;

			$versionableTable = $tableElement["_a"]["name"] . '_version';

			if (!empty($behavior["_c"]["parameter"])) {
				foreach ($behavior["_c"]["parameter"] as $parameter) {
					if ($parameter["_a"]["name"] == 'version_table')
						$versionableTable = $parameter["_a"]["value"];
				}
			}

			if (preg_match("/[A-Z]/", $versionableTable))
				$tables[] = $versionableTable;

		}

		return $tables;
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
