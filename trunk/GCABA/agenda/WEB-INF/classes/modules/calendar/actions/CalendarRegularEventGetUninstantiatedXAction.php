<?php

class CalendarRegularEventGetUninstantiatedXAction extends BaseAction {

	function CalendarRegularEventGetUninstantiatedXAction() {
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
		
		$years = is_array($_POST['years']) ? $_POST['years'] : array($_POST['years']);
		$uninstantiatedRegEvents = array();
		foreach ($years as $year) {
			$uninstantiatedRegEvents[$year] = CalendarRegularEvent::getUninstantiated($year);
		}
		$smarty->assign('uninstantiatedRegEvents', $uninstantiatedRegEvents);
		$smarty->assign('years', $years);
		
		return $mapping->findForwardConfig('success');
	}

}