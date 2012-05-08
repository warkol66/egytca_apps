<?php

require_once("BaseAction.php");
require_once("TableroMeasurePeer.php");
require_once("TableroIndicatorPeer.php");

class TableroMeasuresDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroMeasuresDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un measure existente

			if ( TableroMeasurePeer::update($_POST["id"],$_POST["indicatorId"],$_POST["measureDate"],$_POST["measureNumber"],$_POST["measureExpectedNumber"],$_POST["notes"]) )
      			
      			$indicator = TableroIndicatorPeer::get($_POST["indicatorId"]);
      			$project = $indicator->getTableroProject();
      			
			if (isset($_POST['show'])) {
				
				$myRedirectConfig = $mapping->findForwardConfig('success-show');
				$myRedirectPath = $myRedirectConfig->getpath();
				$queryData = '&projectId='.$project->getId();
				$myRedirectPath .= $queryData;
				$fc = new ForwardConfig($myRedirectPath, True);
				return $fc;
				
			}
      			
      			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo measure

			if ( !TableroMeasurePeer::create($_POST["indicatorId"],$_POST["measureDate"],$_POST["measureNumber"],$_POST["measureExpectedNumber"],$_POST["notes"]) ) {
				$measure = new TableroMeasure();
			$measure->setid($_POST["id"]);
						$measure->setindicatorId($_POST["indicatorId"]);
						$valores = $measures->getCampoForaneo("id","indicator","Indicator");
			$smarty->assign("indicatorId_valores",$valores);
						$measure->setmeasureDate($_POST["measureDate"]);
						$measure->setmeasureNumber($_POST["measureNumber"]);
						$measure->setmeasureExpectedNumber($_POST["measureExpectedNumber"]);
						$measure->setnotes($_POST["notes"]);
							$smarty->assign("measure",$measure);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
