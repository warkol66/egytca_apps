<?php
require_once 'BaseAction.php';

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
			$affiliates = AffiliatePeer::getAll();
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


	/**
	* execute
	*
	* Procesa la solicitud HTTP solicitada, y crea su respectiva respuesta HTTP o
	* bien lo manda hacia otra web en donde aqui la crea. Devuelve un 
	* "ActionForward" describiendo donde y como se debe mandar la solicitud o
	* NULL si la respuesta ha sido completada. 
	* 
	* 
	* //@param ActionConfig		El ActionConfig (mapping) usado para seleccionar los sucesos
	* //@param ActionForm			El opcional ActionForm con los contenidos de las peticiones
	* //@param HttpRequestBase	El HTTP request de lo que se esta  procesando
	* //@param HttpRequestBase	La respuesta HTTP de lo que estan creando
	* //@public
	* 
	* 
	* @param string $mapping una variable que muestra los sucesos
	* @param array $form con todo el contenido a ejecutar
	* @param pointer &$request puntero a un string de lo que se esta solicitando
	* @param pointer &$response puntero a un string de la respuesta que ha dado el servidor
	* @return ActionForward string $mapping con la cadena "sucess" o "failure"
	*
	*/
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

		if ( !empty($_SESSION["loginUser"]) )
			$affiliateId = $_POST["affiliateUser"]["affiliateId"];
		else
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
		$smarty->assign("affiliateId",$affiliateId);
		
		$filters = array('searchAffiliateId' => $affiliateId);
		
		if ( ( empty($_POST["id"]) && empty($_POST["pass"]) ) || ($_POST["pass"] != $_POST["pass2"]) ) {
			$this->assignObjects($smarty);
			$smarty->assign("message","wrongPassword");
			return $mapping->findForwardConfig('failure');
		}
		
		if (empty($_POST["id"]))
			$affiliateUser = new AffiliateUser;
		else
			$affiliateUser = AffiliateUserPeer::get($_POST["id"]);
		
		Common::setObjectFromParams($affiliateUser, $affiliateUserParams);
		$affiliateUser->setPasswordString($_POST["pass"]);
		$affiliateUser->setPasswordUpdatedTime();
		
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
		
		if (!$affiliateUser->save()) {
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
			return $this->addFiltersToForwards($filters, $mapping, 'success-owner');
		}
		
		return $this->addFiltersToForwards($filters, $mapping, 'success');
	}
}
