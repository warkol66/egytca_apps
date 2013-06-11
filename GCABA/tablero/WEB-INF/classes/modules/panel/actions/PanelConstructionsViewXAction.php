<?php
/**
 * PanelConstructionsViewXAction
 *
 * Listado de Obras (PlanningConstruction)
 *
 * @package    panel
 * @subpackage    planningConstructions
 */

require_once 'BaseEditAction.php';

class PanelConstructionsViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$this->smarty->assign("tenderTypes", PlanningConstruction::getTenderTypes());
		$this->smarty->assign("constructionTypes", PlanningConstruction::getConstructionTypes());
		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());

		if ($_GET["showGantt"]) {
			$this->smarty->assign("datesArray", $this->entity->getDatesArrayForGantt());
			$this->smarty->assign("showGantt",true);
			$this->template->template = "TemplateAjax.tpl";
		}

	}
}
