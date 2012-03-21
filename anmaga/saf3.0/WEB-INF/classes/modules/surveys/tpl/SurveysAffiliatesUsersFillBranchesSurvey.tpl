<h2>Módulo de Encuetas</h2>
<h1>|-if $survey->hasExpired()-|Consultar|-else-|Completar|-/if-| Encuesta</h1>
<div id="div_survey">
<p>Seleccione una ##affiliates,9,sucursal## para |-if $survey->hasExpired()-|consultar|-else-|completar|-/if-| la encuesta.</p>

<form action="Main.php" method="get">
		<fieldset title="Formulario de seleccion de ##affiliates,9,sucursal##">
		<legend>Selección de ##affiliates,9,sucursal##</legend>
			<p>
				<label for="objectId">##affiliates,4,Sucursal##</label>
				<select name="objectId">
					|-foreach from=$branches item=branch-|
						<option value="|-$branch->getId()-|" |-if $survey->hasBeenAnsweredBy($branch)-|disabled="disabled"|-/if-|>|-$branch-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<input type="hidden" name="id" id="survey_id" value="|-$survey->getid()-|" />
				<input type="hidden" name="do" id="do" value="surveysShow" />
				<input type="hidden" name="objectType" id="objectType" value="AffiliateBranch" />
				|-if $survey->hasExpired()-|<input type="submit" id="button_edit_survey" name="button_edit_survey" title="Consultar respuestas" value="Conusultar encuesta"/>
				|-else-|<input type="submit" id="button_edit_survey" name="button_edit_survey" title="Responder encuesta" value="Responder encuesta"/>|-/if-|
			</p>
		</fieldset>
	</form>
</div>
