<?php

class CalendarHolidayEventCreateFromRegularEventXAction extends BaseAction {

	function CalendarHolidayEventCreateFromRegularEventXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		
		BaseAction::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);
		
		if (!empty($_POST['regularEventId']) && !empty($_POST['year'])) {
			try {
				$holiday = CalendarHolidayEvent::createFromRegularEvent($_POST['regularEventId'], $_POST['year']);
				//$holiday->save();
			} catch (Exception $e) {
				throw $e; // buscar una mejor forma de hacer fallar el pedido por AJAX
			}
			$smarty->assign('holiday', $holiday);
			return $mapping->findForwardConfig('success');
		} else {
			throw new Exception(); // buscar una mejor forma de hacer fallar el pedido por AJAX
		}
	}

}