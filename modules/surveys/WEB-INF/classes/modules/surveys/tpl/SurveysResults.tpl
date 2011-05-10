|-if $ajax eq ''-|
<h2>Encuestas</h2>
<h1>Resultado de Encuestas</h1>
Datos de la encuesta: |-$survey->getName()-| (|-$survey->getStartdate()|date_format-| - |-$survey->getEnddate()|date_format-|)
<br />
Se ha respondido: |-$survey->getTotalAnswers()-| veces.
<br />
Descargar Resultados como csv
<form action="Main.php" method="post">
	<input type="hidden" name="do" value="surveysAnswersExport" />
	<input type="hidden" name="id" value="|-$survey->getid()-|" />
	<input type="submit" name="submit_go_view_survey" value="Exportar Resultados" title="Exportar Resultados" class="iconDownload" />
</form>				
|-/if-|
<div id="surveyResults|-$survey->getId()-|">
	|-foreach from=$survey->getSurveyQuestions() item=surveyQuestion-|
	<p>
		<img src="Main.php?do=surveysDisplay|-$configModule->get('surveys','graphOrientation')-|&amp;id=|-$survey->getId()-|&amp;questionId=|-$surveyQuestion->getId()-|" />
	</p>
	|-/foreach-|
</div>