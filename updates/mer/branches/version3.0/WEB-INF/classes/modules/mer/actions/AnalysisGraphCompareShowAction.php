<?php

require_once("BaseAction.php");
require_once("mer/ActorPeer.php");
require_once("mer/RelationshipPeer.php");
require_once("mer/GraphModelPeer.php");
require_once("mer/GraphModelAxisPeer.php");
require_once("includes/jpgraph/src/jpgraph.php");
require_once("includes/jpgraph/src/jpgraph_bar.php");

class AnalysisGraphCompareShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphCompareShowAction() {
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
    
		$categoryId = $request->getParameter("categoryId");
		if (!empty($categoryId))
			$actors = ActorPeer::getByCategory($categoryId);
		else {
			$actorsIds = $_GET["actors"];
			$actors = array();
			foreach ($actorsIds as $actor)
				$actors[] = ActorPeer::get($actor);
		}
		
		$actor1 = ActorPeer::get($_GET["actor1"]);
    $actor2 = ActorPeer::get($_GET["actor2"]);
    
    $questions = $_GET["questions"];

		$relationships = RelationshipPeer::getAllByActors($actor1,$actor2);  //print_r($relationships);die;

		$data1y=array();
		$data2y=array();
		$datax=array();

		foreach ($questions as $quest) {
      $found = false;
      $i = 0;
      $question = QuestionPeer::get($quest);
			while (!$found && $i < count($relationships)) {
				$question2 = $relationships[$i]->getQuestion();
				if ($question2->getId() == $question->getId())
					$found = true;
				else
					$i++;
			}
			if ($found) {
			  $data1y[] = $relationships[$i]->getCurrent();
        $data2y[] = $relationships[$i]->getPotential();
   		}
			else {
			  $data1y[] = 0;
        $data2y[] = 0;
			}
    	$datax[] = ereg_replace(" ","\n",$question->getQuestion());
		}

		if (!empty($data1y) && !empty($data2y) ) {

			// Create the graph. These two calls are always required
			$graph = new Graph(630,400,"auto");
			$graph->SetScale("textlin");
			
			$graph->SetShadow();
			$graph->img->SetMargin(60,30,40,80);
			
			global $protectedWords;

			// Create the bar plots
			$b1plot = new BarPlot($data1y);
			$b1plot->SetFillColor("orange");
			$b1plot->value->Show();
			$b1plot->value->SetFormat('%.0f');
			$b1plot->value->SetFont(FF_VERDANA,FS_NORMAL,8);
			$b1plot->value->SetColor('maroon');
			$b1plot->SetLegend($protectedWords["relationReal"]);

			$b2plot = new BarPlot($data2y);
			$b2plot->SetFillColor("blue");
			$b2plot->value->Show();
			$b2plot->value->SetFormat('%.0f');
			$b2plot->value->SetFont(FF_VERDANA,FS_NORMAL,8);
			$b2plot->value->SetColor('navy');
			$b2plot->SetLegend($protectedWords["relationPotential"]);
			
			// Create the grouped bar plot
			$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
			
			// ...and add it to the graPH
			$graph->Add($gbplot);
			
			$graph->title->Set($actor1->getName()." -> ".$actor2->getName());
			$graph->title->SetMargin(15,5,5,5);
			
			$graph->title->SetFont(FF_VERDANA,FS_BOLD);
			
			$graph->xaxis->SetTickLabels($datax);
			$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
			$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
			
			// Display the graph
			$graph->Stroke();
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
