<?php

require_once("BaseAction.php");
require_once("TableroActivityPeer.php");

class TableroActivitiesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroilestonesDoEditAction() {
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
			//estoy editando un Activity existente

			if ( TableroActivityPeer::update($_POST["id"],$_POST["projectId"],$_POST["name"],$_POST["expirationDate"],$_POST["completed"],$_POST["notes"]) )
      			
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
		else {
		  //estoy creando un nuevo Activity

			if ( !TableroActivityPeer::create($_POST["projectId"],$_POST["name"],$_POST["expirationDate"],$_POST["completed"],$_POST["notes"]) ) {
				$Activity = new TableroActivity();
				$Activity->setid($_POST["id"]);
				$Activity->setprojectId($_POST["projectId"]);
				$Activity->setname($_POST["name"]);
				$Activity->setexpirationDate($_POST["expirationDate"]);
				$Activity->setcompleted($_POST["completed"]);
				$Activity->setnotes($_POST["notes"]);
				$smarty->assign("Activity",$Activity);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
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

}
