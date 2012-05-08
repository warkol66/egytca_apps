<?php

require_once("BaseAction.php");

class TableroIndicatorsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroIndicatorsDoEditAction() {
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
			//estoy editando un indicator existente

			TableroIndicatorPeer::update($_POST["id"],$_POST["indicatorData"]);
      			

		}
		else {
		  //estoy creando un nuevo indicator

			switch ($_POST['indicatorType']) {

				case 'normal':

					if ( !TableroIndicatorPeer::create($_POST["indicatorData"]) ) {
						$indicator = new TableroIndicator();
						$indicator->setid($_POST["id"]);
						$indicator->setprojectId($_POST["projectId"]);
						$valores = $indicators->getCampoForaneo("id","project","Project");
						$smarty->assign("projectId_valores",$valores);
						$indicator->setname($_POST["name"]);
						$indicator->setexpirationDate($_POST["expirationDate"]);
						$indicator->setnotes($_POST["notes"]);
						$indicator->setstarted($_POST["started"]);
						$indicator->setstartDate($_POST["startDate"]);
						$indicator->setendDate($_POST["endDate"]);
						$indicator->setactualProgress($_POST["actualProgress"]);
						$smarty->assign("indicator",$indicator);	
						$smarty->assign("action","create");
						$smarty->assign("message","error");
						return $mapping->findForwardConfig('failure');
		      			}
					break;
					
				case 'commune':

					foreach( $_POST['commune'] as $communeId ) {
						$indicatorData = $_POST["indicatorData"];
						$indicatorData["communeId"] = $communeId;
						TableroIndicatorPeer::create($indicatorData);
					}
				
					break;

				case 'region' :
					foreach( $_POST['region'] as $regionId ) {
						$indicatorData = $_POST["indicatorData"];
						$indicatorData["regionId"] = $regionId;						
						TableroIndicatorPeer::create($indicatorData);
					}

					break; 	
				
				
			}
			

		}
		
		if (isset($_POST['show'])) {
				
			$myRedirectConfig = $mapping->findForwardConfig('success-show');
			$myRedirectPath = $myRedirectConfig->getpath();
			$queryData = '&projectId='.$_POST["projectId"];
			$myRedirectPath .= $queryData;
			$fc = new ForwardConfig($myRedirectPath, True);
			return $fc;
			
		}
		
		return $mapping->findForwardConfig('success');


	}

}
