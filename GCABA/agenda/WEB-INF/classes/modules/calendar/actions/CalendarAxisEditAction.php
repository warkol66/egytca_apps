<?php

class CalendarAxisEditAction extends BaseAction {

	function CalendarAxisEditAction() {
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

		$id = $request->getParameter("id");
		if (!empty($id)) {
			$calendarAxis = CalendarAxisQuery::create()->findOneById($id);
			if (!empty($calendarAxis))
				$smarty->assign("calendarAxis",$calendarAxis);
			else
				$smarty->assign("notValidId",true);
		}
		else {
			$calendarAxis = new CalendarAxis();
			$smarty->assign("calendarAxis",$calendarAxis);
		}
		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
		}
		return $mapping->findForwardConfig('success');
	}
}
