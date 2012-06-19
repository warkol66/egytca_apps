<?php

class ActorsSortAction extends BaseAction {

	function ActorsSortAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		
		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Actors";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$filters = $_GET["filters"];
		$actors = BaseQuery::create('Actor')->orderByRank(Criteria::DESC)->find();
		
		$smarty->assign("filters",$filters);
		$smarty->assign('actors',$actors);

		$smarty->assign("message",$_GET["message"]);
		
		$this->template->template = 'TemplateJQuery.tpl';
		return $mapping->findForwardConfig('success');
	}

}