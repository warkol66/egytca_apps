<?php
require_once 'BaseAction.php';

class ClientsUsersDoEditAction extends BaseAction {

	function ClientsUsersDoEditAction() {
		;
	}

	function assignObjects($smarty) {
		if (empty($_POST["id"]))
			$clientUser = new ClientUser;
		else
			$clientUser = ClientUserPeer::get($_POST["id"]);
		Common::setObjectFromParams($clientUser, $clientUserParams);
		$smarty->assign("currentClientUser", $clientUser);	
		$timezonePeer = new TimezonePeer();
		$smarty->assign('timezones',$timezonePeer->getAll());	
		$levels = ClientLevelPeer::getAll();
		$smarty->assign("levels",$levels);	
		$smarty->assign('ownerCreation', $_POST["ownerCreation"]);

		if (!empty($_SESSION["loginUser"])) {
			$clients = ClientPeer::getAll();
			$smarty->assign("clients",$clients);
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

		$module = "Clients";
		$smarty->assign("module",$module);
		$section = "Users";
		$smarty->assign("section",$section);
		
		$usersPeer= new ClientUserPeer();
		
		$clientUserParams = $_POST["clientUser"];

		if ( !empty($_SESSION["loginUser"]) )
			$clientId = $_POST["clientUser"]["clientId"];
		else
			$clientId = $_SESSION["loginClientUser"]->getClientId();
		$smarty->assign("clientId",$clientId);
		
		$filters = array('searchClientId' => $clientId);
		
		if ( ( empty($_POST["id"]) && empty($_POST["pass"]) ) || ($_POST["pass"] != $_POST["pass2"]) ) {
			$this->assignObjects($smarty);
			$smarty->assign("message","wrongPassword");
			return $mapping->findForwardConfig('failure');
		}
		
		if (empty($_POST["id"]))
			$clientUser = new ClientUser;
		else
			$clientUser = ClientUserPeer::get($_POST["id"]);
		
		Common::setObjectFromParams($clientUser, $clientUserParams);
		$clientUser->setPasswordString($_POST["pass"]);
		$clientUser->setPasswordUpdatedTime();
		
		$client = $_SESSION['newClient'];
		if (!empty($client) && !empty($_POST["ownerCreation"])) {
			$clientUser->validate();
			$failures = $clientUser->getValidationFailures();
			//Nos aseguramos que la unica falla que tenga sea por el clientId.
			if (count($failures) > 1 || (!empty($failures[0]) && $failures[0]->getColumn() != ClientUserPeer::AFFILIATEID)) {
				$this->assignObjects($smarty);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
			$client->save(); //necesitamos que tenga id
			$clientUser->setClientRelatedByClientid($client);
		}
		
		if (!$clientUser->save()) {
			$this->assignObjects($smarty);
			$smarty->assign("message","errorUpdate");
			return $mapping->findForwardConfig('failure');
		}
		
		if (!empty($client) && !empty($_POST["ownerCreation"])) {
			$client->setOwnerId($clientUser->getId());
			if (!$client->save()) {
				$this->assignObjects($smarty);
				$smarty->assign("message","errorUpdate");
				return $mapping->findForwardConfig('failure');
			}
			return $this->addFiltersToForwards($filters, $mapping, 'success-owner');
		}
		
		return $this->addFiltersToForwards($filters, $mapping, 'success');
	}
}
