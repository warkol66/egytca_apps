|-if !$disbursement-|<h2>Indicadores</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Variables</h1>
<p>A continuación encontrará las variables que componen el indicador. Si quiere agregar una variable más, haga click en "Agregar Variable". Puede modificar el nombre de las variables existentes en el campo junto al nombre de la misma.<br />
Para cambiar el orden en que aparecen las variables, arrastre el nombre de la misma a la posición deseada; el sistema le indicará si la operación resultó exitosa.</p>
<p><strong>Indicador:</strong> |-$indicator->getName()-|</p>
<p><strong>Tipo de Gráfico:</strong> |-$indicator->getIndicatorTypeTranslated()-|</p>|-else-|
<h2>Proyectos</h2>
<h1>Curva de desembolso</h1>
<p>A continuación encontrará los meses que abarca la curva de desembolsos. Si quiere agregar un período más, haga click en "Agregar Período". Puede modificar los períodos existentes en el campo junto al mismo.<br />
Para cambiar el orden en que aparecen los meses, arrastre el nombre del mismo a la posición deseada; el sistema le indicará si la operación resultó exitosa.</p>
<p><strong>Gráfico:</strong> |-$indicator->getName()-|</p>
|-/if-|

<form method="post">
<div id="operationInfo"></div>
<fieldset>
<legend>Variables</legend>
<div id="xValues">
	<ul id="xsList">
		<li class="contentLi" style="display:none;">
			<label for="xLabel[name][]">|-if !$disbursement-|Nueva Variable|-else-|Nuevo Período|-/if-|</label>
			<input name="xLabel[name][]" type="text" id="xLabel[name][]" value="" size="45" title="Nombre de la Serie" /> 
			<input name="xLabel[id][]" type="hidden" id="xLabel[id][]" value="0" />
			<a href="#" onclick="if (confirm('¿Seguro que desea eliminar |-if !$disbursement-|la variable|-else-|el período|-/if-|?')){this.parentNode.remove()}; return false;"><img src="images/clear.png" class="iconDelete"></a>
		</li>
		|-assign value=$indicator->getXs() var=xValues-|
		|-foreach from=$xValues item=xValue name=for_xValue-|
			<li id="xsList_|-$xValue->getId()-|" class="contentLi">
				<label for="xLabel[name][]">|-$xValue->getName()|escape-|</label>
				<input name="xLabel[name][]" type="text" id="xLabel[name][]" value="|-$xValue->getName()|escape-|" size="45" title="Nombre de la Variable" />
				<input name="xLabel[id][]" type="hidden" id="xLabel[id][]" value="|-$xValue->getId()-|" />
				<a href="#" onclick='if (confirm("¿Seguro que desea eliminar la variable?")){new Ajax.Updater("operationInfo", "Main.php?do=indicatorsXsDoDeleteX", { method: "post", parameters: { id: "|-$xValue->getId()-|"}, evalScripts: true})};return false;'><img src="images/clear.png" class="iconDelete"></a>
			</li>
		|-/foreach-|
	</ul>
</div>
<p><a href="#" onclick="return addX('xsList')" class="addLink" title="Agregar Variable">|-if !$disbursement-|Agregar Variable|-else-|Agregar Período|-/if-|</a>
<script language="JavaScript" type="text/javascript">
function addX(a) {
	var li = $$("#xsList li")[0];
	$(a).insert({
		bottom: "<li class='contentLi'>"+li.innerHTML+"</li>"
	});

	return false;
}
</script>
<script type="text/javascript">
   Sortable.create("xsList", {
		onUpdate: function() {  
				$('operationInfo').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("operationInfo", "Main.php?do=indicatorsXsDoOrderByIndicatorX",
					{
						method: "post",  
						parameters: { indicatorId: "|-$indicator->getId()-|", data: Sortable.serialize("xsList") }
					});
				} 
			});
 </script>	

	<input type="hidden" name="indicatorId" id="indicatorId" value="|-$indicator->getId()-|" />
	<input type="hidden" name="disbursement" id="disbursement" value="|-$disbursement-|" />
	<input type="hidden" name="do" id="do" value="indicatorsXsDoEdit" />
	<input type="submit" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" />
	|-if !$disbursement-|<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsEdit&id=|-$indicator->getId()-|'" />|-else-|<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsView&id=|-$indicator->getId()-|'" />|-/if-|
	</p>
</fieldset>
</form>
