<?php

require_once("BaseAction.php");
require_once("mer/GraphModelPeer.php");
require_once("mer/GraphActorPeer.php");
require_once("mer/GraphCategoryPeer.php");
require_once("mer/JudgementActorPeer.php");

class AnalysisActorJudgementDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisActorJudgementDoEditAction() {
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

		if ( !empty($_POST["graph"]) && !empty($_POST["actor"]) && !empty($_POST["category"]) ) {
		                               	
			$graph = GraphModelPeer::get($_POST["graph"]);
			if ($graph->getActors() == 0) {
				//es un grafico por categoria
        GraphCategoryPeer::setJudgement($_POST["graph"],$_POST["category"],$_POST["judgement"]);
			} else {
				//es un grafico por actor
				GraphActorPeer::setJudgement($_POST["graph"],$_POST["actor"],$_POST["category"],$_POST["judgement"]);
			}
			
			header("Location: Main.php?do=analysisActor&actor=".$_POST["actor"]);
			exit;
		}
		
		// Si me pasan una pregunta es el juicio de la pregunta
		if ( !empty($_POST["question"]) && !empty($_POST["actor"]) && !empty($_POST["category"]) ) {
		                               	
			QuestionPeer::setJudgement($_POST["question"],$_POST["actor"],$_POST["judgement"]);

			header("Location: Main.php?do=analysisActor&actor=".$_POST["actor"]);
			exit;
		}

		// Si no tengo el grafico es el juicio general del actor
		if ( !empty($_POST["actor"]) ) {

      JudgementActorPeer::setJudgement($_POST["actor"],$_POST["mark"],$_POST["judgement"]);

			header("Location: Main.php?do=analysisActor&actor=".$_POST["actor"]);
			exit;
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
