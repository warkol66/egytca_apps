<script type="text/javascript" language="javascript" >
	$('sourceMsgField').innerHTML = '<span class="resultSuccess">Fuente agregada</span>';
</script>

<li id="sourceListItem|-$source->getId()-|" title="Fuentes asociadas al contrato">
	<form action="Main.php" method="post" style="display:inline;"> 
		<input type="hidden" name="do" id="do" value="vialidadContractsDoRemoveSourceX" />
		<input type="hidden" name="contractId"  value="|-$contract->getId()-|" />
		<input type="hidden" name="sourceId"  value="|-$source->getId()-|" />			
		<input type="button" value="Eliminar" title="Eliminar fuente de contrato" onclick="if (confirm('Seguro que desea quitar la fuente del contrato?')) removeSourceFromcontract(this.form);" class="icon iconDelete" />
	</form>	|-$source-| &nbsp; &nbsp;
	<span id='span_ammount_for_|-$source->getId()-|' class="bold italic" title="Modifique el monto del financiamiento">
	|-*include file='contractsSelectsourceRole.tpl' action=$sourceRoleAction sourceId=$source->getId()*-|
	</span>
</li>
