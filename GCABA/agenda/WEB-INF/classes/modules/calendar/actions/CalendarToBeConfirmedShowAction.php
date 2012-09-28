<?php

require_once 'CalendarShowAction.php';

class CalendarToBeConfirmedShowAction extends CalendarShowAction {

	function execute($mapping, $form, &$request, &$response) {
		$return = parent::execute($mapping, $form, $request, $response);

		$this->template->template = 'TemplateToBeConfirmed.tpl';


		$this->smarty->assign('events', NULL);
		$this->smarty->assign('holydayEvents', NULL);
		$this->smarty->assign('contextEvents', NULL);

		list(
			$eventDateFilter,
			$contextEventDateFilter,
			$holidayDateFilter
		) = $this->setAutomaticDateFilters();
		
		$this->smarty->assign('pendingEvents', BaseQuery::create('CalendarEvent')
			->addFilters($filters)
			->filterBySchedulestatus('2', Criteria::EQUAL)
			->filterByStartDate($eventDateFilter)
			->find());

		$this->smarty->assign('filterPendingEvents', false);
		$this->smarty->assign('actionName', 'calendarToBeConfirmedShow');
		return $return;
	}

	// No quiero que se seteen estos filtros
	protected function setAutomaticDateFilters() {
		$eventDateFilter = array(); // filtro por fecha de eventos normales
		if (!empty($_GET['filters']['selectedDate'])) {
			$dt = new DateTime($_GET['filters']['selectedDate']);
			$eventDateFilter['min'] = strtotime('-1 month', $dt->getTimestamp());
			$eventDateFilter['max'] = strtotime('+2 month', $dt->getTimestamp());
		} else {
			$dt = new DateTime();
			$eventDateFilter['min'] = strtotime('-1 month', $dt->getTimestamp());
			$eventDateFilter['max'] = strtotime('+2 month', $dt->getTimestamp());
		}		
		return array($eventDateFilter, $contextEventDateFilter, $holidayDateFilter);
	}
}

