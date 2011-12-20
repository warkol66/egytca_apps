<?php

class ActorsSelectAction extends BaseAction {

	function ActorsSelectAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);		
		
		$category = CategoryPeer::retrieveByPK($request->getParameter("catID"));
		$actors = $category->getActors();
		$smarty->assign('category',$category);
		$smarty->assign('actors',$actors);
		return $mapping->findForwardConfig('success');
	}

}
