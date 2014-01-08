<?php

class VialidadCertificatesListAction extends BaseAction {

	function VialidadCertificatesListAction() {
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
		$section = "Certificates";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];

    if (!isset($filters["perPage"]))
			$filters["perPage"] = Common::getRowsPerPage();

		$pager = CertificateQuery::create()->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$url = "Main.php?do=vialidadCertificatesList";
		foreach ($filters as $key => $value)
			if(is_array($value)) {
				$nKey = $key;
				foreach ($value as $key => $value)
					$url .= "&filters[$nKey][$key]=" . htmlentities(urlencode($value));
			}
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$smarty->assign("url",$url);
		
		if (!empty($filters["constructionid"]))
			$smarty->assign("defaultConstructionValue",ConstructionQuery::create()->findPk($filters["constructionid"]));
		
		if (!empty($filters["contractorid"]))
			$smarty->assign("defaultContractorValue",  AffiliateQuery::create()->findPk($filters["contractorid"]));
		
		if (!empty($filters["contractid"]))
			$smarty->assign("defaultContractValue",  ContractQuery::create()->findPk($filters["contractid"]));

		$smarty->assign("filters",$filters);
		$smarty->assign("certificates",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig("success");
	}
		
}
