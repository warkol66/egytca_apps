<?php

class CommonDoEditFieldXAction extends BaseAction {

	function CommonDoEditFieldXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$objectType = ucfirst($request->getParameter('objectType'));
		$objectId = $request->getParameter('objectId');

		$object = BaseQuery::create($objectType)->findOneById($objectId);

		if (!empty($object) && is_object($object) && (!empty($_POST['paramName']) && !empty($_POST['paramValue']))) {
			
			if ($_POST["isNumeric"])
				$_POST['paramValue'] = Common::convertToMysqlNumericFormat($_POST['paramValue']);
			
			$object->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			if ($object->isModified() && $object->save()) {
				$smarty->assign("paramValue", $object->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
				$smarty->assign("isDate", $_POST["isDate"]);
				$smarty->assign("isNumeric", $_POST["isNumeric"]);
			} else {
				$smarty->assign("paramValue", $object->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
				$smarty->assign("isDate", $_POST["isDate"]);
				$smarty->assign("isNumeric", $_POST["isNumeric"]);
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
