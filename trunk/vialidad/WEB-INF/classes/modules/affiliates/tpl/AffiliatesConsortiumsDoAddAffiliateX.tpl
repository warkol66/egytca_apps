<script type="text/javascript" language="javascript" >
	$('consortiumMsgField').innerHTML = '<span class="resultSuccess">Proveedor agregado con éxito al consorcio.</span>';
</script>

<li id="consortiumListItem|-$affiliate->getId()-|" title="Proveedores asociados al consorcio">
	<form action="Main.php" method="post" style="display:inline;"> 
		<input type="hidden" name="do" id="do" value="affiliatesConsortiumsDoRemoveAffiliateX" />
		<input type="hidden" name="affiliate1"  value="|-$consortium->getId()-|" />		
		<input type="hidden" name="affiliate2"  value="|-$affiliate->getId()-|" />	
		<input type="button" value="Eliminar" title="Eliminar Proveedor del consorcio" onclick="if (confirm('Seguro que desea quitar el proveedor del consorcio?')) removeAffiliateFromConsortium(this.form);" class="icon iconDelete" />
	</form>	|-$affiliate-| &nbsp; &nbsp;
	
</li>
