<?php

class HeadlinesViewClippingAction extends BaseAction {
	
	function HeadlinesViewClippingAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_REQUEST["page"] > 0)
			$params["page"] = $_REQUEST["page"];

		if (!empty($_REQUEST["filters"]))
			$filters = $_REQUEST["filters"];

		if ($request->getParameter('noTemplate'))
			$this->template->template = 'TemplateAjax.tpl';

		$smarty->assign("filters", $filters);
		$smarty->assign("params", $params);
		$smarty->assign("page",$_REQUEST["page"]);

		$headlineId = $request->getParameter('id');
		if ($headlineId > 0) {

			$headline = HeadlineQuery::create()->findOneById($headlineId);
			if (!empty($headline)) {
				$clippingsPath = ConfigModule::get("headlines","clippingsPath");
				$imageFullname = $clippingsPath . $headlineId . '.jpg';

				$smarty->assign('headline', $headline);
				$smarty->assign('id', $headlineId);
				
				if (file_exists($imageFullname)) {
					$smarty->assign('image', $_GET["id"].'.jpg');
					list($displayedWidth, $displayedHeight) = Headline::getClippingDisplaySize($imageFullname);
					$smarty->assign('displayedWidth', $displayedWidth);
					$smarty->assign('displayedHeight', $displayedHeight);
				}
			}
		}
		else
			$smarty->assign("errorMessage", "ID inválido");

		return $mapping->findForwardConfig('success');
	}
}