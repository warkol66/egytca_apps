<?php

class ServicesMultilangTextsDoDeleteAction extends BaseAction {

	function ServicesMultilangTextsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Services";
		$smarty->assign('module',$module);
		$section = "Multilang";
		$smarty->assign('section',$section);

		MultilangTextPeer::deleteByIdAndModuleName($_POST["id"],$_POST["moduleName"]);

		header("Location: Main.php?do=servicesMultilangTextsList&moduleName=".$_POST["moduleName"]."&page=".$_POST["currentPage"]);
		exit;

		return $mapping->findForwardConfig('success');

	}

}
