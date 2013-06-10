<?php

class IndicatorsListAction extends BaseAction {

	function IndicatorsListAction() {
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
		$indicatorsCategories = IndicatorCategoryPeer::getAll();
		$smarty->assign("indicatorsCategories",$indicatorsCategories);

		if (isset($_GET['filters']))
			$this->applyFilters($indicatorsPeer,$_GET['filters'],$smarty);

		$pager = $indicatorsPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("indicators",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=indicatorsList";

		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}


