<?php

class AffiliatesSetOwnerAction extends BaseAction {

	function AffiliatesSetOwnerAction() {
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

		if ($_POST['userId'] && $_POST['affiliateId']) {
		
			$affiliate = AffiliatePeer::get($_POST['affiliateId']);
			$affiliate->setOwnerId($_POST['userId']);
			
			try {
				$affiliate->save();
			}
			catch(PropelException $exp) {
				return $mapping->findForwardConfig('failure');	
			}
		
		}

		return $mapping->findForwardConfig('success');

	}

}
