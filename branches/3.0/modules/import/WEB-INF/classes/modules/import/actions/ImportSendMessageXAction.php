<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("ProductPeer.php");
require_once("CommentPeer.php");
require_once("UserPeer.php");
require_once("AffiliateUserPeer.php");

class ImportSendMessageXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSendMessageXAction() {
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
		//por ser una action ajax.		
		$this->template->template = "template_ajax.tpl";

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
		$commentPeer = new CommentPeer();

		if (empty($_POST['message']) && empty($_POST['productRequestId']))
			return $mapping->findForwardConfig('failure');

		if (Common::isAdmin()) {
			//debe haber definido el tipo de destinatario de mensaje
			if (empty($_POST['messageTo']))
				return $mapping->findForwardConfig('failure');
			
			if ($_POST['messageTo'] == 'user') {
				$comment = $commentPeer->createAdminToUserComment($_POST['productRequestId'],Common::getAdminUserId(),$_POST['message']);
				if ($comment == false)
					return $mapping->findForwardConfig('failure');
			}
			
			if ($_POST['messageTo'] == 'supplier') {
				$comment = $commentPeer->createAdminToSupplierComment($_POST['productRequestId'],Common::getAdminUserId(),$_POST['message']);
				if ($comment == false)
					return $mapping->findForwardConfig('failure');
			}


		}

		if (Common::isSupplier()) {
			$comment = $commentPeer->createSupplierToAdminComment($_POST['productRequestId'],Common::getSupplierUserId(),$_POST['message']);
			if ($comment == false)
				return $mapping->findForwardConfig('failure');
		}

		if (Common::isAffiliatedUser()) {

			$comment = $commentPeer->createUserToAdminComment($_POST['productRequestId'],Common::getAffiliatedId(),$_POST['message']);

			if ($comment == false)
				return $mapping->findForwardConfig('failure');

		}
		echo $comment;
		
		$smarty->assign('comment',$comment);
		$smarty->assign('userPeer',new UserPeer());
		$smarty->assign('affiliateUserPeer',new AffiliateUserPeer());

		return $mapping->findForwardConfig('success');

	}

}
?>
