<?php

require_once("CategorySelectAction.php");

class ProfilesEditCategorySelectAction extends CategorySelect{
	
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

		$smarty->assign("successAction","profilesEdit");
		return parent::execute($mapping,$form,$request,$response);		
	}
}
