<?php

class VialidadFineDoEditXAction extends BaseAction {

	function VialidadFineDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$_POST['params']['price'] = Common::convertToMysqlNumericFormat($_POST['params']['price']);

		$userParams = Common::userInfoToDoLog();
		$params = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing item

			$fine = FineQuery::create()->findOneById($_POST["id"]);
			$fine = Common::setObjectFromParams($fine, $params);
			
			if ($fine->isModified() && !$fine->save())
				throw new Exception('no se pudo guardar los cambios');

			if (!empty($_REQUEST["params"]["constructionId"])) {
				$construction = ConstructionQuery::create()->findOneById($_REQUEST["params"]["constructionId"]);
				$construction->clearConstructionItems();
				$construction->addConstructionItem($fine);
				$construction->save();
			}
			
			if (mb_strlen($_REQUEST["params"]["description"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: edit','common');
			Common::doLog('success', substr($_REQUEST["params"]["description"], 0, 120) . $logSufix);

			$smarty->assign('fine', $fine);
			return $mapping->findForwardConfig('success');

		}
		else { // New item

			$fine = new Fine();
			$fine = Common::setObjectFromParams($fine, $params);
			if (!$fine->save())
				throw new Exception('no se pudo guardar los cambios');

			if (!empty($_REQUEST["params"]["constructionId"])) {
				$construction = ConstructionQuery::create()->findOneById($_REQUEST["params"]["constructionId"]);
				$construction->addConstructionItem($fine);
				$construction->save();
			}
			
			if (mb_strlen($_REQUEST["params"]["description"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_REQUEST["params"]["description"], 0, 120) . $logSufix);

			$smarty->assign('fine', $fine);
			return $mapping->findForwardConfig('success');
		}

	}

}
