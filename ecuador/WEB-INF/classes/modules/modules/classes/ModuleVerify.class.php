<?php

class ModuleVerify{

	function __construct($module){
		
		// directorio a verificar
		$this->dir = "./WEB-INF/classes/modules/" . $module;

		// archivo donde guardar fingerprints debe tener permisos de escritura
		$this->file = "./WEB-INF/classes/modules/". $module ."/setup/fingerprints";
		
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

	function lookDir($path) {
		$handle = @opendir($path);
		if (!$handle){
			return false;
		}
		
		while ($item = readdir($handle)) {
			if ($item!="." && $item!=".." && $item!='fingerprints') {
				if (is_dir($path."/".$item))
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
