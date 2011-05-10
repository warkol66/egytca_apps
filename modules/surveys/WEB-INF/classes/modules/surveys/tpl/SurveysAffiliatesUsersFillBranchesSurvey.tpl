<h2>Módulo de Encuetas</h2>
<h1>Completar Encuesta</h1>
<div id="div_survey">
<p>Seleccione una sucursal para completar la encuesta.</p>

<form action="Main.php" method="get">
		<fieldset title="Formulario de seleccion de sucursal">
		<legend>Selección de sucursal</legend>
			<p>
				<label for="objectId">Sucursal</label>
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
				<input type="submit" id="button_edit_survey" name="button_edit_survey" title="Aceptar" value="Aceptar"/>
			</p>
		</fieldset>
	</form>
</div>
