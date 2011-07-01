<?php

class ServicesMultilangTextsEditBulkAction extends BaseAction {

	function ServicesMultilangTextsEditBulkAction() {
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

		//asigno todo los modulos posibles para que se pueda seleccionar
		$modules = ModulePeer::getAllPresent();
		$smarty->assign('modules',$modules);

		if (!empty($_GET["id"])) {
			$texts = MultilangTextPeer::getByIdAndModuleName($_GET["id"],$_GET["moduleName"]);
			$smarty->assign("texts",$texts);
			$smarty->assign("textId",$_GET["id"]);
			$smarty->assign("currentPage",$_GET["currentPage"]);
			$smarty->assign("action","edit");
		}
		else
			$smarty->assign("action","create");

		$smarty->assign("moduleName",$_GET["moduleName"]);
		$appLanguages = MultilangLanguagePeer::getAll();
		$smarty->assign("appLanguages",$appLanguages);
		$smarty->assign("appLanguagesCount",count($appLanguages));
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
