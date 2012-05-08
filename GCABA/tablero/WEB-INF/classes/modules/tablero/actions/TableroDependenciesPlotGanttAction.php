<?php

require_once("BaseAction.php");
require_once("TableroDependencyPeer.php");
require_once("TableroProjectPeer.php");

class TableroDependenciesPlotGanttAction extends BaseAction {
					

	// ----- Constructor ---------------------------------------------------- //

	function TableroDependenciesPlotGanttAction() {
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
	
	
		
		if (isset($_GET['dependencyId'])) {

			//optimizacion
			//$criteria = new Criteria();
			//$criteria->add(TableroDependencyPeer::ID, $_GET['dependencyId']);
			//$result = TableroDependencyPeer::doSelectJoinProject($criteria);
			//$dependency = $result[$_GET['dependencyId']];
			
			$dependency = TableroDependencyPeer::get($_GET['dependencyId']);
			
			$objectives = $dependency->getTableroObjectives();
			
			if (!empty($objectives)) {

				$graph = new GanttGraph(750,0,"auto");
				$graph->SetBox();
				$graph->SetShadow();

				$dependencyName = $dependency->getName();
				if (mb_strlen($dependencyName) > 70)
					$dependencyName = wordwrap($dependencyName, 75, "\n", false);
				$lines = preg_match_all("/\n/",$dependencyName,$match);
				$left = $right = $top = $bottom = 10;
				$top = 25 + ($lines * 15);
				$graph->SetMargin($left, $right, $top, $bottom);

				//titulo del grafico
				$graph->title->Set($dependencyName);
				$graph->title->SetFont(FF_VERDANA,FS_BOLD);
				$graph->title->SetAlign("center","top");

				// Show day, week and month scale
				$graph->ShowHeaders(GANTT_HYEAR |  GANTT_HMONTH | GANTT_HDAY );
				$graph->scale->day->SetStyle(DAYSTYLE_SHORTDATE4);

				$graph->scale->SetDateLocale(Common::getCurrentLocale());
				$graph->scale->tableTitle->Set("Objetivos y Proyectos");
				$graph->scale->tableTitle->SetFont(FF_VERDANA,FS_BOLD);
				$graph->scale->SetTableTitleBackground("silver");
				$graph->scale->tableTitle->Show();
				
				// Nombres cortos de meses
				$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2);
				$graph->scale->month->SetFont(FF_VERDANA,FS_NORMAL,8);
				$graph->scale->month->SetFontColor("white");
				$graph->scale->month->SetBackgroundColor("orange");

				//mostramos el primer dia de cada semana
				$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY); 				
				$graph->scale->week->SetFont(FF_VERDANA,FS_NORMAL,6);

				$i = 0;						
				$dateFirst = '2099-01-01';
				$dateLast =  '1900-01-01';

				foreach($objectives as $objective){

					$dateFrom = $objective->getDateFormatted();
					$dateTo = $objective->getExpirationDateFormatted();

					if($dateFrom > $dateTo)	
						$dateTo = $dateFrom;	

					//Busco las fechas límite para manejar las escalas
					if($dateFrom < $dateFirst)	
						$dateFirst = $dateFrom;
					if($dateTo > $dateLast)	
						$dateLast = $dateTo;
					
					$text = substr("Objetivo: " . $objective->getName(),0,50);
					if (strlen($text) == 50)
						$text .= "..."; 
					$activity = new GanttBar($i,$text,$dateFrom,$dateTo);

					$activity->title->SetFont(FF_VERDANA,FS_NORMAL,8);
					
					$activity->SetCSIMTarget("Main.php?do=tableroProjectsNav&objectiveId=".$objective->getId());
					$activity->SetCSIMAlt($objective->getName());
					$activity->title->SetCSIMTarget("Main.php?do=tableroProjectsNav&objectiveId=".$objective->getId());
					$activity->title->SetCSIMAlt($objective->getName());					
					
					$graph->Add($activity);
					
					$i++;
					
					$projects = $objective->getTableroProjects();
					
					foreach($projects as $project) {

						$dateFrom = $project->getDateFormatted();
						$dateTo = $project->getGoalExpirationDateFormatted();
	
						if($dateFrom > $dateTo)	
							$dateTo = $dateFrom;	
												
						$projectName = ' _ ' . $project->getName();
//						if (mb_strlen($projectName) > 50)
//							$projectName = mb_substr($projectName, 0, 50) . "...";

				if (mb_strlen($projectName) > 45)
					$projectName = wordwrap($projectName, 45, "\n", false);
		
						$progressTag = "";
						if ($project->getGoalProgress() > 0)
							$progressTag = "[" . $project->getGoalProgress() . "%]";
						$lines = preg_match_all("/\n/",$projectName,$match);
						$activity = new GanttBar($i,$projectName,$dateFrom,$dateTo,$progressTag,1);
						if ($lines > 0)
							$i = $i + $lines -1;

						$activity->title->SetFont(FF_VERDANA,FS_NORMAL,8);	
						$activity->title->SetAlign("left","top");

						$activity->progress->Set($project->getGoalProgress()/100);
						$activity->progress->SetFillColor('navy');
						$activity->progress->SetPattern(BAND_RDIAG,"white"); 
						$activity->SetPattern(BAND_RDIAG,"yellow");
						$activity->SetFillColor("red");
						
						$activity->SetCSIMTarget("Main.php?do=tableroMilestonesNav&projectId=".$project->getId());
						$activity->SetCSIMAlt(htmlspecialchars($project->getName()));
						$activity->title->SetCSIMTarget("Main.php?do=tableroMilestonesNav&projectId=".$project->getId());
						$activity->title->SetCSIMAlt(htmlspecialchars($project->getName()));							
						
						$graph->Add($activity);
						
						$i++;

						//Busco las fechas límite para manejar las escalas
						if($dateFrom < $dateFirst)	
							$dateFirst = $dateFrom;
						if($dateTo > $dateLast)	
							$dateLast = $dateTo;
					}					
					$i++;
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
