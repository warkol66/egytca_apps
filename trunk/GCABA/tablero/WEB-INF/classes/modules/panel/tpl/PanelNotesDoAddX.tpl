<script language="JavaScript" type="text/JavaScript">
	$('messageAdd').innerHTML = "<span class=\"resultSuccess\">Nota agregada</span>";
	$('params_note').value = "";
</script>
<li id="noteListItem|-$panelNote->getId()-|" title="Nota">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="panelNotesDoDeleteX" /> 
							<input type="hidden" name="id" value="|-$panelNote->getId()-|" /> 
							<input type="button" name="submit_go_remove_actor" value="Borrar" title="Eliminar nota" onclick="if (confirm('Seguro que desea eliminar nota?')) removePanelNotes(this.form);" class="icon iconDelete" /> 
						</form>|-$panelNote->getCreatedAt()|change_timezone|dateTime_format-| - |-$panelNote->updatedBy()-| | |-$panelNote->getNote()-|</li>