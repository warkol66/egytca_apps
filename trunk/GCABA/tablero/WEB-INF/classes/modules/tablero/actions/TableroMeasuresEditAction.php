<?php

require_once("BaseAction.php");
require_once("TableroMeasurePeer.php");
require_once("TableroIndicatorPeer.php");

class TableroMeasuresEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroMeasuresEditAction() {
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
			//voy a editar un measure
			$measure = TableroMeasurePeer::get($_GET["id"]);
			if (Common::isAffiliatedUser() && (!$measure->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');		
			}			
			$smarty->assign("measure",$measure);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un measure nuevo
			$measure = new TableroMeasure();
			$smarty->assign("measure",$measure);														
			$smarty->assign("action","create");
		}
		
		if (Common::isAffiliatedUser()) {
			//solamente traigo los indicators relacionados a ese usuario afiliado
			$dependencyId = Common::getAffiliatedId();	
			$valores = TableroIndicatorPeer::getAll($dependencyId);
		}
		if (Common::isAdmin()) {
			$valores = TableroIndicatorPeer::getAll();
		}
		
		//caso que venga de show
		if (isset($_GET['show'])) {
			$smarty->assign('show',1);

			//para menu navegacion
			$indicator = $measure->getIndicator();
			$project = $indicator->getProject();
			$smarty->assign('proyect',$project);
			$smarty->assign('indicator',$indicator);
			$smarty->assign('objective',$project->getObjective());
			$smarty->assign('dependency',$project->getObjective()->getAffiliate());

		}

		$smarty->assign("indicatorId_valores",$valores);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
