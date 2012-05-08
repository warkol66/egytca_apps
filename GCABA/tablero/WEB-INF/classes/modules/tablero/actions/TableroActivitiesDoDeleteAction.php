<?php

require_once("BaseAction.php");
require_once("TableroActivityPeer.php");

class TableroActivitiesDoDeleteAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroActivitiesDoDeleteAction() {
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

    		$Activity = TableroActivityPeer::get($_POST["id"]);
		$project = $Activity->getProject();
		    		
    		if (Common::isAffiliatedUser() && (!$Activity->isOwner(Common::getAffiliatedId()))) {
			//es usuario afiliado pero no es duenio de la instancia
    			return $mapping->findForwardConfig('failure');	
    		}

		$Activity->delete();
		
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

}
