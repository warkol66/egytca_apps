<?php

class CatalogAffiliateProductCodesListAction extends BaseAction {

	function CatalogAffiliateProductCodesListAction() {
		;
	}


	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
	  $smarty->assign("module",$module);
	
		$affiliates = AffiliatePeer::getAll();
		$smarty->assign("affiliates",$affiliates);		
		$smarty->assign("affiliateId",$_REQUEST['affiliateId']);
   
		if (!empty($_REQUEST["affiliateId"])) {
			$selectedAffiliate = AffiliatePeer::get($_REQUEST["affiliateId"]); 
			$smarty->assign("selectedAffiliate",$selectedAffiliate);		
			$pager = AffiliateProductCodePeer::getAllByAffiliateIdPaginated($_REQUEST["affiliateId"],$_GET["page"]);
			$smarty->assign("affiliateproductcodes",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=catalogAffiliateProductCodesList&affiliateId=".$_REQUEST["affiliateId"];
			$smarty->assign("url",$url);			
		}
   
		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("page",$_GET['page']);
		return $mapping->findForwardConfig('success');
	}

}

