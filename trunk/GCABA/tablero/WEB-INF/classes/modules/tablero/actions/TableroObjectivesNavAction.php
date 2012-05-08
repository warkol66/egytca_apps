<?php

require_once("BaseAction.php");
require_once("AffiliateInfoPeer.php");
require_once("TableroDependencyPeer.php");
require_once("TableroObjectivePeer.php");
require_once("TableroStrategicObjectivePeer.php");

class TableroObjectivesNavAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroObjectivesNavAction() {
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
		$section = "Nav";

  	$smarty->assign("module",$module);
	 	$smarty->assign("section",$section);
		
		$dependencyId = $this->getDependencyId();
		$dependency = TableroDependencyPeer::get($dependencyId);

		$tableroObjectivePeer = new TableroObjectivePeer();
		$tableroObjectivePeer->setStrategicObjectiveId($_GET["strategicObjectiveId"]);
		$strategicObjective = TableroStrategicObjectivePeer::get($_GET["strategicObjectiveId"]);

		if (!empty($_GET["status"])) {
			$method = "getObjectives".$_GET["status"];
			$objectives = $dependency->$method();
		}
		else {
			if (!empty($_GET["strategicObjectiveId"])){
				$pager = $tableroObjectivePeer->getAllPaginatedFiltered($_GET["page"]);
				$objectives = $pager->getResult();
				$dependency = TableroDependencyPeer::get($strategicObjective->getAffiliateId());
				$smarty->assign("navStrategicObjectives",1);
			}
			else {
				$pager = TableroObjectivePeer::getAllPaginated($_GET["page"],-1,$dependencyId);
				$objectives = $pager->getResult();
			}
		}			

		$smarty->assign("dependency",$dependency);
		$smarty->assign("objectives",$objectives);
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=tableroObjectivesNav";
		if (!Common::isAffiliatedUser())
			$url .= "&dependencyId=".$dependencyId;
		$smarty->assign("url",$url);			
		$smarty->assign("affiliateInfoPeer",new AffiliateInfoPeer());
		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("status",$_GET["status"]);	
		
		global $system;	
		$smarty->assign('colors',$system["config"]["tablero"]["colors"]);		
		
		return $mapping->findForwardConfig('success');
	}

}
