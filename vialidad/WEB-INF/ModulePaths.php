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
	function getModulePaths() {

		//Setup the main module include() directories here
		//Note: could be placed in an xml config file later !!
		$appDirs		= array();
		$appDirs[]	= ''; // starting with the sub-application home directory
		$appDirs[]	= 'WEB-INF';
		$appDirs[]	= 'WEB-INF/classes';
		$appDirs[]	= 'WEB-INF/configRules';
		$appDirs[]	= 'WEB-INF/tpl';
		$appDirs[]	= 'WEB-INF/classes/includes';
		$appDirs[]	= 'WEB-INF/classes/modules';

		//Path a modulos
		$path = "WEB-INF/classes/modules";
		$modules = scandir($path);
		
		foreach ($modules as $module)
			if (substr("$module", -1) != "." && $module != ".svn" && is_dir($path.'/'.$module)){
				$appDirs[]	= "WEB-INF/classes/modules/$module";
				$appDirs[]	= "WEB-INF/classes/modules/$module/actions";
				$appDirs[]	= "WEB-INF/classes/modules/$module/classes";
			}

		return $appDirs;


	}

}
