<script type="text/javascript" language="javascript" >
	$('#tagMsgField').html('<span class="resultSuccess">Etiqueta Agregada</span>');
	if ($('#tagOption|-$tag->getId()-|') != null) {
		$('#tagOption|-$tag->getId()-|').remove();
	}
</script>
<li id="tagListItem|-$tag->getId()-|">
	<form  method="post"> 
		<input type="hidden" name="do" id="do" value="blogDoDeleteTagFromEntryX" /> 
		<input type="hidden" name="entryId"  value="|-$entry->getId()-|" /> 
		<input type="hidden" name="tagId"  value="|-$tag->getId()-|" /> 
		<input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar el vínculo con la región?')){deleteTagFromEntry(this.form)}; return false" class="icon iconDelete" /> 
 </form><span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$tag->getName()-|</span>
</li>
