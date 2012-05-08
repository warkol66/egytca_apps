<?php

require_once("BaseAction.php");
require_once("ObjectivePeer.php");
require_once("TableroDependencyPeer.php");

class ObjectivesBarNavAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesBarNavAction() {
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

		require_once("jpgraph/jpgraph.php");
		require_once("jpgraph/jpgraph_bar.php");

 		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Objectives";

		if (empty($_GET["dependencyId"]))
				return $mapping->findForwardConfig('failure');

		$dependencyId = $_GET["dependencyId"];
		
		$dependency = TableroDependencyPeer::get($dependencyId);

		if (!empty($_GET["page"])) {
			$pager = ObjectivePeer::getAllPaginated($_GET["page"],-1,$dependencyId);
			$objectives = $pager->getResult();
		}
		else
			$objectives = ObjectivePeer::getAll($dependencyId);

		$onTime = array();
		$delayed = array();
		$late = array();
		$labels = array();

		foreach ($objectives as $objective) {

			array_push($onTime,$objective->getCountProjectsOnTime());
			array_push($delayed,$objective->getCountProjectsDelayed());
			array_push($late,$objective->getCountProjectsLate());

			$objectiveName = $objective->getName();
				if (mb_strlen($objectiveName) > 50)
					$objectiveName = wordwrap($objectiveName, 50, "\n", false);
				if (mb_strlen($objectiveName) > 150)
					$objectiveName = mb_substr($objectiveName, 0, 150) . "...";

			array_push($labels,$objectiveName);

		}

		global $system;
		$colors = $system["config"]["tablero"]["colors"];

		$totalBars = count($objectives);
		$graphHeigh = 250 * ( 1 + ($totalBars / 10));

		$graph = new graph(740, $graphHeigh,'auto');

		$graph->title->Set($dependency->getName());
		$graph->title->SetFont(FF_VERDANA,FS_BOLD,11);
		$graph->subtitle->Set(Common::getTranslation(ObjectivePeer::ITEM_NAME,$module));
		$graph->subtitle->SetFont(FF_VERDANA,FS_NORMAL,10);

		$graph->SetScale('textlin');
		$top = 70;
		$bottom = 25;
		$left = 280;
		$right = 25;
		$graph->Set90AndMargin($left,$right,$top,$bottom);

		$bar1 = new BarPlot($onTime);
		$bar1->setFillColor($colors['onTime']);
		$bar1->SetFillgradient($colors['onTime'],'white',GRAD_MIDVER);
		$bar1->SetShadow('silver','2','2','true');

		$bar2 = new BarPlot($delayed);
		$bar2->setFillColor($colors['delayed']);
		$bar2->SetFillgradient($colors['delayed'],'white',GRAD_MIDVER);
		$bar2->SetShadow('silver','2','2','true');

		$bar3 =	new BarPlot($late);
		$bar3->setFillColor($colors['late']);
		$bar3->SetFillgradient($colors['late'],'white',GRAD_MIDVER);
		$bar3->SetShadow('silver','2','2','true');

		$group = new GroupBarPlot(array($bar1,$bar2,$bar3));

		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->SetLabelAlign('right','center','right');
		$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->xaxis->SetTickSide(SIDE_TOP);
		$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->yaxis->SetTickSide(SIDE_LEFT);
		$graph->SetMarginColor('#f4f6f3');
		$graph->SetShadow();

		$graph->Add($group);

		$graph->Stroke();

		return $mapping->findForwardConfig('success');
	}
}
