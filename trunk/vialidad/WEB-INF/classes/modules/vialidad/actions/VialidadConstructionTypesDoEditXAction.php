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
		$typeParams = array_merge_recursive($_POST["params"],$userParams);

		$id = $request->getParameter('id');
		$type = ConstructionTypeQuery::create()->findOneById($id);

		if (!empty($id) && !empty($type)) {
			$type = Common::setObjectFromParams($type,$typeParams);
			if ($type->isModified() && !$type->save()) 
				return $mapping->findForwardConfig('failure');
		}
		else {
			$type = new ConstructionType();
			$type = Common::setObjectFromParams($type,$typeParams);
			if (!$type->save())
				return $mapping->findForwardConfig('failure');
			$smarty->assign('newConstructionType', $type);
		}
		
		$constructionTypes = ConstructionTypeQuery::create()->find();
		$smarty->assign('constructionTypes', $constructionTypes);
		return $mapping->findForwardConfig('success');
	}

}
