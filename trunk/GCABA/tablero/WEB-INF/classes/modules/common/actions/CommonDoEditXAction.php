<?php

class CommonDoEditXAction extends BaseAction {

	function CommonDoEditXAction() {
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
		$objectParams = array_merge_recursive($_POST["params"],$userParams);

		$objectType = ucfirst($request->getParameter('objectType'));
		$objectId = $request->getParameter('objectId');

		if (class_exist($objectType)) {
			if (!empty($objectId)) {
				$object = BaseQuery::create($objectType)->findOneById($objectId);
	
				if (!empty($object)) {
					$object = BaseQuery::create($objectType)->findOneById($objectId);
					$object = Common::setObjectFromParams($object,$objectParams);
					if ($object->isModified() && !$object->save()) 
						return $mapping->findForwardConfig('failure');
				}
				else
					return $mapping->findForwardConfig('failure');
			}
			else {
				$object = new $objectType();
				$object = Common::setObjectFromParams($source,$sourceParams);
				if (!$object->save())
					return $mapping->findForwardConfig('failure');
				$smarty->assign('object', $object);
			}
			
			$objects = SourceQuery::create()->find();
			$smarty->assign('objects', $objects);
			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');
	}
}
