<?php

class VialidadContractsDoDeleteAction extends BaseAction {

	function VialidadContractsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Contracts";
		$smarty->assign("section",$section);

		$contract = ContractPeer::get($_POST["id"]);
		$contract->delete();

		if ($contract->isDeleted()) {
			if (mb_strlen($contract->getName()) > 120)
				$cont = " ... ";
			$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
			Common::doLog('success', substr($contract->getName(), 0, 120) . $logSufix);

			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');

	}

}
