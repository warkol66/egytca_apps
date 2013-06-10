<?php
/**
* IndicatorsSeriesDoDeleteXAction
* 
* Permite mediante Ajax la eliminacion de una Serie.
* 
* @package  projects
*/

require_once("BaseAction.php");

class IndicatorsSeriesDoDeleteXAction extends BaseAction {

	function IndicatorsSeriesDoDeleteXAction() {
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
		
		$serieId = $_POST['id'];
		
		$smarty->assign("id", $serieId);
		
		$seriePeer = new IndicatorSeriePeer();
		if ($seriePeer->delete($serieId)) {
			$yPeer = new IndicatorYPeer();
			if ($yPeer->deleteAllBySerie($serieId)) {
				return $mapping->findForwardConfig('success');
			} else {
				return $mapping->findForwardConfig('failure');
			}
		} else {
			return $mapping->findForwardConfig('failure');
		}

	}

}
