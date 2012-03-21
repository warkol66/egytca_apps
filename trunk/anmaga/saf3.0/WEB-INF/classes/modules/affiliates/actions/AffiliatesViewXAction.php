<?php

class AffiliatesViewXAction extends BaseAction {


	function AffiliatesViewXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$section = "";
		
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$affiliatePeer= new AffiliatePeer();	

		$id = $_GET["id"];

		$affiliate=$affiliatePeer->get($id);
		$smarty->assign("affiliate",$affiliate);

		return $mapping->findForwardConfig('success');
	}

}
