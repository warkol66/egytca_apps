<?php

require_once 'CalendarShowAction.php';

class CalendarPendingShowAction extends CalendarShowAction {

	function execute($mapping, $form, &$request, &$response) {
		$return = parent::execute($mapping, $form, $request, $response);

		$this->template->template = 'TemplatePending.tpl';

		$this->smarty->assign('events', NULL);
		$this->smarty->assign('holydayEvents', NULL);
		$this->smarty->assign('contextEvents', NULL);

		$this->smarty->assign('filterPendingEvents', false);
		$this->smarty->assign('actionName', 'calendarPendingShow');
		return $return;
	}

	// No quiero que se seteen estos filtros
	protected function setAutomaticDateFilters() {
		$eventDateFilter = array(); // filtro por fecha de eventos normales
		if (!empty($_GET['filters']['selectedDate'])) {
			$dt = new DateTime($_GET['filters']['selectedDate']);
			$eventDateFilter['min'] = strtotime('-2 month', $dt->getTimestamp());
			$eventDateFilter['max'] = strtotime('+3 month', $dt->getTimestamp());
		} else {
			$dt = new DateTime();
			$eventDateFilter['min'] = strtotime('-2 month', $dt->getTimestamp());
			$eventDateFilter['max'] = strtotime('+5 month', $dt->getTimestamp());
		}		
		return array($eventDateFilter, $contextEventDateFilter, $holidayDateFilter);
	}

}

