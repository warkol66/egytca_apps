<?php

	class PanelBudgetRelationsDoUpdateXAction extends BaseAction {
		
	function executeFailure($mapping, $err) {
		//paso el error
		$myRedirectConfig = $mapping->findForwardConfig('failure');
		$myRedirectPath = $myRedirectConfig->getpath();
		$myRedirectPath .= '&error=' . 'Error';
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$section = "Budget Relations";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);
		
		$budget = BudgetRelationQuery::create()->findOneById($_POST['id']);
		/*print_r($budget);
		die();*/
		
		// Muestro todos los errores
		/*error_reporting(E_ALL - E_STRICT - E_NOTICE - E_WARNING);
		ini_set('display_errors',1);*/
		require_once('WEB-INF/classes/includes/NuSOAP/nusoap.php');
		
		$budget = BudgetRelationQuery::create()->findOneById($_POST['id']);
		
		//si existe la partida presupuestaria
		if(is_object($budget)){
			
			//consulto al ws
			$bodyxml = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
				<s:Header />
				<s:Body>
					<ConsultarPartidaPresupuestaria xmlns="http://tempuri.org/">
						<cp xmlns:d4p1="http://schemas.datacontract.org/2004/07/WCF_ENTIDADES" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
							<d4p1:Actividad>'. $budget->getBudgetactivity() .'</d4p1:Actividad>
							<d4p1:Ejercicio>'. $budget->getBudgetyear() .'</d4p1:Ejercicio>
							<d4p1:Entidad>'. $budget->getBudgetEntity() .'</d4p1:Entidad>
							<d4p1:FueFin>'. $budget->getBudgetSource() .'</d4p1:FueFin>
							<d4p1:Inciso>'. $budget->getBudgetSubsection() .'</d4p1:Inciso>
							<d4p1:Jurisdiccion>'. $budget->getBudgetJurisdiction() .'</d4p1:Jurisdiccion>
							<d4p1:Moneda>'. $budget->getBudgetCurrency() .'</d4p1:Moneda>
							<d4p1:Obra>'. $budget->getBudgetConstruction() .'</d4p1:Obra>
							<d4p1:Parcial>'. $budget->getBudgetPartial() .'</d4p1:Parcial>
							<d4p1:Principal>'. $budget->getBudgetCapital() .'</d4p1:Principal>
							<d4p1:Programa>'. $budget->getBudgetProgram() .'</d4p1:Programa>
							<d4p1:Proyecto>'. $budget->getBudgetProyect() .'</d4p1:Proyecto>
							<d4p1:SubJurisdiccion>'. $budget->getBudgetSubjurisdiction() .'</d4p1:SubJurisdiccion>
							<d4p1:SubParcial>'. $budget->getBudgetSubPartial() .'</d4p1:SubParcial>
							<d4p1:SubPrograma>'. $budget->getBudgetSubProgram() .'</d4p1:SubPrograma>
							<d4p1:UbicaGeo>'. $budget->getBudgetGeolocation .'</d4p1:UbicaGeo>
						</cp>
					</ConsultarPartidaPresupuestaria>
				</s:Body>
				</s:Envelope>';
				
				// Testing
				$webServiceBudget = new nusoap_client("http://172.17.7.8:83/wcftest/Servicio.svc?wsdl",true);
				// Producción
				//$webServiceBudget = new nusoap_client("http://10.73.2.136:83/wcfroot/servicio.svc?wsdl",true);
				$err = $webServiceBudget->getError();
				if ($err) {
					$budget->setMatch(false)->save();
					$smarty->assign("budget", $budget);
					$smarty->assign("error", addslashes($err));
					return $mapping->findForwardConfig('success');
				}
				
				$webServiceBudget->soap_defencoding = 'utf-8';
				$webServiceBudget->useHTTPPersistentConnection();
				$webServiceBudget->setUseCurl($useCURL);
				$bsoapaction = "http://tempuri.org/IServicio/ConsultarPartidaPresupuestaria";
				$result = $webServiceBudget->send($bodyxml, $bsoapaction);
				// Check for a fault
				if ($webServiceBudget->fault) {
					//Actualizo el registro indicando que no lo encontro
					$budget->setMatch(false)->save();
				} else {
					//Me fijo si hay errores
					$err = $webServiceBudget->getError();
					if ($err) {
						// Error
						//$budget->setUpdatedsigaf(date("Y-m-d H:i:s"));
						$budget->setMatch(false)->save();
						$smarty->assign("error", addslashes($err));
					} else {
						if(is_array($result)){
							// Actualizo el registro en la base con $result
							$budget->setMatch(true);
							$budget->setUpdatedsigaf(date("Y-m-d H:i:s"));
							$budget->setDefinitive($result['ConsultarPartidaPresupuestariaResult']['Indicativa']['Definitivo']);
							$budget->setAccrued($result['ConsultarPartidaPresupuestariaResult']['Indicativa']['Devengado']);
							$budget->setPaid($result['ConsultarPartidaPresupuestariaResult']['Indicativa']['Pagado']);
							$budget->setPreventive($result['ConsultarPartidaPresupuestariaResult']['Indicativa']['Preventivo']);
							$budget->setRestricted($result['ConsultarPartidaPresupuestariaResult']['Indicativa']['Restringido']);
							$budget->setActive($result['ConsultarPartidaPresupuestariaResult']['Indicativa']['Vigente']);
							$budget->save();
						} else {
							$budget->setMatch(false)->save();
						}
					}
				}
			$smarty->assign("budget", $budget);
			return $mapping->findForwardConfig('success');
		} else {
			//no se encontro la partida presupuestaria en la base
			$smarty->assign("message", "error");
			return $mapping->findForwardConfig('success');	
		}
	}

}
