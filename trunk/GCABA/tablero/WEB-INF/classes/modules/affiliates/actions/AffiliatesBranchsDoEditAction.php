<?php

require_once("BaseAction.php");
require_once("BranchPeer.php");
require_once("AffiliatePeer.php");

class AffiliatesBranchsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AffiliatesBranchsDoEditAction() {
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

		$module = "Affiliates";
		$section = "Branchs";

		if (!empty($_SESSION["loginUser"])) {		
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);			
			$smarty->assign("all",1);
			$affiliateId = $_POST["affiliateId"];
		}
		else {
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
			$smarty->assign("all",0);
		}		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un branch existente

			if ( BranchPeer::update($_POST["id"],$_POST["affiliateId"],$_POST["number"],$_POST["name"],$_POST["phone"],$_POST["contact"],$_POST["contactEmail"],$_POST["memo"],$_POST["code"]) )
      			return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo branch

      if ( !BranchPeer::create($_POST["affiliateId"],$_POST["number"],$_POST["name"],$_POST["phone"],$_POST["contact"],$_POST["contactEmail"],$_POST["memo"],$_POST["code"]) ) {
			$smarty->assign("id",$_POST["id"]);
						$smarty->assign("affiliateId",$_POST["affiliateId"]);
						$smarty->assign("number",$_POST["number"]);
						$smarty->assign("name",$_POST["name"]);
						$smarty->assign("phone",$_POST["phone"]);
						$smarty->assign("contact",$_POST["contact"]);
						$smarty->assign("contactEmail",$_POST["contactEmail"]);
						$smarty->assign("memo",$_POST["memo"]);
						$smarty->assign("code",$_POST["code"]);
							$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
?>
