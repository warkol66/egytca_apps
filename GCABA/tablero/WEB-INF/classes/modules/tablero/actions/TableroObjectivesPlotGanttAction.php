<?php

require_once("BaseAction.php");
require_once("TableroObjectivePeer.php");

class TableroObjectivesPlotGanttAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroObjectivesPlotGanttAction() {
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

		if (isset($_GET['objectiveId'])) {

			$objective = TableroObjectivePeer::get($_GET['objectiveId']);
			$projects = $objective->getTableroProjects();

			//si hay milestones para graficar
			if (!empty($projects)) {

				$graph = new GanttGraph(750,0,"auto");
				$graph->SetBox();
				$graph->SetShadow();

//				$graph->footer->SetFont(FF_VERDANA,FS_BOLD,4);
				$graph->footer->right->Set("(C)");

//				$graph->SetWeekStart(1);
				$graph->scale->UseWeekendBackground();

				$ObjectiveName = $objective->getName();
				if (mb_strlen($ObjectiveName) > 70)
					$ObjectiveName = wordwrap($ObjectiveName, 75, "\n", false);
				$lines = preg_match_all("/\n/",$ObjectiveName,$match);
				$left = $right = $top = $bottom = 10;
				$top = 25 + ($lines * 15);
				$graph->SetMargin($left, $right, $top, $bottom);

				//titulo del grafico
				$graph->title->Set($ObjectiveName);
				$graph->title->SetFont(FF_VERDANA,FS_BOLD);
				$graph->title->SetAlign("center","top");

				$graph->scale->SetDateLocale(Common::getCurrentLocale());
				$graph->scale->day->SetStyle(DAYSTYLE_SHORTDATE4);

				$graph->scale->tableTitle->Set(Common::getTranslation(TableroProjectPeer::ITEM_NAME),'tablero');
				$graph->scale->tableTitle->SetFont(FF_VERDANA,FS_BOLD);
				$graph->scale->SetTableTitleBackground("silver");
				$graph->scale->tableTitle->Show();


				$graph->scale->year->SetFont(FF_VERDANA,FS_NORMAL,8);
				// Nombres cortos de meses
				$graph->scale->month->SetFont(FF_VERDANA,FS_NORMAL,8);
				$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR2);
				$graph->scale->month->SetFontColor("white");
				$graph->scale->month->SetBackgroundColor("orange");

				//mostramos el primer dia de cada semaan
				$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);
				$graph->scale->week->SetFont(FF_VERDANA,FS_NORMAL,6);

				$dateFirst = date('Y-m-d');
				$dateLast =  0;
				//ploteamos las actividades
				for ($i = 0; $i < count($projects) ; $i++) {

					$project = $projects[$i];
					$dateFrom = $project->getDateFormatted();
					$dateTo = $project->getGoalExpirationDateFormatted();
					if($dateFrom > $dateTo)
						$dateTo = $dateFrom;

					$projectName = $project->getName();
					//Para truncar la descripción
					//if (mb_strlen($projectName) > 50)
					//	$projectName = mb_substr($projectName, 0, 50) . "...";

					//Para que ocupe varias lineas
					if (mb_strlen($projectName) > 70)
						$projectName = wordwrap($projectName, 75, "\n", false);

					$progressTag = "";
					if ($project->getGoalProgress() > 0)
						$progressTag = "[" . $project->getGoalProgress() . "%]";

					$activity = new GanttBar($i,$projectName,$dateFrom,$dateTo,$progressTag,.70);
					$activity->title->SetFont(FF_VERDANA,FS_NORMAL,8);

					// Barra de progresso sobre la barra de actividad
					$activity->progress->Set($project->getGoalProgress()/100);
					$activity->progress->SetFillColor('navy');
					$activity->progress->SetPattern(BAND_RDIAG,"white",90);
					$activity->SetPattern(BAND_RDIAG,"yellow",90);
					$activity->SetFillColor("red");

					$activity->SetCSIMTarget("Main.php?do=tableroMilestonesNav&projectId=".$project->getId());
					$activity->SetCSIMAlt(htmlspecialchars($project->getName()));
					$activity->title->SetCSIMTarget("Main.php?do=tableroMilestonesNav&projectId=".$project->getId());
					$activity->title->SetCSIMAlt(htmlspecialchars($project->getName()));
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

			}
			$graph->StrokeCSIM();

		}

		return $mapping->findForwardConfig('success');
	}
}
