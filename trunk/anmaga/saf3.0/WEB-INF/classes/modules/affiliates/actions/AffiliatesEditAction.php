<?php

class AffiliatesEditAction extends BaseAction {

	function AffiliatesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$smarty->assign("module",$module);

		$affiliatePeer= new AffiliatePeer();

		$msg = $request->getParameter("message");
		if(empty($msg)){
			$msg="noError";
		}
		$smarty->assign("message",$msg);

		$id = $request->getParameter("id");
		$affiliate = $affiliatePeer->get($id);
		if (empty($affiliate)) {
			$smarty->assign("action","create");
			$affiliate = new Affiliate();
		}
		else
			$smarty->assign("action","edit");
		
		$smarty->assign("affiliate",$affiliate);
		return $mapping->findForwardConfig('success');

	}

}