<?php
require_once 'BaseAction.php';
require_once("AffiliateUserPeer.php");

class AffiliatesUsersDoAddUserAction extends BaseAction {


	function AffiliatesUsersDoAddUserAction() {
		;
	}

	function assignObjects($smarty) {
		$smarty->assign("currentAffiliateUser",AffiliateUserPeer::getFromArray($_POST["affiliateUser"]));
		$smarty->assign("currentAffiliateUserInfo",AffiliateUserInfoPeer::getFromArray($_POST["affiliateUserInfo"]));
		$timezonePeer = new TimezonePeer();
		$smarty->assign('timezones',$timezonePeer->getAll());		
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

		$usersPeer= new AffiliateUserPeer();
		
		$affiliateUserParams = $_POST["affiliateUser"];
		$affiliateUserInfoParams = $_POST["affiliateUserInfo"];		

		if ( !empty($_SESSION["loginUser"]) )
			$affiliateId = $_POST["affiliateId"];
		else
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();

		if ( empty($affiliateUserParams["username"]) ) {
			$this->assignObjects($smarty);
			$smarty->assign("message","emptyUsername");			
			return $mapping->findForwardConfig('failure');
		}	

		if ( empty($affiliateUserParams["password"]) || ($affiliateUserParams["password"] != $affiliateUserParams["pass2"]) ) {
			$this->assignObjects($smarty);
			$smarty->assign("message","wrongPassword");
			return $mapping->findForwardConfig('failure');
		}

		AffiliateUserPeer::create($affiliateId,$paramsUser["username"],$paramsUser["pass"],1,$paramsUserInfo["name"],$paramsUserInfo["surname"],$paramsUserInfo["mailAddress"],$paramsUser["timezone"]);
		
		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$myReqQueryString = "&affiliateId=".$affiliateId;
		$myReqQueryString = htmlentities(urlencode($myReqQueryString));
		$myRedirectPath .= $myReqQueryString;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;
	}

}

