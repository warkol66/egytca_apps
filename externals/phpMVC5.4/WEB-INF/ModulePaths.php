<?php
/**
* The module paths
*
* $author modules Empresarios / Egytca
* @package phpMVCconfig
* @public
*/

class ModulePaths {

	/**
	* Return an array of global paths
	* 
	* @public
	* @returns array	
	*/
	function getModulePaths($appRootDir) {

		//Setup the main module include() directories here
		//Note: could be placed in an xml config file later !!
		$appDirs		= array();
		$appDirs[]	= $appRootDir;
		$appDirs[]	= "$appRootDir/WEB-INF";
		$appDirs[]	= "$appRootDir/WEB-INF/classes";
		$appDirs[]	= "$appRootDir/WEB-INF/tpl";
		$appDirs[]	= "$appRootDir/WEB-INF/classes/includes";
		$appDirs[]	= "$appRootDir/WEB-INF/classes/modules";

		//Path a modulos
		$path = "$appRootDir/WEB-INF/classes/modules";
		$modules = scandir($path);
		
		foreach ($modules as $module)
			if (substr("$module", -1) != "." && $module != ".svn" && is_dir($path.'/'.$module)){
				$appDirs[]	= "$appRootDir/WEB-INF/classes/modules/$module";
				$appDirs[]	= "$appRootDir/WEB-INF/classes/modules/$module/actions";
				$appDirs[]	= "$appRootDir/WEB-INF/classes/modules/$module/classes";
			}

		return $appDirs;
		
	}
	
	/**
	 * Return path string with module paths
	 */
	function getModulePathsString($appDir) {
		return implode(PATH_SEPARATOR, self::getModulePaths($appDir));
	}

}
