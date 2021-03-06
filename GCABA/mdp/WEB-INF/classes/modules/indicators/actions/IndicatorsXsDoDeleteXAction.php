<?php
/**
* IndicatorsXsDoDeleteXAction
* 
* Permite mediante Ajax la eliminacion de una X.
* 
* @package  projects
*/

require_once("BaseAction.php");

class IndicatorsXsDoDeleteXAction extends BaseAction {

	function IndicatorsXsDoDeleteXAction() {
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
		
		$xId = $_POST['id'];
		
		$smarty->assign("id", $xId);
		
		$xPeer = new IndicatorXPeer();
		if ($xPeer->delete($xId)) {
			$yPeer = new IndicatorYPeer();
			if ($yPeer->deleteAllByX($xId)) {
				return $mapping->findForwardConfig('success');
			} else {
				return $mapping->findForwardConfig('failure');
			}
		} else {
			return $mapping->findForwardConfig('failure');
		}

	}

}
