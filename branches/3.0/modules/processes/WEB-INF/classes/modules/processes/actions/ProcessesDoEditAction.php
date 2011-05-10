<?php

require_once("BaseAction.php");

class ProcessesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProcessesDoEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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

		$module = "Processes";
		$section = "Process";

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un process existente

			$_POST["paramsProcess"]["latitude"] = Common::convertToMysqlNumericFormat($_POST["paramsProcess"]["latitude"]);
			$_POST["paramsProcess"]["longitude"] = Common::convertToMysqlNumericFormat($_POST["paramsProcess"]["longitude"]);

			ProcessPeer::update($_POST["id"],$_POST["objectiveId"],$_POST["name"],$_POST["description"],$_POST["impact"],$_POST["uniqueGoal"],$_POST["goalExpirationDate"],$_POST["budget"],$_POST["coordinateNeed"],$_POST["frequency"],$_POST["finished"],$_POST["notes"],$_POST["postalCode"],$_POST["uniqueGoalNumeric"],$_POST["goalProgress"],$_POST["paramsProcess"]);
			//caso edicion desde show
			if (isset($_POST['show'])) {
				
				$myRedirectConfig = $mapping->findForwardConfig('success-show');
				$myRedirectPath = $myRedirectConfig->getpath();
				$queryData = '&objectiveId='.$_POST["objectiveId"];
				$myRedirectPath .= $queryData;
				$fc = new ForwardConfig($myRedirectPath, True);
				return $fc;
				
			}
			
      			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo process

			if ( !ProcessPeer::create($_POST["objectiveId"],$_POST["name"],$_POST["description"],$_POST["impact"],$_POST["uniqueGoal"],$_POST["goalExpirationDate"],$_POST["budget"],$_POST["coordinateNeed"],$_POST["frequency"],$_POST["finished"],$_POST["notes"],$_POST["postalCode"],$_POST["uniqueGoalNumeric"],$_POST["goalProgress"],$_POST["paramsProcess"]) ) {
				$process = new Process();
			$process->setid($_POST["id"]);
						$process->setobjectiveId($_POST["objectiveId"]);
			$smarty->assign("objectiveId_valores",$valores);
				$process->setname($_POST["name"]);
				$process->setdescription($_POST["description"]);
				$process->setimpact($_POST["impact"]);
				$process->setuniqueGoal($_POST["uniqueGoal"]);
				try {
					$process->setgoalExpirationDate($_POST["goalExpirationDate"]);
				} catch (PropelException $exp) { } 
				$process->setbudget($_POST["budget"]);
				$process->setcoordinateNeed($_POST["coordinateNeed"]);
				$process->setfrequency($_POST["frequency"]);
				$process->setfinished($_POST["finished"]);
				$process->setnotes($_POST["notes"]);
				$process->setpostalCode($_POST["postalCode"]);
				$process->setuniqueGoalNumeric($_POST["uniqueGoalNumeric"]);
				$process->setgoalProgress($_POST["goalProgress"]);


					foreach ($_POST["paramsProcess"] as $key => $value) {
						$setMethod = "set".$key;
						if ( method_exists($process,$setMethod) ) {          
							if (!empty($value) || $value == "0")
								$process->$setMethod($value);
							else
								$process->$setMethod(null);
						}
					}


				$smarty->assign("process",$process);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				
				//caso administrador
				if (Common::isAdmin()) {
					//obtenemos todos los objetivos posibles
					$valores = ObjectivePeer::getAll();
   
				}
   
				//caso afiliado
				if (Common::isAffiliatedUser()) {
					//obtenemos solo los objetivos relacionados a ese afiliado
					$affiliateId = Common::getAffiliatedId();
					$valores = ObjectivePeer::getAll($affiliateId);
				}
				
				//caso edicion desde show
				if (isset($_GET['show'])) {
					$smarty->assign('show',1);
					//para menu de navegacion
					$smarty->assign('objective',$process->getObjective());
					$smarty->assign('dependency',$process->getObjective()->getAffiliate());
				}	
   
				$smarty->assign("objectiveId_valores",$valores);
				$smarty->assign("message",$_GET["message"]);				
						
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
