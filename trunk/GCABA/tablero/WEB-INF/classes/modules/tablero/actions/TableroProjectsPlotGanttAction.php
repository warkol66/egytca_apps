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
			$milestones = $project->getTableroMilestones();
			
			$dateFirst = date('Y-m-d');
			$dateLast =  0;

			//si hay milestones para graficar
			if (!empty($milestones)) {
			
				$graph = new GanttGraph(750,0,"auto");
				$graph->SetBox();
				$graph->SetShadow();

				//titulo del grafico
				$graph->title->Set($project->getName());
				$graph->title->SetFont(FF_VERDANA,FS_BOLD);

				// Show day, week and month scale
				$graph->ShowHeaders(GANTT_HYEAR |  GANTT_HMONTH |  GANTT_HDAY );
				$graph->scale->day->SetStyle(DAYSTYLE_SHORTDATE4);

				$graph->scale->SetDateLocale(Common::getCurrentLocale());
				$graph->scale->tableTitle->Set(Common::getTranslation(TableroMilestonePeer::ITEM_NAME),'tablero');
				$graph->scale->tableTitle->SetFont(FF_VERDANA,FS_BOLD);
				$graph->scale->SetTableTitleBackground("silver");
				$graph->scale->tableTitle->Show();
				

				// Nombres cortos de meses
				$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2);
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
	
					if($dateFrom > $dateTo)	
						$dateTo = $dateFrom;

					$milestoneName = $milestone->getName();
					if (mb_strlen($milestoneName) > 50)
						$milestoneName = mb_substr($milestoneName, 0, 50) . "...";
					$progressTag = "";
					if ($project->getGoalProgress() > 0)
						$progressTag = "[" . $project->getGoalProgress() . "%]";
				
					$activity = new GanttBar($i,$milestoneName,$dateFrom,$dateTo,$progressTag);	

					$activity->SetPattern(BAND_RDIAG,"yellow");
					$activity->SetFillColor("red");

					$activity->title->SetFont(FF_VERDANA,FS_NORMAL,8);
					$activity->SetCSIMTarget("Main.php?do=tableroMilestonesNav&projectId=".$project->getId());
					$activity->SetCSIMAlt(htmlspecialchars($milestone->getName()));
					$activity->title->SetCSIMTarget("Main.php?do=tableroMilestonesNav&projectId=".$project->getId());
					$activity->title->SetCSIMAlt(htmlspecialchars($milestone->getName()));						
					$graph->Add($activity);
					
					//Busco las fechas límite para manejar las escalas
					if($dateFrom < $dateFirst)
						$dateFirst = $dateFrom;

					if($dateTo > $dateLast)
						$dateLast = $dateTo;

				}

				//Obtengo la cantidad de días entre los rangos de fechas
				$dateTime = new DateTime($dateFirst);
				$dateSpanObj = $dateTime->diff(new DateTime($dateLast));
				$dateSpan = $dateSpanObj->days;

				//Se puede setear el rango de fechas, en lugar de utilizar el auto
				//$graph->scale->SetRange($dateFirst, $dateLast);

				if ($dateSpan < 60)
					$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HDAY);
				else if ($dateSpan < 180)
					$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH | GANTT_HWEEK);
				else if ($dateSpan > 360)
					$graph->ShowHeaders(GANTT_HYEAR | GANTT_HMONTH );
				else
					$graph->ShowHeaders(GANTT_HYEAR );
			
				$graph->StrokeCSIM();			
			
			}	
		}
		return $mapping->findForwardConfig('success');
	}
}
