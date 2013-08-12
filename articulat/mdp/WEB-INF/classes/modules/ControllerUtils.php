<?php

class ControllerUtils {
	
	private static $modulesPath = 'WEB-INF/classes/modules';
	private static $modules;
	private static $actions;
	
	static function getModules($cached = true) {
		
		if (!self::$modules || !$cached)
			self::updateModules();
		return self::$modules;
	}
	
	static function getActions($module, $cached = true) {
		
		if (!array_key_exists($module, self::$actions) || !$cached)
			self::updateActions ($module);
		return self::$actions[$module];
	}
	
	private static function updateModules() {
		
		self::$modules = array();
		foreach (scandir(self::$modulesPath) as $entry) {
			if (is_dir(self::$modulesPath.'/'.$entry) && $entry[0] != '.')
				self::$modules[] = $entry;
		}
	}
	
	private static function updateActions($module) {
		
		$actionsPath = self::$modulesPath."/$module/actions";
		self::$actions[$module] = array();
		foreach (scandir($actionsPath) as $entry) {
			if (is_file("$actionsPath/$entry") && $entry[0] != '.'
					&& preg_match("/(.*)Action.php$/", $entry, $matches))
				self::$actions[$module][] = $matches[1];
		}
	}
}
