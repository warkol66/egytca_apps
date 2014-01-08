<?php

class ModuleVerify{

	function __construct($module){
		
		// directorio a verificar
		$dirs = $this->getDirs();
		$this->dir = $dirs[$module];

		$this->ignores = $this->getIgnores();
		$this->extIgnores = $this->getExtIgnores();
		
		// archivo donde guardar fingerprints debe tener permisos de escritura
		$this->fileDir = "./WEB-INF/fingerprints/";
		// si el directorio de fingerprints no existe lo crea
		if (!file_exists($this->fileDir)) {
			mkdir($this->fileDir, 0777, true);
		}
		$this->file = "./WEB-INF/fingerprints/" . $dirs[$module]['file'];
		
		// obtengo los hashes actuales
		$this->hashes = unserialize(file_get_contents($this->file));
		// si no existe el archivo o no hay ningun hash creo el arreglo
		if (!$this->hashes || !is_array($this->hashes))
			$this->hashes = array();
			
		// array para los archivos nuevos
		$this->newFiles = array();
		// array para los archivos que cambiaron
		$this->changedFiles = array();
	}
	
	// devuelve el listado de directorios a verificar
	public static function getDirs() {
		// cada elemento tiene un nombre como clave, id para el form, path y si solo verifica archivos
		$dirs = array(
			'config' => array('dir' => './config', 'onlyFiles' => false, 'file' => 'config','hash' => md5_file('./WEB-INF/fingerprints/config')),
			'classes' => array('dir' => './WEB-INF/classes', 'onlyFiles' => true, 'file' => 'WEB-INF.classes','hash' => md5_file('./WEB-INF/fingerprints/WEB-INF.classes')),
			'includes' => array('dir' => './WEB-INF/classes/includes', 'onlyFiles' => false, 'file' => 'WEB-INF.classes.includes','hash' => md5_file('./WEB-INF/fingerprints/WEB-INF.classes.includes')),
			'lib-phpmvc' => array('dir' => './WEB-INF/lib-phpmvc', 'onlyFiles' => false, 'file' => 'WEB-INF.lib-phpmvc','hash' => md5_file('./WEB-INF/fingerprints/WEB-INF.lib-phpmvc')),
			'propel' => array('dir' => './WEB-INF/propel', 'onlyFiles' => false, 'file' => 'WEB-INF.propel','hash' => md5_file('./WEB-INF/fingerprints/WEB-INF.propel'))
		);
		
		// obtengo todos los modulos	
		if ($handle = opendir('./WEB-INF/classes/modules')) {
			$ignore = array('.', '..','.svn');
			while (false !== ($file = readdir($handle))) {
				if (!in_array($file, $ignore)) {
					$dirs["$file"] = array('dir' => "./WEB-INF/classes/modules/$file", 'onlyFiles' => false, 'file' => "WEB-INF.classes.modules.$file",'hash' => md5_file("./WEB-INF/fingerprints/WEB-INF.classes.modules.$file"));
				}
			}
			closedir($handle);
		}
		return $dirs;
	}
	
	/* devuelve el hash del directorio obtenido a partir del archivo de fingerprint correspondiente */
	public function getDirectoryHash() {
		return md5_file($this->file);
	}
	
	// devuelve el listado archivos y directorios a ignorar
	private function getIgnores() {
		return array('.','..','application-conf.php','application-classmap.php','fingerprints','migrations','sql','.svn');
	}
	
	// devuelve el listado de extensiones a ignorar
	private function getExtIgnores() {
		return array('svn','bak','sql','data');
	}

	public function lookDir($path) {
		$handle = @opendir($path);
		if (!$handle){
			return false;
		}
		
		while ($item = readdir($handle)) {
			$ext = pathinfo($item, PATHINFO_EXTENSION);
			if (!in_array($item, $this->ignores) && !in_array($ext, $this->extIgnores)) {
				if (is_dir($path."/".$item) && !$this->dir['onlyFiles'])
					$this->lookDir($path."/".$item);
				else
					$this->checkFile($path."/".$item);
			}
		 }
		 closedir($handle);
		 return true;
	}

	private function checkFile($file) {
		if (is_readable($file)){
			 //echo "readable";
			if (!isset($this->hashes[$file])) {
				 // archivo nuevo
				 $this->hashes[$file] =  md5_file($file);
				 $this->newFiles[$file] = $this->hashes[$file];
			}elseif ($this->hashes[$file] != md5_file($file)) {
				 $this->hashes[$file] =  md5_file($file);
				 $this->changedFiles[$file] = $this->hashes[$file];
			}else{
				 $this->hashes[$file] =  md5_file($file);
			}
		}
	}
	
}
