<?php

class VialidadSourcesDoEditXAction extends BaseAction {

	function VialidadSourcesDoEditXAction() {
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
			$source = BaseQuery::create('Source')->findOneById($id);
		else
			$source = new Source();

		$source->fromArray($params, BasePeer::TYPE_FIELDNAME);
		try {
			$source->save();
		} catch (Exception $e) {
			$smarty->assign("message", "No se pudo guardar la fuente");
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('status', 'done');
		$smarty->assign('sourceColl', BaseQuery::create('Source')->find());
		return $mapping->findForwardConfig('success');
	}

}
