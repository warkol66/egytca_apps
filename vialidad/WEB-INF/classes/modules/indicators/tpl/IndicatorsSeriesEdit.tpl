<h2>Contratos - Desembolsos</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Curvas</h1>
<p>A contunuación encontrará las curvas de desembolso. Si quiere agregar una nueva curva, haga click en "Agregar Curva ". Puede modificar el nombre de las curvas existentes en el campo junto al nombre de la misma.<br />
Para cambiar el orden en que aparecen las curvas, arrastre el nombre de la misma a la posición deseada; el sistema le indicará si la operación resultó exitosa.</p>
<p><strong>Contratos:</strong> |-$indicator->getName()-|</p>
<form method="post">
  <fieldset>
<legend>Curvas</legend>
<div id="seriesValues">
	<ul id="seriesList">
		<li class="contentLi" style="display:none;">
			<label for="serieLabel[name][]">Nueva serie</label>
			<input name="serieLabel[name][]" type="text" id="serieLabel[]" value="" size="45" title="Nombre de la Serie" /> 
			<input name="serieLabel[id][]" type="hidden" id="serieLabel[][id]" value="0" />
			<a href="#" onclick="if (confirm('¿Seguro que desea eliminar la serie?')){this.parentNode.remove()}; return false"><img src="images/clear.png" class="linkImageDelete"></a>
		</li>
		|-assign value=$indicator->getSeries() var=series-|
		|-foreach from=$series item=serie name=for_serie-|
			<li id="seriesList_|-$serie->getId()-|" class="contentLi">
				<label for="serieLabel[name][]">|-$serie->getName()|escape-|</label>
				<input name="serieLabel[name][]" type="text" id="serieLabel[]" value="|-$serie->getName()|escape-|" size="45" title="Nombre de la Serie" />
				<input name="serieLabel[id][]" type="hidden" id="serieLabel[][id]" value="|-$serie->getId()-|" />
				<a href="#" onclick='if (confirm("¿Seguro que desea eliminar la variable?")){new Ajax.Updater("operationInfo", "Main.php?do=indicatorsSeriesDoDeleteX", { method: "post", parameters: { id: "|-$serie->getId()-|"}, evalScripts: true})};return false;'><img src="images/clear.png" class="linkImageDelete"></a>
			</li>
		|-/foreach-|
	</ul>
</div>
|-if $indicator->getType() neq constant("IndicatorPeer::PIE")-|
 <p><a href="#" onclick="return addSerie('seriesList')" class="addLink" title="Agregar serie">Agregar Curva</a></p>
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
				new Ajax.Updater("operationInfo", "Main.php?do=indicatorsSeriesDoOrderByIndicatorX",
					{
						method: "post",  
						parameters: { indicatorId: "|-$indicator->getId()-|", data: Sortable.serialize("seriesList") }
					});
				} 
			});
 </script>
|-/if-|
<p>	<input type="hidden" name="indicatorId" id="indicatorId" value="|-$indicator->getId()-|" />
	<input type="hidden" name="do" id="do" value="indicatorsSeriesDoEdit" />
	<input type="submit" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" />
	<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsEdit&id=|-$indicator->getId()-|'" /></p>
</fieldset>
</form>
