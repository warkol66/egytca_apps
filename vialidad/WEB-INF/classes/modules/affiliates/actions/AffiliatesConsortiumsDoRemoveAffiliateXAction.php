<?php

class AffiliatesConsortiumsDoRemoveAffiliateXAction extends BaseAction {

	function AffiliatesConsortiumsDoRemoveAffiliateXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);

		$consortiumId = $request->getParameter('affiliate1');
		$affiliateId = $request->getParameter('affiliate2');

	//print_r($_POST);
	//die;
		if (!empty($consortiumId) && !empty($affiliateId)) {

			$consortium = AffiliateQuery::create()->findOneById($consortiumId);
			$affiliate = AffiliateQuery::create()->findOneById($affiliateId);
			//print_r($consortium);
			//print_r($affiliate);
			
			if (!empty($consortium) && !empty($affiliate)) {
			//echo "prueba";
				//print_r(AffiliateConsortiumQuery::create()->filterByAffiliateRelatedByAffiliate1($consortium)->filterByAffiliateRelatedByAffiliate2($affiliate)->findOne());
				//die;
				if (AffiliateConsortiumQuery::create()->filterByAffiliateRelatedByAffiliate1($consortium)->filterByAffiliateRelatedByAffiliate2($affiliate)->delete()) {
					$smarty->assign('affiliateId', $affiliateId);
					return $mapping->findForwardConfig('success');
				}
				return $mapping->findForwardConfig('error');
			}
			else {
				return $mapping->findForwardConfig('error');
			}
			return $mapping->findForwardConfig('error');
		}
		else {
			return $mapping->findForwardConfig('error');
		}
	}

}
