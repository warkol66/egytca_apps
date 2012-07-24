<?php

class AffiliatesUsersDoDeleteAction extends BaseAction {

	function AffiliatesUsersDoDeleteAction() {
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
		$section = "Users";

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$affiliateUser = AffiliateUserPeer::get($_POST["id"]);
		
		if (Common::isAffiliatedUser() && !$affiliateUser->isOwner(Common::getLoggedUser()))
			//es usuario afiliado pero no es duenio de la instancia
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');

		if ($affiliateUser->delete())
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		else
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	}
}
