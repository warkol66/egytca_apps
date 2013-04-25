<?php

class PlanningConstructionsShowAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Planning";
		$section = "Constructions";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET['positionId'])) {
			$filters = $_GET['filters'];
			$constructionsQuery = BaseQuery::create('PlanningConstruction')->addFilters($filters);
			$position = PositionQuery::create()->findOneById($_GET['positionId']);
			$smarty->assign("position", $position);
			$constructions = empty($_GET['color']) ?
				$position->getPlanningConstructionsWithDescendants($constructionsQuery) : $position->getPlanningConstructionsByStatusColor($_GET['color'],$constructionsQuery);
		}

		$smarty->assign("constructions", $constructions);

		$smarty->assign("filters", $filters);

		$smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$smarty->assign("tenderTypes", PlanningConstruction::getTenderTypes());

		return $mapping->findForwardConfig('success');
	}

}
