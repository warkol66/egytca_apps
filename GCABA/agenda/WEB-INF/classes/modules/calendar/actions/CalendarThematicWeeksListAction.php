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
		parent::postList();
	}
}
