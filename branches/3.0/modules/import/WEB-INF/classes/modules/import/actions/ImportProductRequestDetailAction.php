<?php

require_once("BaseAction.php");
require_once("ProductRequestPeer.php");
require_once("ProductPeer.php");
require_once("PortPeer.php");
require_once("IncotermPeer.php");
require_once("CommentPeer.php");
require_once("UserPeer.php");
require_once("AffiliateUserPeer.php");

class ImportProductRequestDetailAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportProductRequestDetailAction() {
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

		$module = "Import";
		$smarty->assign('module',$module);

		//verificamos que se envie un request id
		if ( empty($_GET['productRequestId'])) {
			return $mapping->findForwardConfig('failure');	
		}

		$productRequest = ProductRequestPeer::get($_GET['productRequestId']);
		if (!empty($productRequest))
			$productInfo = ProductPeer::get($productRequest->getProductId());

		
		if (Common::isAdmin()) {
			$comments = CommentPeer::getAllFromProductRequestForAffiliateUser($_GET['productRequestId']);
			$commentsSupplier = CommentPeer::getAllFromProductRequestForSupplier($_GET['productRequestId']);
			$smarty->assign('commentsSupplier',$commentsSupplier);

		}

		if (Common::isSupplier()) {
			//seteamos las categorias necesarias de incoterms y puertos		
			$ports = PortPeer::getAll();
			$incoterms = IncotermPeer::getAll();
			$comments = CommentPeer::getAllFromProductRequestForSupplier($_GET['productRequestId']);

			$smarty->assign('ports',$ports);
			$smarty->assign('incoterms',$incoterms);
		}

		if (Common::isAffiliatedUser())
			$comments = CommentPeer::getAllFromProductRequestForAffiliateUser($_GET['productRequestId']);

		$smarty->assign('comments',$comments);
		$smarty->assign('productRequest',$productRequest);
		$smarty->assign('productInfo',$productInfo);
		$smarty->assign('portPeer', new PortPeer());
		$smarty->assign('incotermPeer', new IncotermPeer());
		$smarty->assign('affiliateUserPeer', new AffiliateUserPeer());
		$smarty->assign('userPeer', new UserPeer());
		

		return $mapping->findForwardConfig('success');
	}

}
?>
