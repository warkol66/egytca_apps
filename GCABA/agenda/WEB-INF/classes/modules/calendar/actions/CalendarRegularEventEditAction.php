<?php

class CalendarRegularEventEditAction extends BaseAction {

	function CalendarRegularEventEditAction() {
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

		$module = "Calendar";
		$smarty->assign("module", $module);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto
			$entity = CalendarRegularEventQuery::create()->findOneById($_GET['id']);
			
			if (is_null($entity)) {
				$smarty->assign('notValidId', 'true');
				return $mapping->findForwardConfig('success');
			}

			$smarty->assign("action", "edit");
			
		} else {
			//voy a crear un objeto nuevo
			$entity = new CalendarRegularEvent();
			$smarty->assign("action", "create");
		}
		
		$smarty->assign("entity", $entity);

		$smarty->assign("filters", $_GET["filters"]);
		$smarty->assign("page", $_GET["page"]);
		$smarty->assign("message", $_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
