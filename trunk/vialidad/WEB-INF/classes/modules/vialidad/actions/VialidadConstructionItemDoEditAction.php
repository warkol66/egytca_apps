<?php

class VialidadConstructionItemDoEditAction extends BaseAction {

	function VialidadConstructionItemDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$itemParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing item

			$item = ConstructionItemQuery::create()->findOneById($_POST["id"]);
			$item = Common::setObjectFromParams($item,$itemParams);
			
			if ($item->isModified() && !$item->save()) 
				return $this->returnFailure($mapping,$smarty,$item,'failure-edit');

			if (!empty($_REQUEST["params"]["constructionId"])) {
				$construction = ConstructionQuery::create()->findOneById($_REQUEST["params"]["constructionId"]);
				$construction->clearConstructionItems();
				$construction->addConstructionItem($item);
				$construction->save();
			}
				
			$params["id"] = $_POST["id"];
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');

		}
		else { // New item

			$item = new ConstructionItem();
			$item = Common::setObjectFromParams($item,$itemParams);
			if (!$item->save())
				return $this->returnFailure($mapping,$smarty,$item);

			if (!empty($_REQUEST["params"]["constructionId"])) {
				$construction = ConstructionQuery::create()->findOneById($_REQUEST["params"]["constructionId"]);
				$construction->addConstructionItem($item);
				$construction->save();
			}
			
			$params["id"] = $item->getId();
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}

	}

}
