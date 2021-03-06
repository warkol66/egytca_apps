<h2>Planificación </h2>
<h1>Administración de Indicadores - |-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Series</h1>
<p>A contunuación encontrará las series que componen el indicador. Si quiere agregar una serie mas, haga click en "Agregar Serie". Puede modificar el nombre de las series existentes en el campo junto al nombre de la misma.<br />
Para cambiar el orden en que aparecen las series, arrastre el nombre de la misma a la posición deseada; el sistema le indicará si la operación resultó exitosa.</p>
|-if $message eq "ok"-|
<div class="successMessage">Series guardadas correctamente.</div>
|-elseif $message eq "error"-|
<div class="failureMessage">Ha ocurrido un error al intentar guardar las Series.</div>
|-/if-|
<p><strong>Indicador:</strong> |-$indicator->getName()-|</p>
<p><strong>Tipo de Gráfico:</strong> |-$indicator->getIndicatorType()-|</p>

<form method="post" action="Main.php">
<div id="operationInfo"></div>
<fieldset>
<legend>Series</legend>
<div id="seriesValues">
	<ul id="seriesList">
		<li class="contentLi" style="display:none;">
			<label for="serieLabel[name][]">Nueva serie</label>
			<input name="serieLabel[name][]" type="text" id="serieLabel[]" value="" size="45" title="Nombre de la Serie" /> 
			<input name="serieLabel[id][]" type="hidden" id="serieLabel[][id]" value="0" />
		<input type="button" title="Eliminar Serie" class="icon iconDelete" onclick='if (confirm("¿Seguro que desea eliminar la variable?")){this.parentNode.remove();return false;}' value="Borrar" name="submit_go_delete_indicator"/>
		</li>
		|-assign value=$indicator->getSeries() var=series-|
		|-foreach from=$series item=serie name=for_serie-|
			<li id="seriesList_|-$serie->getId()-|" class="contentLi">
				<label for="serieLabel[name][]">|-$serie->getName()|escape-|</label>
				<input name="serieLabel[name][]" type="text" id="serieLabel[]" value="|-$serie->getName()|escape-|" size="45" title="Nombre de la Serie" />
				<input name="serieLabel[id][]" type="hidden" id="serieLabel[][id]" value="|-$serie->getId()-|" />
				<input type="button" title="Eliminar Serie" class="icon iconDelete" onclick='if (confirm("¿Seguro que desea eliminar la variable?")){new Ajax.Updater("operationInfo", "Main.php?do=planningIndicatorsSeriesDoDeleteX", { method: "post", parameters: { id: "|-$serie->getId()-|"}, evalScripts: true})};return false;' value="Borrar" name="submit_go_delete_indicator"/>

			</li>
		|-/foreach-|
	</ul>
</div>
|-if $indicator->getType() neq constant("IndicatorPeer::PIE")-|
 <p><a href="#" onclick="return addSerie('seriesList')" class="addLink" title="Agregar serie">Agregar Serie</a></p>
<script language="JavaScript" type="text/javascript">
function addSerie(a) {
	var li = $$("#seriesList li")[0];
	$(a).insert({
		bottom: "<li class='contentLi'>"+li.innerHTML+"</li>"
	});

	return false;
}
</script>	
<script type="text/javascript">
   Sortable.create("seriesList", {
		onUpdate: function() {  
				$('operationInfo').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("operationInfo", "Main.php?do=planningIndicatorsSeriesDoOrderByIndicatorX",
					{
						method: "post",  
						parameters: { indicatorId: "|-$indicator->getId()-|", data: Sortable.serialize("seriesList") }
					});
				} 
			});
 </script>
|-/if-|
<p>	<input type="hidden" name="indicatorId" id="indicatorId" value="|-$indicator->getId()-|" />
	<input type="hidden" name="do" id="do" value="planningIndicatorsSeriesDoEdit" />
	<input type="submit" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" />
	<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=planningIndicatorsEdit&id=|-$indicator->getId()-|'" /></p>
</fieldset>
</form>
