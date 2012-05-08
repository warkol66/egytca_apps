<?php

require_once("BaseAction.php");
require_once("TableroActivityPeer.php");
require_once("TableroProjectPeer.php");

class TableroActivitiesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroActivitiesEditAction() {
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

    	if ( !empty($_GET["id"]) ) {
			//voy a editar un Activity

			$Activity = TableroActivityPeer::get($_GET["id"]);
			if (Common::isAffiliatedUser() && (!$Activity->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');		
			}			

			$smarty->assign("Activity",$Activity);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un Activity nuevo
			$Activity = new TableroActivity();
			$smarty->assign("Activity",$Activity);
			$smarty->assign("action","create");
		}

		
		if (Common::isAffiliatedUser()) {
			//solamente traigo los proyectos relacionados a ese usuario afiliado
			$dependencyId = Common::getAffiliatedId();	
			$valores = TableroProjectPeer::getAll($dependencyId);
		}
		if (Common::isAdmin()) {
			$valores = TableroProjectPeer::getAll();
		}
		
		if (isset($_GET['show'])) {
			$smarty->assign('show',1);
			//para menu navegacion
			if (!isset($project)) {
				if (!empty($_GET['id'])) {

					$project = $Activity->getProject();
				}
				if (!empty($_GET['projectId']))
					$project = TableroProjectPeer::get($_GET['projectId']);
			}			
			$smarty->assign('project',$project);
			$smarty->assign('objective',$project->getObjective());
			$smarty->assign('dependency',$project->getObjective()->getAffiliate());
		}

		
		$smarty->assign("projectId_valores",$valores);


		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
