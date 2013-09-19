<?php

class VialidadConstructionTypesDoEditXAction extends BaseAction {

	function VialidadConstructionTypesDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$userParams = Common::userInfoToDoLog();
		$params = array_merge_recursive($_POST["params"],$userParams);

		$id = $request->getParameter("id");
		if (!empty($id))
			$constructionType = BaseQuery::create('ConstructionType')->findOneById($id);
		else
			$constructionType = new ConstructionType();

		$constructionType->fromArray($params, BasePeer::TYPE_FIELDNAME);
		try {
			$constructionType->save();
		} catch (Exception $e) {
			$smarty->assign("message", "No se pudo guardar el tipo de obra");
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('status', 'done');
		$smarty->assign('constructionTypeColl', BaseQuery::create('ConstructionType')->find());
		return $mapping->findForwardConfig('success');
	}

}
