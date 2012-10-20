<?php

require_once("BaseAction.php");

class ProcessesDetailsShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProcessesDetailsShowAction() {
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
		$section = "Processes";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if (empty($_GET['processId'])) {
			return $mapping->findForwardConfig('failure');		
		}

		$dependencyId = $this->getDependencyId();

		$process = ProcessPeer::get($_GET['processId']);
		$indicators = TableroIndicatorPeer::getAllByProcess($_GET['processId'],$dependencyId);
		$milestones = TableroMilestonePeer::getAllByProcess($_GET['processId'],$dependencyId);
		
		$actualRegions = $process->getTableroRegionProcessesJoinTableroRegion();
		$actualCommunes = $process->getTableroCommuneProcessesJoinTableroCommune();
			
		$smarty->assign('process',$process);
		$smarty->assign('objective',$process->getObjective());
		$smarty->assign('dependency',$process->getObjective()->getAffiliate());
		$smarty->assign('indicators',$indicators);
		$smarty->assign('milestones',$milestones);
		$smarty->assign("actualCommunes",$actualCommunes);
		$smarty->assign("actualRegions",$actualRegions);
		$smarty->assign("message",$_GET['message']);
		
		return $mapping->findForwardConfig('success');

	}

}