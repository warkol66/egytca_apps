<?php

require_once("BaseAction.php");
require_once("TableroProjectPeer.php");

class TableroProjectsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroProjectsDoEditAction() {
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

		$module = "Tablero";
		$section = "Project";

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un project existente

			$_POST["paramsProject"]["latitude"] = Common::convertToMysqlNumericFormat($_POST["paramsProject"]["latitude"]);
			$_POST["paramsProject"]["longitude"] = Common::convertToMysqlNumericFormat($_POST["paramsProject"]["longitude"]);

			TableroProjectPeer::update($_POST["id"],$_POST["objectiveId"],$_POST["name"],$_POST["description"],$_POST["impact"],$_POST["uniqueGoal"],$_POST["goalExpirationDate"],$_POST["budget"],$_POST["coordinateNeed"],$_POST["frequency"],$_POST["finished"],$_POST["notes"],$_POST["postalCode"],$_POST["uniqueGoalNumeric"],$_POST["goalProgress"],$_POST["paramsProject"]);
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
		  //estoy creando un nuevo project

			if ( !TableroProjectPeer::create($_POST["objectiveId"],$_POST["name"],$_POST["description"],$_POST["impact"],$_POST["uniqueGoal"],$_POST["goalExpirationDate"],$_POST["budget"],$_POST["coordinateNeed"],$_POST["frequency"],$_POST["finished"],$_POST["notes"],$_POST["postalCode"],$_POST["uniqueGoalNumeric"],$_POST["goalProgress"],$_POST["paramsProject"]) ) {
				$project = new TableroProject();
			$project->setid($_POST["id"]);
						$project->setobjectiveId($_POST["objectiveId"]);
			$smarty->assign("objectiveId_valores",$valores);
				$project->setname($_POST["name"]);
				$project->setdescription($_POST["description"]);
				$project->setimpact($_POST["impact"]);
				$project->setuniqueGoal($_POST["uniqueGoal"]);
				try {
					$project->setgoalExpirationDate($_POST["goalExpirationDate"]);
				} catch (PropelException $exp) { } 
				$project->setbudget($_POST["budget"]);
				$project->setcoordinateNeed($_POST["coordinateNeed"]);
				$project->setfrequency($_POST["frequency"]);
				$project->setfinished($_POST["finished"]);
				$project->setnotes($_POST["notes"]);
				$project->setpostalCode($_POST["postalCode"]);
				$project->setuniqueGoalNumeric($_POST["uniqueGoalNumeric"]);
				$project->setgoalProgress($_POST["goalProgress"]);


					foreach ($_POST["paramsProject"] as $key => $value) {
						$setMethod = "set".$key;
						if ( method_exists($project,$setMethod) ) {          
							if (!empty($value) || $value == "0")
								$project->$setMethod($value);
							else
								$project->$setMethod(null);
						}
					}


				$smarty->assign("project",$project);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				
				//caso administrador
				if (Common::isAdmin()) {
					//obtenemos todos los objetivos posibles
					$valores = TableroObjectivePeer::getAll();
   
				}
   
				//caso afiliado
				if (Common::isAffiliatedUser()) {
					//obtenemos solo los objetivos relacionados a ese afiliado
					$affiliateId = Common::getAffiliatedId();
					$valores = TableroObjectivePeer::getAll($affiliateId);
				}
				
				//caso edicion desde show
				if (isset($_GET['show'])) {
					$smarty->assign('show',1);
					//para menu de navegacion
					$smarty->assign('objective',$project->getObjective());
					$smarty->assign('dependency',$project->getObjective()->getAffiliate());
				}	
   
				$smarty->assign("objectiveId_valores",$valores);
				$smarty->assign("message",$_GET["message"]);				
						
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
