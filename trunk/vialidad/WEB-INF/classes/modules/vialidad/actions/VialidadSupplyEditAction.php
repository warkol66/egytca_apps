<?php

class VialidadSupplyEditAction extends BaseAction {

	function VialidadSupplyEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto

			$supply = SupplyPeer::get($_GET["id"]);

			if (is_null($supply))
				throw new Exception("Invalid ID");

			$smarty->assign("supply",$supply);
			$smarty->assign("action","edit");

		} else {
			//voy a crear un objeto nuevo
			$supply = new Supply();
			$smarty->assign("supply",$supply);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
