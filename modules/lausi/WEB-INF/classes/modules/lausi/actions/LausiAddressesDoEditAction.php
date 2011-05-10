<?php

class LausiAddressesDoEditAction extends BaseAction {

	function LausiAddressesDoEditAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Addresses";
		$smarty->assign("section",$section);
		
		$params = $_POST['address'];	
		
		$filters = $_POST['filters'];	

		if ($_POST["action"] == "edit") {
			//estoy editando un address existente
			$address = AddressPeer::get($_POST["id"]);
      		$myRedirectConfig = $mapping->findForwardConfig('success');
			
		} else {
			//estoy creando un nuevo address
			$address = new Address;
			$myRedirectConfig = $mapping->findForwardConfig('success-creation');
			
			$myRedirectPath = $myRedirectConfig->getpath();
			$queryData = '&id='. $address->getId();
			$myRedirectPath .= $queryData;
			$myRedirectConfig = new ForwardConfig($myRedirectPath, True);
		}
		
		Common::setObjectFromParams($address, $params);

		if (!$address->save()) {
			$smarty->assign("circuitIdValues",CircuitPeer::getAll());
			$smarty->assign("address",$address);	
			$smarty->assign("action","create");
			$smarty->assign("message","error");
			return $mapping->findForwardConfig('failure');
		}
		
		//caso de redireccionamiento desde opciones de busqueda de addressesList
		if (!empty($filters) && count($filters)) {
   			$myRedirectPath = $myRedirectConfig->getpath();
			foreach ($filters as $key => $value)
				$myRedirectPath .= "&filters[$key]=$value";
			$myRedirectConfig = new ForwardConfig($myRedirectPath, True);
		}

		$smarty->assign('address',$address);

		return $myRedirectConfig;
	}
}
