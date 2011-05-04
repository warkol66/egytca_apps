<?php

require_once("BaseAction.php");
require_once("mer/Actor.php");
require_once("mer/Question.php");
require_once("mer/FormPeer.php");

class DoProfilesFormFillAction extends BaseAction {



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
		
		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);			

		$actor = actorPeer::retrieveByPK($request->getParameter("actor"));
		if (!$actor){
			print "Cannot find actor '".$request->getParameter("actor")."'";
		}		
		$actor->replaceAnswers($request->getParameterValues("answer"));	
		$form = FormPeer::get($request->getParameter("form"));
		if (!empty($_POST["showAll"]))
			$actor->replaceActive($request->getParameterValues("applyableQuestions"),$form);
		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$myRedirectPath = $myRedirectPath."&actor=".$actor->getId()."&form=".$request->getParameter("form");
		$fc = new ForwardConfig($myRedirectPath, True);		
		return $fc;
	}
}
?>
