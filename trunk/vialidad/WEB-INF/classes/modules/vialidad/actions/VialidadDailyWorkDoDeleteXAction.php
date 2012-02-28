<?php

class VialidadDailyWorkDoDeleteXAction extends BaseAction {

	function VialidadDailyWorkDoDeleteXAction() {
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
		
		if (!empty($_POST['id'])) {
			
			$dailyWork = DailyWorkQuery::create()->findOneById($_POST['id']);
			if (is_null($dailyWork))
				throw new Exception('invalid ID');
			
			$dailyWork->delete(); // Si falla se dispara una excepción que provoca el failure de Ajax
			return;
		} else {
			throw new Exception('invalid ID');
		}
	}

}
