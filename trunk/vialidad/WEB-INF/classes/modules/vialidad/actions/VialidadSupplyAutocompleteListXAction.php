<?php

class VialidadSupplyAutocompleteListXAction extends BaseAction {

	function VialidadSupplyAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Supplies";
		$smarty->assign("section",$section);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);
		
		$filters = array("searchString" => $searchString); 
		
		if ($_REQUEST['getCandidates']) {

			$entityType = $_REQUEST['entityType'];
			$entityQuery = ucfirst($entityType) . "Query";

			if (class_exists($entityQuery))
				$entity = $entityQuery::create()->findById($_REQUEST['entityId']);

			$relationQuery = ucfirst($_REQUEST['relation']) . "Query";
			
			$filter = "filterBy" . ucfirst($entityType);
			if (class_exists($entityQuery))
				$actualIds = $relationQuery::create()->select("Supplyid")->$filter($entity)->find()->toArray();

			$filters = array_merge_recursive($filters, array("getCandidates" => $actualIds));

		}

		$supplies = SupplyQuery::create()
									->addFilters($filters)
									->limit($_REQUEST['limit'])
									->find();

		$smarty->assign("supplies",$supplies);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
