<?php

class ClientsDoEditAction extends BaseAction {

	function ClientsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Clients";
		$smarty->assign("module",$module);

		$clientPeer = new ClientPeer();

		if ($_POST["action"] == "edit" && !empty($_POST["id"])) {
			$params["id"] = $_POST["id"];
			$client = ClientPeer::get($_POST["id"]);
			if (!empty($client)) {
				$client = Common::setObjectFromParams($client,$_POST["params"]);

				if ($client->isModified() && !$client->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
			}
		}
		else {
			$client = new Client();
			$client = Common::setObjectFromParams($client,$_POST["params"]);

			if(!$client->validate()) {
				$smarty->assign("client",$client);
				$smarty->assign("message","error");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
			}
			else{
				$_SESSION['newClient'] = $client;
				$params['ownerCreation'] = 1;
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-create');
			}
		}
	}

}
