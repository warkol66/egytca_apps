|-popup_init src="scripts/overlib.js"-|
<h2>Módulo de Encuetas</h2>
<h1>|-if $survey->getId() neq ''-|Editar|-else-|Crear|-/if-| Encuesta</h1>
<div id="div_survey">
|-if $survey->getId() neq ''-|
<p>A continuación puede modificar la encuesta seleccionada. Para guardar los cambios haga click en "Aceptar". 
Puede también agregar o eliminar opciones de pregunta. No se puede modificar el tipo de pregunta;
Si quere cambiar el tipo de pregunta, debe eliminar esta encuesta y crear una nueva.</p>
|-else-|
<p>A continuación puede crear una nueva encuesta. Seleccione el tipo de pregunta, una vez guardado el tipo de pregunta, no lo puede modificar.
Para guardar los cambios haga click en "Aceptar". Luego de guardar la encuesta se le presentará un formulario para ingresar las opciones de respuesta.</p>
|-/if-|

|-if $survey->getValidationFailures()|@count > 0-|
	<div class="errorMessage">
		<ul>
			|-foreach from=$survey->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
		</ul>
	</div>
|-/if-|

<form name="form_edit_survey" id="form_edit_survey" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="resultFailure">Ha ocurrido un error al intentar guardar la encuesta. </div>
		|-elseif $message eq "created"-|
			<div class="resultSuccess">Se ha creado la encuesta. <br />Puede generar las opciones en el formulario de "Opciones de Respuesta" en la parte inferior de esta página.</div>
		|-/if-|
		<fieldset title="Formulario de datos de encuesta">
		<legend>|-if $survey->getId() neq ''-|Editar|-else-|Crear|-/if-|</legend>
		<p>
			Ingrese los datos de la encuesta.
		</p>
			<p>
				<label for="survey_name">Nombre de la Encuesta</label>
				<input type="text" size="45" id="survey_name" name="survey[name]" value="|-$survey->getname()-|" title="name" maxlength="255" />
			</p>
			<p>
			<label for="survey_startDate">Inicia</label>
			<input name="survey[startDate]" type="text" id="survey_startDate" title="startDate" value="|-if $action eq 'edit'-||-$survey->getstartDate()|date_format:"%d-%m-%Y"-||-else-||-$smarty.now|date_format:"%d-%m-%Y"-||-/if-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('survey[startDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="survey_endDate">Termina</label>
				<input name="survey[endDate]" type="text" id="survey_endDate" title="endDate" value="|-$survey->getendDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('survey[endDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			|-if !$configModule->get("surveys","productSurveys")-|<p>
				<label for="survey_isPublic">Visibilidad</label>
				<select name="survey[isPublic]">
						<option value="1" |-if $survey neq '' and $survey->getisPublic() eq 1-|selected="selected"|-/if-|>Pública</option>
						<option value="0" |-if $survey neq '' and $survey->getisPublic() eq 0-|selected="selected"|-/if-|>Para Usuarios Registrados</option>
				</select>
			</p>|-/if-|
			|-if $hasNews neq '' and $hasNews-|
				|-include file="SurveysEditNewsInclude.tpl"-|
			|-/if-|
			<p>
				|-if $survey->getId() neq ''-|
				<input type="hidden" name="id" id="survey_id" value="|-$survey->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="surveysDoEdit" />
				<input type="submit" id="button_edit_survey" name="button_edit_survey" title="Aceptar" value="Aceptar"/>
				<input type="button" id="cancel" name="cancel" title="Cancelar y volver al listado" value="Cancelar" onClick="location.href='Main.php?do=surveysList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>

|-if $survey->getId() ne ''-|
<div id="questionsAdder">
	<fieldset title="Preguntas de encuesta">
	<legend>Preguntas de Encuesta </legend>
		<form id="surveyQuestionAddForm">
				<p>
					<input type="hidden" name="do" value="surveysQuestionsEdit"></input>
					<input type="hidden" name="surveyId" value="|-$survey->getId()-|"></input>
					<a href="#" rel="lightbox1" class="lbOn"><input type="button" name="Agregar Pregunta" value="Agregar Pregunta" id="Agregar Pregunta" onClick="javascript:editQuestionX(this.form)"></input></a> <span id="msgBoxQuestionAdd"></span>
				</p>
		</form>
	
		<h4>Opciones actuales</h4>
		<ul id="surveyQuestionsList">
			|-foreach from=$survey->getSurveyQuestions() item=surveyQuestion-|
			<li id="question|-$surveyQuestion->getId()-|">|-$surveyQuestion->getQuestion()-| 
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="surveysQuestionsEdit" />
					<input type="hidden" name="surveyId" value="|-$survey->getId()-|"></input>
					<input type="hidden" name="id" value="|-$surveyQuestion->getId()-|"/>
					<a href="#" rel="lightbox1" class="lbOn"><input type="button" id="editar" onClick="javascript:editQuestionX(this.form)" class="icon iconEdit"/></a>
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="surveysQuestionsDoDelete" />
					<input type="hidden" name="id" value="|-$surveyQuestion->getId()-|"/>
					<input type="button" name="eliminar" value="eliminar" id="eliminar" onClick="javascript:deleteQuestionX(this.form)" class="icon iconDelete"/>
				</form>
			</li> 
			|-/foreach-|
		</ul>
	</fieldset>
</div>
|-/if-|

<div id="lightbox1" class="leightbox"> 
	<div align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar&nbsp;&nbsp;<input type="button" class="icon iconDelete" /></a> 
	</div> 
	<div id="lightboxContent">
	</div>
</div> 

<script type="text/javascript" src="scripts/lightbox.js"></script>
		
