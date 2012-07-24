<script type="text/javascript">
	$('commitmentInfo').innerHTML = '<span class="resultSuccess">Compromiso guardado correctamente</span>';
	$('form_edit_commitment').reset();
	clearFormFieldsFormat('form_edit_commitment');
</script>

<script type="text/javascript" language="javascript" charset="utf-8">
|-if $action eq "create"-|
  var tbl = document.getElementById('commitmentsList');
  var row = tbl.insertRow(-1);
	row.id = "row_|-$commitment->getId()-|";
	var cell1 = document.createElement("td");
	var cell2 = document.createElement("td");
	var cell3 = document.createElement("td");
	var cell4 = document.createElement("td");
	var cell5 = document.createElement("td");
|-else-|
  var row = document.getElementById("row_|-$commitment->getId()-|");
	var cell1 = row.cells[0];
	var cell2 = row.cells[1];
	var cell3 = row.cells[2];
	var cell4 = row.cells[3];
	var cell5 = row.cells[4];
|-/if-|
	cell1.innerHTML = "|-$commitment->getCommitment()|escape:'html'|nl2br|strip-|";
	cell2.innerHTML = "|-$commitment->getResponsible()|escape:'html'|strip-|";
	cell3.innerHTML = "<div align='center'>|-$commitment->getDate()|date_format-|</div>";
	cell4.innerHTML = "<div align='center'>|-$commitment->getAchieved()|yes_no|multilang_get_translation:'common'-|</div>";
|-if $action eq "create"-|
	|-if "campaignsCommitmentEditX"|security_has_access-|
		cell5.className = "noWrap";
		cell5.innerHTML = '<form action="Main.php" method="post" style="display:inline;"><input type="hidden" name="do" value="campaignsCommitmentEditX" /><input type="hidden" name="id" value="|-$commitment->getid()-|" /><a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" name="submit_go_delete_campaign" value="Editar" onclick="editCommitment(this.form);" class="icon iconEdit" /></a></form> ';
		|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|	
			cell5.innerHTML += '<form action="Main.php" method="post" style="display:inline;"><input type="hidden" name="do" value="campaignsCommitmentDoDeleteX" /><input type="hidden" name="id" value="|-$commitment->getid()-|" /><input type="button" name="submit_go_delete_campaign" value="Borrar" title="Borrar" onclick="javascript: if (confirm(\'Seguro que desea eliminar este compromiso?\')) deleteCommitment(this.form);" class="icon iconDelete" /></form> ';
		|-/if-|
		|-if $loginUser->isSupervisor()-|
		cell5.innerHTML += '<form action="Main.php" method="post" style="display:inline;"><input type="hidden" name="do" value="campaignsCommitmentDoDeleteX" /><input type="hidden" name="id" value="|-$commitment->getid()-|" /> <input type="hidden" name="doHardDelete" value="true" /><input type="button" name="submit_go_delete_campaign" value="Borrar definitivamente" title="Borrar definitivamente" onclick="javascript: if (confirm(\'Seguro que desea eliminar este compromiso definitivamente?\')) deleteCommitment(this.form);" class="icon iconHardDelete" /></form>';
		|-/if-|
	|-/if-|
|-/if-|

|-if $action eq "create"-|
	row.appendChild(cell1);
	row.appendChild(cell2);
	row.appendChild(cell3);
	row.appendChild(cell4);
	row.appendChild(cell5);
	//tabBody.appendChild(row);
	initialize(); //Esto para que el lightbox vuelve a ver todos los elementos
|-/if-|
</script>
