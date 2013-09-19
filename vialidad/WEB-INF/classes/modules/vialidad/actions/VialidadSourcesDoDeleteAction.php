<?php

class VialidadSourcesDoDeleteAction extends BaseAction {

	function VialidadSourceDoDeleteAction() {
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
		$source = SourceQuery::create()->findOneById($id);

		if (!empty($source)) {
			$contractsCount = ContractQuery::create()->filterBySource($source)->count();
			if ($contractsCount == 0) {
				$source->delete();
				if ($source->isDeleted()) {
					if (mb_strlen($source->getName()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($source->getName(), 0, 120) . $logSufix);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
