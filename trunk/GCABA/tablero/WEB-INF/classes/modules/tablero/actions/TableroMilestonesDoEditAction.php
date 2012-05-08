<?php

require_once("BaseAction.php");
require_once("TableroMilestonePeer.php");

class TableroMilestonesDoEditAction extends BaseAction {


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
			//estoy editando un milestone existente

			if ( TableroMilestonePeer::update($_POST["id"],$_POST["projectId"],$_POST["name"],$_POST["expirationDate"],$_POST["completed"],$_POST["notes"]) )
      			
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
		  //estoy creando un nuevo milestone

			if ( !TableroMilestonePeer::create($_POST["projectId"],$_POST["name"],$_POST["expirationDate"],$_POST["completed"],$_POST["notes"]) ) {
				$milestone = new TableroMilestone();
				$milestone->setid($_POST["id"]);
				$milestone->setprojectId($_POST["projectId"]);
				$milestone->setname($_POST["name"]);
				$milestone->setexpirationDate($_POST["expirationDate"]);
				$milestone->setcompleted($_POST["completed"]);
				$milestone->setnotes($_POST["notes"]);
				$smarty->assign("milestone",$milestone);	
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
