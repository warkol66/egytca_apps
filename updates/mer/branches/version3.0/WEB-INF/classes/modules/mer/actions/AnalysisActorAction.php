<?php

class AnalysisActorAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisActorAction() {
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

		$module = "Mer";
		$section = "Analysis";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

    if ( !empty($_GET["actor"]) ) {

			$actor = ActorPeer::get($_GET["actor"]);
			$smarty->assign("actor",$actor);
			
			$category = CategoryPeer::get($actor->getCategoryId());
			$smarty->assign("category",$category);

			$graphs = GraphModelPeer::getAllByActor($_GET["actor"]);
    	$smarty->assign("graphs",$graphs);
    	
    	$judgement = JudgementActorPeer::get($_GET["actor"]);
    	$smarty->assign("judgement",$judgement);

    	$analysisQuestions = QuestionPeer::getAllAnalysis();
	    $smarty->assign("analysisQuestions",$analysisQuestions);
		}

			$report = $request->getParameter("report");

			if (!empty($report)) {
				$this->template->template = "template_report.tpl";
        return $mapping->findForwardConfig('report');
			}
			else
				return $mapping->findForwardConfig('success');
	}

}
?>
