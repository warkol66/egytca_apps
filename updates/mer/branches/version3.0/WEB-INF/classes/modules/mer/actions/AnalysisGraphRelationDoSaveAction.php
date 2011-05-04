<?php

require_once("BaseAction.php");
require_once("mer/ActorPeer.php");
require_once("mer/RelationshipPeer.php");
require_once("mer/GraphRelationPeer.php");

class AnalysisGraphRelationDoSaveAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphRelationDoSaveAction() {
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

		$module = "Categories";
		$section = "Analysis";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$actor1 = ActorPeer::get($request->getParameter("actor"));
    $actor2 = ActorPeer::get($request->getParameter("actor2"));

    $questionsId = $_POST["questions"];
    $judgement = $request->getParameter("judgement");
    $name = $request->getParameter("name");

		GraphRelationPeer::create($name,$actor1,$actor2,$judgement,$questionsId);

    header("Location: Main.php?do=analysisCompareRel&message=saved&actor=".$actor1->getId()."&actor2=".$actor2->getId());
    exit;
		return $mapping->findForwardConfig('success');
	}

}
?>
