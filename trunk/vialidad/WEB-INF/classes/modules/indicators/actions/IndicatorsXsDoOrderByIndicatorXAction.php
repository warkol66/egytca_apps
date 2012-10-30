<?php
/**
* IndicatorsXsDoOrderByIndicatorXAction
* 
* Permite mediante Ajax el cambio de orden de los proyectos disponibles
* 
* @package  projects
*/

require_once("BaseAction.php");

class IndicatorsXsDoOrderByIndicatorXAction extends BaseAction {

	function IndicatorsXsDoOrderByIndicatorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Indicators";

		parse_str($_POST['data']);
		
		for ($i = 0; $i < count($xsList); $i++) {
			if($xsList[$i] != NULL) {
   				IndicatorXPeer::updateOrder($xsList[$i],$i);
			}
   		}

		return $mapping->findForwardConfig('success');

	}

}
