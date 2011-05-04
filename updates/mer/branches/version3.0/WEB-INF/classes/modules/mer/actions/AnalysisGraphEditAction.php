<?php

class AnalysisGraphEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphEditAction() {
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
		
		$smarty->assign("sections",$sections);
		$smarty->assign("forms",$forms);

    if ( !empty($_GET["id"]) ) {
			//voy a editar un grafico

			$graph = GraphModelPeer::get($_GET["id"]);
			$smarty->assign("graph",$graph);

			$questionsX0 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"x",0);
			$questionsY0 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"y",0);
			$questionsZ0 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"z",0);

			$questionsX2 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"x",2);
			$questionsY2 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"y",2);
			$questionsZ2 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"z",2);

			$questionsX3 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"x",3);
			$questionsY3 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"y",3);
			$questionsZ3 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"z",3);

			$questionsX4 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"x",4);
			$questionsY4 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"y",4);
			$questionsZ4 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"z",4);
			
			$questionsX10 = GraphModelAxisPeer::getQuestionIdsByGraphIdAndAxisAndType($_GET["id"],"x",10);

			$smarty->assign("questionsX0",$questionsX0);
			$smarty->assign("questionsY0",$questionsY0);
			$smarty->assign("questionsZ0",$questionsZ0);

			$smarty->assign("questionsX2",$questionsX2);
			$smarty->assign("questionsY2",$questionsY2);
			$smarty->assign("questionsZ2",$questionsZ2);

			$smarty->assign("questionsX3",$questionsX3);
			$smarty->assign("questionsY3",$questionsY3);
			$smarty->assign("questionsZ3",$questionsZ3);

			$smarty->assign("questionsX4",$questionsX4);
			$smarty->assign("questionsY4",$questionsY4);
			$smarty->assign("questionsZ4",$questionsZ4);
			
			$smarty->assign("questionsX10",$questionsX10);

	    $smarty->assign("action","edit");
		}
		else {
			//voy a crear un grafico nuevo

			$smarty->assign("action","new");
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
