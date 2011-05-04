<?php

class AnalysisGraphShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphShowAction() {
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
    
    global $system;

    if ( !empty($_GET["graph"]) ) {

			$graphModel = GraphModelPeer::get($_GET["graph"]);
			if ( !empty($graphModel) && !empty($_GET["actor"]) ) {
			                                                     	
				$actor = ActorPeer::get($_GET["actor"]);
				
				if (!empty($_GET["category"]))
					$category = CategoryPeer::get($_GET["category"]);

				$graph->labelFont = $system["config"]["mer"]["graphs"]["baloon"]["label"]["font"]["font"];
				$graph->labelFontStyle = $system["config"]["mer"]["graphs"]["baloon"]["label"]["font"]["style"];
				$graph->labelFontSize =  $system["config"]["mer"]["graphs"]["baloon"]["label"]["font"]["size"];

				global $graph_style;
				$graph_style["width"] = $system["config"]["mer"]["graphs"]["size"]["width"];
				$graph_style["height"] = $system["config"]["mer"]["graphs"]["size"]["height"];
				$graph_style["ffamily"] = $system["config"]["mer"]["graphs"]["font"]["ffamily"];

				$graph = $graphModel->getGraph($actor,$category);
				$graph->Stroke();

			}

		}

		return $mapping->findForwardConfig('success');
	}

}
?>
