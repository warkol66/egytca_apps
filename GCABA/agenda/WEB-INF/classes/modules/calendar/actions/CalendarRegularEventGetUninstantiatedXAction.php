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
		
		$uninstantiatedRegEvents = array(); //CalendarRegularEvent::getUninstantiated($_POST['year']);
		$smarty->assign('uninstantiatedRegEvents', $uninstantiatedRegEvents);
		$smarty->assign('year', $_POST['year']);
		
		return $mapping->findForwardConfig('success');
	}

}