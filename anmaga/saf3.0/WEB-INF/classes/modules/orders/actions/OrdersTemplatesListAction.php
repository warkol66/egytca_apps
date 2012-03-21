<?php

class OrdersTemplatesListAction extends BaseAction {

	function OrdersTemplatesListAction() {
		;
	}

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

		$module = "Orders";
		$section = "Templates";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);


		if (!empty($_SESSION["loginUser"])) {
			$pager = OrderTemplatePeer::getAllPaginated($_GET["page"]);
			$smarty->assign("all",1);
		}
		else {
			$pager = OrderTemplatePeer::getAllByAffiliateIdPaginated($_SESSION["loginAffiliateUser"]->getAffiliateId(),$_GET["page"]);
			$smarty->assign("all",0);
		}

		$smarty->assign("orderTemplates",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=ordersTemplatesList";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
