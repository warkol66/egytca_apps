<?php

class AffiliatesUsersDoEditAction extends BaseAction {

	function AffiliatesUsersDoEditAction() {
		;
	}

	function assignObjects($smarty) {
		if (empty($_POST["id"]))
			$affiliateUser = new AffiliateUser;
		else
			$affiliateUser = AffiliateUserPeer::get($_POST["id"]);
		Common::setObjectFromParams($affiliateUser, $affiliateUserParams);
		$smarty->assign("currentAffiliateUser", $affiliateUser);	
		$timezonePeer = new TimezonePeer();
		$smarty->assign('timezones',$timezonePeer->getAll());	
		$levels = AffiliateLevelPeer::getAll();
		$smarty->assign("levels",$levels);	
		$smarty->assign('ownerCreation', $_POST["ownerCreation"]);

		if (!empty($_SESSION["loginUser"])) {
			$affiliatePeer = new AffiliatePeer();
			$affiliates = $affiliatePeer->getAll();
			$smarty->assign("affiliates",$affiliates);
		}	

		if (empty($_POST["id"])){
			$smarty->assign("action","create");
			$smarty->assign("accion","creacion");
		}			
		else{
			$smarty->assign("action","edit");
			$smarty->assign("accion","edicion");
		}
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$smarty->assign("module",$module);
		$section = "Users";
		$smarty->assign("section",$section);
		
		$usersPeer= new AffiliateUserPeer();
		$affiliateUserParams = $_POST["affiliateUser"];

		if (!empty($_SESSION["loginUser"]))
			$affiliateId = $_POST["affiliateUser"]["affiliateId"];
		else
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
		$smarty->assign("affiliateId",$affiliateId);
		
		$filters = array('searchAffiliateId' => $affiliateId);
		
		if ((empty($_POST["id"]) && empty($_POST["pass"])) || ($_POST["pass"] != $_POST["pass2"])) {
			$this->assignObjects($smarty);
			$smarty->assign("message","wrongPassword");
			return $mapping->findForwardConfig('failure');
		}
		
		if (empty($_POST["id"]))
			$affiliateUser = new AffiliateUser;
		else
			$affiliateUser = AffiliateUserPeer::get($_POST["id"]);
		
		Common::setObjectFromParams($affiliateUser, $affiliateUserParams);
		if (!empty($_POST["pass"])) {
			$affiliateUser->setPasswordString($_POST["pass"]);
			$affiliateUser->setPasswordUpdatedTime();
		}
		$affiliate = $_SESSION['newAffiliate'];
		if (!empty($affiliate) && !empty($_POST["ownerCreation"])) {
			$affiliateUser->validate();
			$failures = $affiliateUser->getValidationFailures();
			//Nos aseguramos que la unica falla que tenga sea por el affiliateId.
			if (count($failures) > 1 || (!empty($failures[0]) && $failures[0]->getColumn() != AffiliateUserPeer::AFFILIATEID)) {
				$this->assignObjects($smarty);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
			$affiliate->save(); //necesitamos que tenga id
			$affiliateUser->setAffiliateRelatedByAffiliateid($affiliate);
		}

		if (!empty($affiliate) && !empty($_POST["ownerCreation"])) {
			$classKey = $affiliate->getclassKey();
			switch ($classKey) {
				case 1:
					$forward = "success-owner";
					break;
				case 2:
					$forward = "success-contractor-owner";
					$affiliateUser->setLevelid(1);
					break;
				case 3:
					$forward = "success-verifier-owner";
					$affiliateUser->setLevelid(2);
					break;
			}
		}

		if ($affiliateUser->isModified() && !$affiliateUser->save()) {
			$this->assignObjects($smarty);
			$smarty->assign("message","errorUpdate");
			return $mapping->findForwardConfig('failure');
		}
		
		if (!empty($affiliate) && !empty($_POST["ownerCreation"])) {
			$affiliate->setOwnerId($affiliateUser->getId());
			if (!$affiliate->save()) {
				$this->assignObjects($smarty);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
			return $this->addFiltersToForwards($filters, $mapping, $forward);
		}
		
		return $this->addFiltersToForwards($filters, $mapping, 'success');
	}
}
