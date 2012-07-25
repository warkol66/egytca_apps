<?php

class CategoriesSortAction extends BaseAction {

	function CategoriesSortAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		
		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Categories";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$filters = $_GET["filters"];
		$categories = BaseQuery::create('Category')->find();
		
		$smarty->assign("filters",$filters);
		$smarty->assign('categories',$categories);

		$smarty->assign("message",$_GET["message"]);
		
		$this->template->template = 'TemplateJQuery.tpl';
		return $mapping->findForwardConfig('success');
	}

}