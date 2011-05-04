<?php

require_once("BaseAction.php");
require_once("mer/GraphModelPeer.php");
require_once("mer/GraphActorPeer.php");
require_once("mer/GraphCategoryPeer.php");
require_once("mer/JudgementActorPeer.php");

class StrategiesActorDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function StrategiesActorDoEditAction() {
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
		$section = "Strategies";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if ( !empty($_POST["actor"]) && !empty($_POST["category"]) ) {
		                               	
			$actor = ActorPeer::get($_POST["actor"]);
			$actor->setStrategy($_POST["strategy"]);
			$actor->setTactic($_POST["tactic"]);
			$actor->setObservations($_POST["observations"]);
			$actor->save();
		}

		header("Location: Main.php?do=strategiesActor&actor=".$_POST["actor"]."&category=".$_POST["category"]);
		exit;
	}

}
?>
