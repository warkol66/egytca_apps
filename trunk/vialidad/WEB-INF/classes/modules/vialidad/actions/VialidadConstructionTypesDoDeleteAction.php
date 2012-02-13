<?php

class VialidadConstructionTypesDoDeleteAction extends BaseAction {

	function VialidadConstructionTypesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $request->getParameter('id');
		$type = ConstructionTypeQuery::create()->findOneById($id);
		if (!empty($type)) {
			$type->delete();
			if ($type->isDeleted()) {
				if (mb_strlen($type->getName()) > 120)
					$cont = " ... ";
				$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
				Common::doLog('success', substr($type->getName(), 0, 120) . $logSufix);
	
				return $mapping->findForwardConfig('success');
			}
		}
		else
			return $mapping->findForwardConfig('failure');
	}
}
