<?php

require_once("BaseAction.php");
require_once("TableroProjectPeer.php");

class TableroProjectsPlotGanttAction extends BaseAction {
					

	// ----- Constructor ---------------------------------------------------- //

	function TableroProjectsPlotGanttAction() {
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
		require_once("jpgraph/jpgraph_gantt.php");
    	
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
		
		if (isset($_GET['projectId'])) {

			$project = TableroProjectPeer::get($_GET['projectId']);
			$milestones = $project->getMilestones();
			
			//si hay milestones para graficar
			if (!empty($milestones)) {
			
				$graph = new GanttGraph(0,0,"auto");
				$graph->SetBox();
				$graph->SetShadow();


				//titulo del grafico
				$graph->title->Set($project->getName());

				// Show day, week and month scale
				$graph->ShowHeaders(GANTT_HYEAR |  GANTT_HMONTH |  GANTT_HDAY |  GANTT_HWEEK);

				$graph->scale->SetDateLocale(Common::getCurrentLocale());
				$graph->scale->tableTitle->Set("Hitos");
				$graph->scale->tableTitle->SetFont(FF_FONT1,FS_BOLD);
				$graph->scale->SetTableTitleBackground("silver");
				$graph->scale->tableTitle->Show();
				

				// Nombres cortos de meses
				$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2);
				$graph->scale->month->SetFont(FF_VERDANA,FS_NORMAL,8);
				$graph->scale->month->SetFontColor("white");
				$graph->scale->month->SetBackgroundColor("orange");

				//mostramos el primer dia de cada semaan
				$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY); 				
				$graph->scale->week->SetFont(FF_VERDANA,FS_NORMAL,6);
				

				//ploteamos las actividades
				for ($i = 0; $i < count($milestones) ; $i++) {
					
					$milestone = $milestones[$i];
					$dateFrom = $milestone->getDateFormatted();
					$dateTo = $milestone->getExpirationDateFormatted();

					$activity = new GanttBar($i,$milestone->getName(),$dateFrom,$dateTo);	
					$graph->Add($activity);
				}
			
				$graph->Stroke();			
			
			}	
		}
		


		return $mapping->findForwardConfig('success');
	}
}
