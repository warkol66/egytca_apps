<?php

require_once("BaseAction.php");
require_once("mer/FormPeer.php");
require_once("mer/QuestionPeer.php");

class AnalysisQuestionListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisQuestionListAction() {
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

		$module = "Analysis";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if (!empty($_GET["relation"]))
			$relacion = true;
		else
			$relation = false;
		$relForms = new Criteria();
		$relForms->add(FormPeer::RELATIONSHIP,$relation);
    $forms = FormPeer::doSelect($relForms);

		$sections = FormPeer::getSectionsTree();
    
    $analysisQuestions = QuestionPeer::getAllAnalysis();


		$smarty->assign("sections",$sections);
		$smarty->assign("forms",$forms);
    $smarty->assign("analysisQuestions",$analysisQuestions);

    $smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
?>
