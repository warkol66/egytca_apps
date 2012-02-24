<?php

class VialidadFineDoEditFieldXAction extends BaseAction {

	function VialidadFineDoEditFieldXAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$fine = FineQuery::create()->findOneById($_POST['id']);
		
		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			
			if ($_POST['paramName'] == 'price')
				$_POST['paramValue'] = Common::convertToMysqlNumericFormat($_POST['paramValue']);
			
			$fine->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$fine->save();
		}
		
		if (!empty($_POST['paramName'])) {
			switch ($_POST['paramName']) {
				case 'date':
					$smarty->assign('isDate', true);
					break;
				case 'price':
					$smarty->assign('isNumeric', true);
					break;
			}
			$smarty->assign("paramValue", $fine->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
		}
		
		return $mapping->findForwardConfig('success');
	}

}
