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
	var cell6 = document.createElement("td");
|-else-|
  var row = document.getElementById("row_|-$commitment->getId()-|");
	var cell1 = row.cells[0];
	var cell2 = row.cells[1];
	var cell3 = row.cells[2];
	var cell4 = row.cells[3];
	var cell5 = row.cells[4];
	var cell6 = row.cells[5];

|-/if-|
	cell2.innerHTML = "|-$commitment->getCommitment()|escape:'html'|nl2br|strip-|";
	cell3.innerHTML = "|-$commitment->getResponsible()|escape:'html'|strip-|";
	cell4.innerHTML = "|-$commitment->getDate()|date_format-|";
	cell5.innerHTML = '|-$commitment->getAchieved()|yes_no|multilang_get_translation:"common"-|';
|-if $action eq "create"-|
	cell6.className = "noWrap";
	cell6.innerHTML = '<form action="Main.php" method="get" style="display:inline;">';
	cell6.innerHTML += '<input type="hidden" name="do" value="panelMissionCommitmentEditX" />';
	cell6.innerHTML += '<input type="hidden" name="id" value="|-$commitment->getid()-|" />';
	cell6.innerHTML += '<input type="submit" name="submit_go_edit_mission" value="Editar" class="iconEdit" /></form>';
|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|	
	cell6.innerHTML += '<form action="Main.php" method="post" style="display:inline;"><input type="hidden" name="do" value="panelMissionCommitmentDoDeleteX" /><input type="hidden" name="id" value="|-$commitment->getid()-|" /><input type="button" name="submit_go_delete_mission" value="Borrar" onclick="javascript: if (confirm(\'Seguro que desea eliminar este compromiso?\')) deleteCommitment(this.form);" class="iconDelete" /></form>';
	|-/if-|
	|-if $loginUser->isSupervisor()-|
	cell6.innerHTML += '<form action="Main.php" method="post" style="display:inline;"><input type="hidden" name="do" value="panelMissionCommitmentDoDeleteX" /><input type="hidden" name="id" value="|-$commitment->getid()-|" /> <input type="hidden" name="doHardDelete" value="true" /><input type="button" name="submit_go_delete_mission" value="Borrar" onclick="javascript: if (confirm(\'Seguro que desea eliminar este compromiso definitivamente?\')) deleteCommitment(this.form);" class="iconDelete" /></form>';
	|-/if-|
|-/if-|

|-if $action eq "create"-|
	row.appendChild(cell1);
	row.appendChild(cell2);
	row.appendChild(cell3);
	row.appendChild(cell4);
	row.appendChild(cell5);
	row.appendChild(cell6);
	//tabBody.appendChild(row);
|-/if-|
</script>
