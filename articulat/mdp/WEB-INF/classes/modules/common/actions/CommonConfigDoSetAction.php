<?php
/** 
 * CommonConfigDoSetAction
 *
 * @package config 
 */

class CommonConfigDoSetAction extends BaseAction {

	function CommonConfigDoSetAction() {
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
		
		global $system;
		if (empty($_POST["module"]))
			$system["config"] = $_POST["config"];
		else
			$system["config"][$_POST["module"]] = $_POST["config"][$_POST["module"]];
			
		require_once('includes/assoc_array2xml.php');
		$converter= new assoc_array2xml;
		$xml = $converter->array2xml($system["config"]);
		file_put_contents("config/config.xml",$xml);
		//Cambiamos opciones de Configuracion Generales del sistema al modificarse en la configuracion
		
		//Error Reporting
				$level = $system["config"]["system"]["errorReporting"]["value"];
			if ($level == "") {
				$level = 0;
			}
			error_reporting($level);		

		return $mapping->findForwardConfig('success');
	}

}
