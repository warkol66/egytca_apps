<div id='surveyShowHolder|-$survey->getId()-|'>
|-if (!$alreadyAnswered && !$surveyExpired) || $forcedForm-|
	<form action="Main.php" method="post" id="surveySubmitForm">
		|-foreach from=$survey->getSurveyQuestions() key=key item=surveyQuestion-|
		<fieldset id="question_|-$key-|">
			<legend>|-$surveyQuestion->getQuestion()-|</legend>
			<p>
			|-assign var=options value=$surveyQuestion->getSurveyAnswerOptions()-|
			<ul>
			|-if $surveyQuestion->acceptsMultipleAnswers() eq true-|
			|-foreach from=$options item=option name=for_option-|
				<li>
					<input type="checkbox" name="answers[|-$key-|][answers][]" value="|-$option->getId()-|" /> |-$option->getAnswer()-|
				</li>
			|-/foreach-|
			|-else-|
			|-foreach from=$options item=option name=for_option-|
				<li>
					<input type="radio" name="answers[|-$key-|][answers][]" value="|-$option->getId()-|" /> |-$option->getAnswer()-|
				</li>
			|-/foreach-|
			|-/if-|
			</ul>
			</p>
				|-if $surveyQuestion->acceptsMultipleAnswers() eq true-|
					<p>Puede seleccionar más de una opción</p>
				|-/if-|
			<p>
				<input type="hidden" name="answers[|-$key-|][questionId]" value="|-$surveyQuestion->getId()-|" />
				<span class="msgBoxSurveyValidationMsg"></span>
			</p>
		</fieldset>
		|-/foreach-|
			|-if isset($useCaptcha) and $useCaptcha-|
			<p>
				Código de Seguridad: <img src="Main.php?do=commonCaptchaGeneration&width=120&height=45&characters=5" />
			</p>
			<p>
					Ingrese el código de seguridad de la imagen <br />
					<input id="security_code" name="securityCode" type="text" size="10" />
			</p>
			|-/if-|

			<p>
				<input type="hidden" name="surveyId" value="|-$survey->getId()-|" />
				<input type="hidden" name="objectType" value="|-$objectType-|" />
				<input type="hidden" name="objectId" value="|-$objectId-|" />
				<input type="hidden" name="do" value="surveysRespondX"/>
				<input type="button" value="Votar" onClick="javascript:submitAllAnswersSurveyX(this.form)"/> 
				<input type="button" value="Ver resultados" onClick="javascript:submitSurveyWithoutAnswerX(this.form)"/>
				<span id="msgBoxSurveyForm"></span>
			</p>
	</form>
|-elseif $surveyExpired or $alreadyAnswered-|
	<p><span class="inProgress">Cargando resultados de la encuesta...</span>

	<script type="text/javascript">

		loadSurveyResultsX(|-$survey->getId()-|,'surveyShowHolder|-$survey->getId()-|');

	</script>
	</p>

|-/if-|
</div>