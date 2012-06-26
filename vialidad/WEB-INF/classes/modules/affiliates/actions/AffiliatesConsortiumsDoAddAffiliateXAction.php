<?php

class AffiliatesConsortiumsDoAddAffiliateXAction extends BaseAction {

	function AffiliatesConsortiumsDoAddAffiliateXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliate";
		$smarty->assign("module",$module);

		$consortiumId = $request->getParameter('consortiumId');
		$affiliateId = $request->getParameter('affiliateId');
		
		
		
		if (!empty($consortiumId) && !empty($affiliateId)) {

			$consortium = AffiliateQuery::create()->findOneById($consortiumId);
			$affiliate = AffiliateQuery::create()->findOneById($affiliateId);
			if (!empty($consortium) && !empty($affiliate)) {
				$exist = AffiliateConsortiumQuery::create()->filterByAffiliateRelatedByAffiliate1($consortium)->filterByAffiliateRelatedByAffiliate2($affiliate)->count();

				if (empty($exist)) {
					$affiliateConsortium = new AffiliateConsortium();
					$affiliateConsortium->setAffiliateRelatedByAffiliate1($consortium);
					$affiliateConsortium->setAffiliateRelatedByAffiliate2($affiliate);
					
						if (!$affiliateConsortium->save())
							return $mapping->findForwardConfig('error');

					$smarty->assign('consortium', $consortium);
					$smarty->assign('affiliate', $affiliate);

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
