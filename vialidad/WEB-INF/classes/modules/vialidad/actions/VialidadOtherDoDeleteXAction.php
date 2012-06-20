<?php

class VialidadOtherDoDeleteXAction extends BaseAction {

	function VialidadOtherDoDeleteXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_POST['id'])) {
			
			$other = OtherQuery::create()->findOneById($_POST['id']);
			if (is_null($other))
				throw new Exception('invalid ID');
			
			$other->delete(); // Si falla se dispara una excepción que provoca el failure de Ajax
			return;
		} else {
			throw new Exception('invalid ID');
		}
	}

}
