<?php

//especifico jpgraph
require_once("jpgraph/jpgraph.php");
require_once("jpgraph/jpgraph_bar.php");

define('LABEL_LENGTH',28);

class SurveysDisplayBarAction extends BaseAction {

	function SurveysDisplayBarAction() {
		;
	}

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



		$module = "Surveys";
		$smarty->assign("module",$module);
		$section = "Surveys";
		$smarty->assign("section",$section);

		$survey = SurveyPeer::get($_GET["id"]);

		if (!$survey)
			return $mapping->findForwardConfig('failure');

		//verificacion si solo debe ser visible para un usuario registrado
		//no es publica y no quiere acceder un usuario afiliado.
		if ((!$survey->isPublic()) && (!Common::isRegistrationUser()) && (!Common::isAdmin()))
			return $mapping->findForwardConfig('failure-visibility');

		$surveyQuestion = SurveyQuestionPeer::get($_GET['questionId']);

		$totalAnswers = $surveyQuestion->getTotalAnswerCount();
		$answerOptions = $surveyQuestion->getSurveyAnswerOptions();
		$totalOptions = count($answerOptions);

		global $system;


		$showTotals = $system['config']['surveys']['graphics']['showTotals']['value'];
		//setup de variables de color
		$legend = $system['config']['surveys']['graphics']['colors']['legend'];
		$labels = $system['config']['surveys']['graphics']['colors']['labels'];
		$totals = $system['config']['surveys']['graphics']['colors']['totals'];
		$barColor = $system['config']['surveys']['graphics']['colors']['barColor'];
		$background = $system['config']['surveys']['graphics']['colors']['background'];


		$datay = array();
		$datax = array();
		$maxAnswerLen = 0;
		foreach ($answerOptions as $answerOption) {

			if ($showTotals == 'YES')
				array_push($datay,$answerOption->getAnswerCount());
			else {
				array_push($datay,($answerOption->getAnswerCount() * 100) / $totalAnswers);
			}

			$finalAnswer = wordwrap($answerOption->getAnswer(),LABEL_LENGTH);
			if (strlen($finalAnswer) > $maxAnswerLen)
				$maxAnswerLen = strlen($finalAnswer);
			array_push($datax,$finalAnswer);
		}

		switch  ($maxAnswerLen) {
			case ($maxAnswerLen < 7):
				$leftMargin = 80;
				$xSetLabelMargin = 40;
				break;
			case ($maxAnswerLen < 12):
				$leftMargin = 130;
				$xSetLabelMargin = 120;
				break;
			default:
				$leftMargin = 180;
				$xSetLabelMargin = 170;
		}

		// Size of graph
		$width= 500;
		$height= 45 * $totalOptions + 80;

		// Set the basic parameters of the graph
		$graph = new Graph($width,$height,'auto');
		$graph->SetScale("textlin");

		// Sets a frame (rectangle) of the chosen color around the edges of the image.
		$graph->SetFrame(true,'#ff9900',1);

		$top = 40;

		$graphTitle = $surveyQuestion->getQuestion();
		if (strlen($graphTitle) > 60) {
			$graphTitle = wordwrap($graphTitle,((strlen($graphTitle)+10)/2));
		$top = 60;
		}
		$bottom = 30;
		$left = $leftMargin;
		$right = 15;
		$graph->Set90AndMargin($left,$right,$top,$bottom);

		// Setup title
		$graph->title->Set($graphTitle);

		$graph->title->SetColor($legend);
		$graph->title->SetFont(FF_VERDANA,FS_BOLD,10);
		$graph->title->SetMargin(10,10,10,10);
//		$graph->subtitle->Set($survey->getName());
		$graph->subtitle->SetColor($legend);
		$graph->subtitle->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->SetTickDensity(TICKD_VERYSPARSE);

		// Setup X-axis
		$graph->xaxis->SetColor($background,$labels);
		$graph->xaxis->SetTickLabels($datax);
		$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->xaxis->HideTicks(true,true);

		// Some extra margin looks nicer
		$graph->xaxis->SetLabelMargin($xSetLabelMargin);

		// Label align for X-axis
		$graph->xaxis->SetLabelAlign('left','center');
//		$graph->xaxis->SetColor($labels);

		// Add some grace to y-axis so the bars doesn't go
		// all the way to the end of the plot area
		$graph->yaxis->scale->SetGrace(20);

		// Setup the Y-axis to be displayed in the bottom of the
		// graph. We also finetune the exact layout of the title,
		// ticks and labels to make them look nice.
		$graph->yaxis->SetPos('max');

		// First make the labels look right
//		$graph->yaxis->SetLabelAlign('center','top');
		$graph->yaxis->SetLabelFormat('%d');
		$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->yaxis->SetLabelSide(SIDE_RIGHT);
//		$graph->yaxis->SetColor($labels);

		// The fix the tick marks
		$graph->yaxis->SetTickSide(SIDE_LEFT);
		$graph->yaxis->HideTicks(true,true);
		$graph->yaxis->SetColor($background,$labels);

		// Finally setup the title
		$graph->yaxis->SetTitleSide(SIDE_RIGHT);
		$graph->yaxis->SetTitleMargin(35);


		$graph->yaxis->title->SetFont(FF_VERDANA,FS_NORMAL,8);
		$graph->yaxis->title->SetAngle(0);

		// To align the title to the right use :

		if ($showTotals == 'YES') {

			$graph->yaxis->SetTitle('Cantidad total de respuestas: ' . $totalAnswers,'high');
			$graph->yaxis->title->Align('right');
			$graph->yaxis->title->SetColor($legend);
		}

		$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL);

		// If you want the labels at an angle other than 0 or 90
		// you need to use TTF fonts
		//$graph->yaxis->SetLabelAngle(0);

		// Now create a bar pot
		$bplot = new BarPlot($datay);
		$bplot->SetFillColor($barColor);
		$bplot->SetShadow("gainsboro",5,4,true);

		//You can change the width of the bars if you like
		$barWidth = ($totalOptions * .12);
		if ($barWidth > .85)
			$barWidth = .85;
		$bplot->SetWidth($barWidth);
		$bplot->SetFillGradient($barColor,"white",GRAD_MIDVER);


		// We want to display the value of each bar at the top
		// Control si no se ha respondido aun para evitar error de jpgraph
		if ($totalAnswers != 0) {
			$bplot->value->Show();
		}
		$bplot->value->SetFont(FF_VERDANA,FS_BOLD,8);
		$bplot->value->SetAlign('left','center');
		$bplot->value->SetColor($totals,"darkred");
		//caso de porcentaje
		if ($showTotals == 'NO')
			$bplot->value->SetFormat('%.1f %%');
		else
			$bplot->value->SetFormat('%.0f');

		// Add the bar to the graph
		$graph->Add($bplot);

		$graph->SetMarginColor($background);

		$graph->Stroke();

	}

}