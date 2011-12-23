<?php

require_once("CategorySelectAction.php");

class ProfilesFormViewMultipleSelectAction extends CategorySelect{
	
	function execute($mapping, $form, &$request, &$response) {

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);		

		if ($request->getParameter("alls") == 1)
    	$actors = ActorPeer::getAll();
		$categoryId = $request->getParameter("categoryId");
		if (!empty($categoryId))
			$actors = ActorPeer::getByCategory($categoryId);
		$smarty->assign('actors',$actors);
		global $system;
		$maxActors = $system["config"]["mer"]["profiles"]["max_actors_compare"];
		$smarty->assign('maxActors',$maxActors);
		return parent::execute($mapping,$form,$request,$response);		
	}
}
