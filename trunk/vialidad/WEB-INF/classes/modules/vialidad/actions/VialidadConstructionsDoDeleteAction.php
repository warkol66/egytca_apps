<?php

class VialidadConstructionsDoDeleteAction extends BaseAction {

	function VialidadConstructionsDoDeleteAction() {
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
		$section = "Constructions";
		$smarty->assign("section",$section);

		$construction = ConstructionPeer::get($_POST["id"]);
		$construction->delete();

		if ($construction->isDeleted()) {
			if (mb_strlen($construction->getName()) > 120)
				$cont = " ... ";
			$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
			Common::doLog('success', substr($construction->getName(), 0, 120) . $logSufix);

			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');

	}

}
