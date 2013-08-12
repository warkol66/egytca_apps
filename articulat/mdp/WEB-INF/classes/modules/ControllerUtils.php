<?php

class ControllerUtils {
	
	private static $modulesPath = 'WEB-INF/classes/modules';
	private static $modules;
	private static $actionsByModule;
	private static $pairActions;
	
	static function getModules($cached = true) {
		
		if (!self::$modules || !$cached)
			self::updateModules();
		return self::$modules;
	}
	
	static function getActionsForModule($module, $cached = true) {
		
		if (!array_key_exists($module, self::$actionsByModule) || !$cached)
			self::updateActionsForModule($module);
		return self::$actionsByModule[$module];
	}
	
	static function getActionsForAllModules($cached = true) {
		
		$actions = array();
		foreach (self::getModules($cached) as $module) {
			$actions = array_merge($actions, self::getActionsForModule($module, $cached));
		}
		
		return $actions;
	}
	
	static function getModuleForAction($action) {
		
		if (preg_match("/([A-Z][a-z0-9]*)[A-Za-z0-9]*/", $action, $matches))
			return strtolower($matches[1]);
		else
			return false;
	}
	
	static function getPairActions($cached = true) {
		
		if (!self::$pairActions || !$cached)
			self::updatePairActions();
		
		return self::$pairActions;
	}
	
	static function isPairActionWithDo($action) {
		return array_search($action, self::getPairActions());
	}
	
	static function isPairActionWithoutDo($action) {
		
		if (array_key_exists($action, self::getPairActions())) {
			$pairActions = self::getPairActions();
			return $pairActions[$action];
		}
		else {
			return false;
		}
	}
	
	static function getPairForAction($action) {
		
		if ($other = ControllerUtils::isPairActionWithDo($action))
			return array('withoutDo' => $other, 'withDo' => $action);
		elseif ($other = ControllerUtils::isPairActionWithoutDo($action))
			return array('withoutDo' => $action, 'withDo' => $other);
		else
			return array('withoutDo' => $action, 'withDo' => null);
	}
	
	private static function updateModules() {
		
		self::$modules = array();
		foreach (scandir(self::$modulesPath) as $entry) {
			if (is_dir(self::$modulesPath.'/'.$entry) && $entry[0] != '.')
				self::$modules[] = $entry;
		}
	}
	
	private static function updateActionsForModule($module) {
		
		$actionsPath = self::$modulesPath."/$module/actions";
		self::$actionsByModule[$module] = array();
		foreach (scandir($actionsPath) as $entry) {
			if (is_file("$actionsPath/$entry") && $entry[0] != '.'
					&& preg_match("/(.*)Action.php$/", $entry, $matches))
				self::$actionsByModule[$module][] = $matches[1];
		}
	}
	
	private static function updatePairActions() {
		
		$allActions = self::getActionsForAllModules();
		foreach ($allActions as $action) {
				
			if (preg_match("/(.*)([a-z]Do[A-Z])(.*)/", $action, $matches)) {
				$actionWithoutDo = $matches[1].$matches[2][0].$matches[2][3].$matches[3];
				if (in_array($actionWithoutDo, $allActions))
					self::$pairActions[$actionWithoutDo] = $action;
			}
		}
	}
}
