<?php

require_once("BaseAction.php");
require_once("AffiliateProductCodePeer.php");
require_once("AffiliatePeer.php");

class CatalogAffiliateProductCodesListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogAffiliateProductCodesListAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
	  $smarty->assign("module",$module);
	
		$affiliates = AffiliatePeer::getAll();
		$smarty->assign("affiliates",$affiliates);		
   
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
?>
