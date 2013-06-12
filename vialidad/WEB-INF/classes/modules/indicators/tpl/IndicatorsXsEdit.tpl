<h2>Contratos - Desembolsos</h2>
<h1>Períodos de Curva de Avance</h1>
<p>A continuación encontrará los meses que abarca la curva de avances. Si quiere agregar un período más, haga click en "Agregar Período". Puede modificar los períodos existentes en el campo junto al mismo.<br />
Para cambiar el orden en que aparecen los meses, arrastre el nombre del mismo a la posición deseada; el sistema le indicará si la operación resultó exitosa.<br />
NOTA: Para poder generar cálculos en el sistema apartir de las fecha, los formatos de períodos deben expresarse como MM-AAAA (dos cifras para mes y 4 para el año)</p>
<p><strong>Gráfico:</strong> |-$indicator->getName()-|</p>
<form method="post">
<div id="operationInfo"></div>
<fieldset>
<legend>Variables</legend>
<div id="xValues">
	<ul id="xsList">
		<li class="contentLi" style="display:none;">
			<label for="xLabel[name][]">Nuevo Período</label>
			<input name="xLabel[name][]" type="text" id="xLabel[name][]" value="" size="15" title="Nombre del período en formato MM-AAAA" /> 
			<input name="xLabel[id][]" type="hidden" id="xLabel[id][]" value="0" />
			<a href="#" onclick="if (confirm('¿Seguro que desea eliminar el período?')){this.parentNode.remove()}; return false;"><img src="images/clear.png" class="icon iconDelete"></a>
		</li>
		|-assign value=$indicator->getXs() var=xValues-|
		|-foreach from=$xValues item=xValue name=for_xValue-|
			<li id="xsList_|-$xValue->getId()-|" class="contentLi">
				<label for="xLabel[name][]">|-$xValue->getName()|escape-|</label>
				<input name="xLabel[name][]" type="text" id="xLabel[name][]" value="|-$xValue->getName()|escape-|" size="15" title="Nombre del período en formato MM-AAAA" />
				<input name="xLabel[id][]" type="hidden" id="xLabel[id][]" value="|-$xValue->getId()-|" />
				<a href="#" onclick='if (confirm("¿Seguro que desea eliminar el Período?")){new Ajax.Updater("operationInfo", "Main.php?do=indicatorsXsDoDeleteX", { method: "post", parameters: { id: "|-$xValue->getId()-|"}, evalScripts: true})};return false;'><img src="images/clear.png" class="icon iconDelete"></a>
			</li>
		|-/foreach-|
	</ul>
</div>
<p><a href="#" onclick="return addX('xsList')" class="addLink" title="Agregar Período">Agregar Período</a>
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
	<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsView&id=|-$indicator->getId()-|'" />
	</p>
</fieldset>
</form>
