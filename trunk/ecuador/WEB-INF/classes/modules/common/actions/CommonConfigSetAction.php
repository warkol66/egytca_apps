<?php
/** 
 * CommonConfigSetAction
 *
 * @package config 
 */

class CommonConfigSetAction extends BaseAction {

	function CommonConfigSetAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);
		$section = "Config";
		$smarty->assign("section",$section);

		//timezone
		$timezonePeer = new TimezonePeer();
		$smarty->assign("timezones",$timezonePeer->getAll());

		$colorCodes = array(1,2,3,4,5,6,7,8,9,10);		
		$smarty->assign("colorCodes",$colorCodes);

		$smarty->assign("languages",common::getAllLanguages());

		global $system;
		$smarty->assign("selectedModule",$_GET["module"]);
		if (!empty($_GET["module"])) {
			$config = array();
			$config = $system["config"][$_GET["module"]];
			$smarty->assign("config",$config);
		}
		
		$activeModules = ModuleQuery::create()->select('Name')->filterByActive('1')->find();
		$activeModulesArray = $activeModules->toArray();
		$configExtra = array('system','email');

		$activeModulesArray = array_merge($configExtra,$activeModulesArray);

		$modulesList = array_intersect($activeModulesArray,array_keys($system["config"]));

		$smarty->assign("modules",$modulesList);
		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}

}
