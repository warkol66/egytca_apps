<?php
/**
 * CalendarThematicWeeksListAction
 *
 * Listado de Semanas tematicas
 */
require_once 'BaseListAction.php';

class CalendarThematicWeeksListAction extends BaseListAction {

	function __construct() {
		parent::__construct('ThematicWeek');
	}

	protected function preList() {
		parent::preList();

		$year = $_GET["createYearWeeks"];
		if (!empty($year)) {
			$weeks = BaseQuery::create('ThematicWeek')->filterByYear($year)->count();
			if ($weeks == 0)
				ThematicWeek::createYearWeeks($year);
		}
	}

	protected function postList() {
		$this->smarty->assign('calendarAxes', CalendarAxisQuery::create()->find());
		$this->smarty->assign('axisIdToNameMap', json_encode(CalendarAxis::getIdToNameMap()));
		parent::postList();
	}
}
