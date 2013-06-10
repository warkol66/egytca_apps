<?php
/**
* IndicatorsSeriesDoOrderByIndicatorXAction
* 
* Permite mediante Ajax el cambio de orden de los proyectos disponibles
* 
* @package  projects
*/

require_once("BaseAction.php");

class IndicatorsSeriesDoOrderByIndicatorXAction extends BaseAction {

	function IndicatorsSeriesDoOrderByIndicatorXAction() {
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
		$content = new Content();
		parse_str($_POST['data']);
		
		for ($i = 0; $i < count($seriesList); $i++) {
			if($seriesList[$i] != NULL) {
   				IndicatorSeriePeer::updateOrder($seriesList[$i],$i);
			}
   		}

		return $mapping->findForwardConfig('success');

	}

}
