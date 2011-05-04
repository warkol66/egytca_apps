<?php

require_once("BaseAction.php");
require_once("mer/GraphModelPeer.php");
require_once("mer/GraphModelAxisPeer.php");
require_once("includes/RealBalloonPlot.php");

class AnalysisGraphJudgementShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphJudgementShowAction() {
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

    if ( !empty($_GET["graph"]) ) {

			$graphModel = GraphModelPeer::get($_GET["graph"]);
			if ( !empty($graphModel) && !empty($_GET["quadrant"]) ) {

				switch ($_GET["quadrant"]) {
					case 1: $x = 1;
									$y = 3;
									break;
					case 2: $x = 1;
									$y = -3;
									break;
					case 3: $x = -1;
									$y = -3;
									break;
					case 4: $x = -1;
									$y = 3;
									break;
				}

				$datax = array($x);
				$datay = array($y);
				$dataz = array(1);

				$graph = new Graph(300,200,"auto");
				$graph->SetScale("linlin",-5,5,-2,2);

				$graph->img->SetMargin(20,20,20,20);
				$graph->SetShadow();

				//$graph->title->Set("Real Balloon Plot");
				$graph->title->SetFont(FF_FONT1,FS_BOLD);

				$graph->xaxis->SetTitle($graphModel->getLabelX(),'high');
				$graph->yaxis->SetTitle($graphModel->getLabelY(),'high');

				$sp1 = new RealBalloonPlot($datay,$datax,$dataz);
				$sp1->mark->SetType(MARK_FILLEDCIRCLE);
				$sp1->mark->SetFillColor("red");
				$sp1->mark->SetWidth(8);

				$graph->Add($sp1);
				$graph->Stroke();
			}

		}

		return $mapping->findForwardConfig('success');
	}

}
?>
