<script type="text/javascript" language="javascript" >
	$('sourceMsgField').innerHTML = '<span class="resultSuccess">Proveedor agregado con éxito al consorcio.</span>';
</script>

<li id="sourceListItem|-$affiliate->getAffiliate1()-|" title="Proveedores asociados al consorcio">
	<form action="Main.php" method="post" style="display:inline;"> 
		<input type="hidden" name="do" id="do" value="affiliatesConsortiumsDoRemoveAffiliateX" />
		<input type="hidden" name="affiliate1"  value="|-$affiliate->getAffiliate1()-|" />		
		<input type="hidden" name="affiliate2"  value="|-$affiliate->getAffiliate2()-|" />	
		<input type="button" value="Eliminar" title="Eliminar Proveedor del consorcio" onclick="if (confirm('Seguro que desea quitar el proveedor del consorcio?')) removeAffiliateFromconsortium(this.form);" class="icon iconDelete" />
	</form>	|-$affiliate-| &nbsp; &nbsp;
	
</li>
