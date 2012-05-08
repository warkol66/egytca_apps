<?php

require_once("BaseAction.php");
require_once("TableroPositionPeer.php");
require_once("TableroPosition.php");

class TableroPositionsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroPositionsEditAction() {
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

		$module = "TableroPositions";
		$smarty->assign("module",$module);

		$positionPeer = new TableroPositionPeer();
		$positionTypes = $positionPeer->getPositionTypesTranslated();
		$smarty->assign("positionTypes",$positionTypes);

		if ( !empty($_GET["id"]) ) {
			$position = TableroPositionPeer::get($_GET["id"]);
			$smarty->assign("position",$position);
			$smarty->assign("action","edit");
			$type = $position->getType();
			$positions =  TableroPositionPeer::getAllPossibleParentsByType($type);
		}
		else {
			//voy a crear un position nuevo
			$position = new TableroPosition();
			$smarty->assign("position",$position);
			$smarty->assign("action","create");
			$positions =  TableroPositionPeer::getAllPossibleParents();
		}

		$smarty->assign("message",$_GET["message"]);
		$smarty->assign('positions',$positions);

		return $mapping->findForwardConfig('success');
	}

}
