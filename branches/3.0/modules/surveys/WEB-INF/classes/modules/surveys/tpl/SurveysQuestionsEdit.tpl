|-if $surveyQuestion->getValidationFailures()|@count > 0-|
	<div class="errorMessage">
		<ul>
			|-foreach from=$surveyQuestion->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
		</ul>
	</div>
|-/if-|

<div id="surveyQuestionInfo">
<fieldset title="Formulario de datos de pregunta de encuesta">
<legend>|-if $surveyQuestion->getId() neq ''-|Editar|-else-|Crear|-/if-| Pregunta</legend>
<form name="form_edit_survey_question" id="form_edit_survey_question" action="Main.php" method="post">
	<p>
		<label for="surveyQuestion[question]">Pregunta</label>
		<input type="text" size="65" name="surveyQuestion[question]" value="|-$surveyQuestion->getQuestion()-|" id="surveyQuestion[question]" />
	</p>
	<p>
		<label for="surveyType">Tipo de Pregunta</label>
		<select name="surveyType" >
				<option value="yesno">Si / No</option>
				<option value="multipleAnswers" |-if $surveyQuestion->getId() and $surveyQuestion->acceptsMultipleAnswers()-|selected|-/if-|>Múltiples opciones, respuestas múltiples</option>
				<option value="oneAnswer" |-if $surveyQuestion->getId() and !$surveyQuestion->acceptsMultipleAnswers()-|selected|-/if-|>Múltiples opciones, respuesta única</option>
		</select>
		<a href="#" |-popup sticky='true' fgcolor='#ffffff' bgcolor='#ffffff' closecolor='#cdcdcd' closetext='Cerrar' closetitle='Cerrar' capcolor='#ffffff' bgcolor='#0054A4' snapx='10' snapy='10' width='350' trigger='onMouseOver' caption="Tipos de Preguntas" text="Dependiendo del tipo de pregunta, el usuario puede responder una o varias opciones.<br /> Cambiar el tipo de pregunta eliminará las opciones existentes. <br />El tipo Si/NO es un caso particular de Opciones múltiples con una sola respuesta. Luego puede agregar mas opciones a esta pregunta, el sistema autimáticamente generará las opciones Si y NO"-|><img src="images/clear.png" class="linkImageInfo"></a>
	</p>
	<p>
		|-assign var=survey value=$surveyQuestion->getSurvey()-|
		<input type="hidden" name="surveyQuestion[surveyId]" value="|-if $survey neq ''-||-$survey->getId()-||-else-||-$surveyId-||-/if-|" />
		<input type="hidden" name="do" value="surveysQuestionsDoEdit" />
		<input type="hidden" name="id" value="|-$surveyQuestion->getId()-|" />
		<input type="button" id="editar" value="Aceptar" onClick="javascript:doEditQuestionX(this.form)"/>
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate"><input type="button" id="cerrar" value="Cerrar" /></a>
	</p>
</fieldset>
</form>
</div>

|-if $surveyQuestion->getId() ne ''-|
<div id="surveyQuestionAdder">
<fieldset title="Formulario de opciones de respuesta de encuesta">
<legend>Opciones de respuesta </legend>
	
	<form id="surveyQuestionOptionsAddForm">
			<p>
				<label for="surveyQuestion_question">Respuesta</label>
				<input type="text" size="65" name="surveyAnswerOption[answer]" value="" id="surveyQuestion[answer]" />
			</p>
			<p>
				<input type="hidden" name="surveyAnswerOption[questionId]" value="|-$surveyQuestion->getId()-|" id="surveyAnswerOption">
				<input type="hidden" name="do" value="surveysAnswerOptionsAddX"></input>
			</p>
			<p>
				<input type="button" name="Agregar Respuesta" value="Agregar Respuesta" id="Agregar Respuesta" onClick="javascript:submitAnswerToQuestionX(this.form)"></input> <span id="msgBoxAnswerAdd"></span>
			</p>
	</form>

	<h4>Opciones actuales</h4>
	|-assign var=options value=$surveyQuestion->getSurveyAnswerOptions()-|
	<ul id="surveyQuestionOptionsList">
		|-foreach from=$options item=option name=for_answeroptions-|
		<li id="answerOption|-$option->getId()-|">|-$option->getAnswer()-| 
			<form action="Main.php" method="post">
				<input type="hidden" name="do" value="surveysAnswerOptionsDeleteX" />
				<input type="hidden" name="answerOptionId" value="|-$option->getId()-|"/>
				<input type="button" name="eliminar" value="eliminar" id="eliminar" onClick="javascript:deleteAnswerOptionX(this.form)" class="iconDelete"/>
			</form>
		</li> 
		|-/foreach-|
	</ul>
	</fieldset>
</div>
|-/if-|