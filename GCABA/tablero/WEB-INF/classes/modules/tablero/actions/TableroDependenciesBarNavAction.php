<?php

require_once("BaseAction.php");
require_once("TableroDependencyPeer.php");

class TableroDependenciesBarNavAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroDependenciesBarNavAction() {
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

		$module = "Tablero";

		if (!empty($_GET["page"])) {

			$pager = TableroDependencyPeer::getAllPaginated($_GET["page"]);
			$dependencies = $pager->getResult();
		}
		else
			$dependencies = TableroDependencyPeer::getAll();

		$onTime = array();
		$delayed = array();
		$late = array();
		$labels = array();

		foreach ($dependencies as $dependency) {

			array_push($onTime,$dependency->getCountObjectivesOnTime());
			array_push($delayed,$dependency->getCountObjectivesDelayed());
			array_push($late,$dependency->getCountObjectivesLate());

			$dependencyName = $dependency->getName();
				if (mb_strlen($dependencyName) > 50)
					$dependencyName = wordwrap($dependencyName, 50, "\n", false);
				if (mb_strlen($dependencyName) > 150)
					$dependencyName = mb_substr($dependencyName, 0, 150) . "...";

			array_push($labels,$dependencyName);

		}

		global $system;
		$colors = $system["config"]["tablero"]["colors"];

		$totalBars = count($dependencies);
		$graphHeigh = 250 * ( 1 + ($totalBars / 10));

		$graph = new graph(740, $graphHeigh,'auto');

		$graph->title->Set(Common::getTranslation(TableroDependencyPeer::ITEM_NAME,'tablero'));
		$graph->title->SetFont(FF_VERDANA,FS_BOLD,11);
		$graph->subtitle->Set(Common::getTranslation(TableroObjectivePeer::ITEM_NAME,'tablero'));
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
