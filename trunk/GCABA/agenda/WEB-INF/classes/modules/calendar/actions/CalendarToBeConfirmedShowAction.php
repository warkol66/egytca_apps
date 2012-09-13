<?php

require_once 'CalendarShowAction.php';

class CalendarToBeConfirmedShowAction extends CalendarShowAction {

	function execute($mapping, $form, &$request, &$response) {
		$return = parent::execute($mapping, $form, $request, $response);

		$this->template->template = 'TemplateToBeConfirmed.tpl';


		$this->smarty->assign('events', NULL);
		$this->smarty->assign('holydayEvents', NULL);
		$this->smarty->assign('contextEvents', NULL);

		$this->smarty->assign('pendingEvents', BaseQuery::create('CalendarEvent')->addFilters($filters)->filterBySchedulestatus('2', Criteria::EQUAL)->find());

		$this->smarty->assign('filterPendingEvents', false);
		$this->smarty->assign('actionName', 'calendarToBeConfirmedShow');
		return $return;
	}

	// No quiero que se seteen estos filtros
//	protected function setAutomaticDateFilters() {}
}

