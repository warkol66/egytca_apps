<?php

class VialidadConstructionItemDoDeleteAction extends BaseAction {

	function VialidadConstructionItemDoDeleteAction() {
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

		$item = ConstructionItemQuery::create()->findOneById($_POST["id"]);
		
		try {
			$item->delete();
			return $mapping->findForwardConfig('success');
			
		} catch (Exception $e) {
			return $mapping->findForwardConfig('failure');
		}
	}

}
