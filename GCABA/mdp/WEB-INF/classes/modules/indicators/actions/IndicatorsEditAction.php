<?php

class IndicatorsEditAction extends BaseAction {

	function IndicatorsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Indicators";
		$smarty->assign("module",$module);

		$indicatorsPeer = new IndicatorPeer();

		$indicatorsTypes = $indicatorsPeer->getIndicatorTypesTranslated();
		$smarty->assign("indicatorsTypes",$indicatorsTypes);

		$categories = IndicatorCategoryPeer::getAll();
		$smarty->assign("categories",$categories);


		if ( !empty($_GET["id"]) ) {
			$indicator = IndicatorPeer::get($_GET["id"]);
			if (!is_null($indicator)) {
				$smarty->assign("indicator",$indicator);
				$smarty->assign("action","edit");
	
				$actualCategories = $indicator->getIndicatorCategorys();
				$smarty->assign("actualCategories",$actualCategories);
	
				if ($actualCategories->isEmpty())
					$excludeCategories = array( -1);
				else {
					$excludeCategoriesIds = IndicatorCategoryPeer::getAssignedCategoriesArray($_GET["id"]);
					array_push($excludeCategoriesIds, -1);
				}
				$criteria = new Criteria();
				$criteria->add(IndicatorCategoryPeer::ID, $excludeCategoriesIds, Criteria::NOT_IN);
				$categoryCandidates = IndicatorCategoryPeer::doSelect($criteria);
				$smarty->assign("categoryCandidates",$categoryCandidates);
			}
			else
				$smarty->assign("notValidId",true);			
		}
		else {
			//voy a crear un indicator nuevo
			$indicator = new Indicator();
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
