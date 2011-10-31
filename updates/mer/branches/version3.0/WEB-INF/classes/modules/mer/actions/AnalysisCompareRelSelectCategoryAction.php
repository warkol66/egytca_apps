<?php

require_once("CategorySelectAction.php");

class AnalysisCompareRelSelectCategoryAction extends CategorySelect{
	
	function execute($mapping, $form, &$request, &$response) {

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "AnalysisRelations";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$smarty->assign("successAction","analysisCompareRel");
		return parent::execute($mapping,$form,$request,$response);		
	}
}
