<?php

class ModuleVerify{

	function __construct($module){
		
		// directorio a verificar
		$dirs = $this->getDirs();
		$this->dir = $dirs[$module];

		$this->ignores = $this->getIgnores();
		
		// archivo donde guardar fingerprints debe tener permisos de escritura
		$this->file = "./WEB-INF/fingerprints/". $dirs[$module]['id'];
		
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
			'config' => array('id' => 'config', 'dir' => './config', 'onlyFiles' => false),
			'WEB-INF/classes' => array('id' => 'classes', 'dir' => './WEB-INF/classes', 'onlyFiles' => true),
			'WEB-INF/classes/includes' => array('id' => 'includes', 'dir' => './WEB-INF/classes/includes', 'onlyFiles' => false),
			'WEB-INF/lib-phpmvc' => array('id' => 'phpmvc', 'dir' => './WEB-INF/lib-phpmvc', 'onlyFiles' => false),
			'WEB-INF/propel' => array('prop' => 'config', 'dir' => './WEB-INF/propel', 'onlyFiles' => false)
		);
		
		// obtengo todos los modulos	
		if ($handle = opendir('./WEB-INF/classes/modules')) {
			$ignore = array('.', '..','.svn','.bak');
			while (false !== ($file = readdir($handle))) {
				if (!in_array($file, $ignore)) {
					$dirs["WEB-INF/classes/modules/$file"] = array('id' => "$file", 'dir' => "./WEB-INF/classes/modules/$file", 'onlyFiles' => false);
				}
			}
			closedir($handle);
		}
		return $dirs;
	}
	
	// devuelve el listado de directorios a verificar
	function getIgnores() {
		return array('.','..','.svn','application-config','application-classmap','.bak','fingerprints');
	}

	function lookDir($path) {
		$handle = @opendir($path);
		if (!$handle){
			return false;
		}
		
		while ($item = readdir($handle)) {
			if (!in_array($item, $this->ignores)) {
				if (is_dir($path."/".$item) && !$this->dir['onlyFiles'])
					$this->lookDir($path."/".$item);
				else
					$this->checkFile($path."/".$item);
			}
		 }
		 closedir($handle);
		 return true;
	}

	function checkFile($file) {
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
		}else{
			//echo "Not readable";
		}
	}
	
}
