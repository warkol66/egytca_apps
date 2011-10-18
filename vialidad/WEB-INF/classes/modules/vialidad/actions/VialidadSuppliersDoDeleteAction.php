<?php

class VialidadSuppliersDoDeleteAction extends BaseAction {

	function VialidadSuppliersDoDeleteAction() {
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
		$section = "Suppliers";
		$smarty->assign("section",$section);

		$supplier = SupplierPeer::get($_POST["id"]);
		$supplier->delete();

		if ($supplier->isDeleted()) {
			if (mb_strlen($supplier->getName()) > 120)
				$cont = " ... ";
			$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
			Common::doLog('success', substr($supplier->getName(), 0, 120) . $logSufix);

			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');

	}

}
