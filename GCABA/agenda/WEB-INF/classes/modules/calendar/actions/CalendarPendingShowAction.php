<?php

require_once 'CalendarShowAction.php';

class CalendarPendingShowAction extends CalendarShowAction {

	function execute($mapping, $form, &$request, &$response) {
		$return = parent::execute($mapping, $form, $request, $response);

		$this->template->template = 'TemplatePending.tpl';

		$this->smarty->assign('filterPendingEvents', false);
		$this->smarty->assign('actionName', 'calendarPendingShow');
		return $return;
	}

	// No quiero que se seteen estos filtros
	protected function setAutomaticDateFilters() {}
}

