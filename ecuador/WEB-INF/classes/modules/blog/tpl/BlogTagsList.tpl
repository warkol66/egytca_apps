<h2>##blog,1,Blog##</h2>
<h1>Administración de Etiqueta de Entradas</h1>
<p>A continuación podrá editar la lista de etiquetas de entradas del blog del sistema.</p>
<div id="div_tags"> |-if $message eq "ok"-|
	<div class="successMessage">Etiqueta guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Etiqueta eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-tags">
		<thead>
			<tr>
				<td colspan="3" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
					<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
						<form action='Main.php' method='get' style="display:inline;">
							<input type="hidden" name="do" value="blogTagsList" />
							Nombre:
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
							&nbsp;&nbsp;
							<input type='submit' value='Buscar' class='tdSearchButton' />
						</form>
						<form  method="get">
							<input type="hidden" name="do" value="blogTagsList" />
							<input type="submit" value="Quitar Filtros" />
						</form>
					</div></td>
			</tr>
			<tr>
				<th colspan="3" class="thFillTitle">
					<div class="rightLink">
						<a href="#" onclick="showInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Etiqueta</a>
						<form id="addInput2" action="Main.php" method="POST" onsubmit="prepareAndSubmit(this); showInput('addLink2', 'addInput2'); return false;" style="display: none;">
							<label>Nombre</label>
							<input type="text" name="params[name]" />
							<input type="hidden" name="do" value="blogTagsDoEditX" />
							<input type="submit" value="Guardar" class="icon iconActivate" />
							<input type="button" value="Cancelar" class="icon iconCancel" onclick="showInput('addLink2', 'addInput2');" />
						</form>
					</div>
				</th>
			</tr>
			<tr class="thFillTitle">
<!--				<th width="5%" class="thFillTitle">Id</th> -->
				<th width="60%">Nombre</th>
				<th width="30%">Entradas (publicadas)</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $blogTagColl|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filters)-|No hay etiquetas que concuerden con la búsqueda|-else-|No hay etiquetas disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-include file="BlogTagsListInclude.tpl"-|
	|-/if-|
	</tbody>
	<tfoot>
	|-if "blogTagsDoEditX"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="showInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Etiqueta</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="prepareAndSubmit(this); showInput('addLink2', 'addInput2'); return false;" style="display: none;">
						<label>Nombre</label>
						<input type="text" name="params[name]" />
						<input type="hidden" name="do" value="blogTagsDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="showInput('addLink2', 'addInput2');" />
					</form>
				</div>
			</th>
		</tr>
	|-/if-|
	</tfoot>
	</table>
</div>
|-if "blogTagsDoEditX"|security_has_access-|
<script language="JavaScript" type="text/JavaScript">
function showInput(to_show, to_hide) {
	$('#'+to_show).show();
	$('#'+to_hide).hide();
}
function setStatus(status, message) {
	switch (status) {
		case 'working':
			if (message != undefined)
				$('[name=working_status_message]').html(message);
			$('[name=done_status_message]').hide();
			$('[name=working_status_message]').show();
			$('[name=error_status_message]').hide();
			break;
		case 'done':
			if (message != undefined)
				$('[name=done_status_message]').html(message);
			$('[name=done_status_message]').show();
			$('[name=working_status_message]').hide();
			$('[name=error_status_message]').hide();
			break;
		case 'error':
			if (message != undefined)
				$('[name=error_status_message]').html(message);
			$('[name=done_status_message]').hide();
			$('[name=working_status_message]').hide();
			$('[name=error_status_message]').show();
			break;
		default:
			// unimplemented status
			break;
	}
}
function chomp(raw_text) {
		return raw_text.replace(/(\n|\r)+$/, '');
}
function clean_text_content_from(element) {
		element.innerHTML = chomp(element.innerHTML);
}
function clean(value) {
	var aux;
	aux = value.replace(/---\s/, '');
	return aux.replace(/\s---$/, '');
}
function prepareAndSubmit(form) {
	setStatus('working');
	$.ajax({
		url: 'Main.php',
		type: 'post',
		data: $(form).serialize(),
		success: function(data) {
			$(data).appendTo($('#blogTagsTbody'));
			setStatus('done');
		},
		error: function(jqXHR, textStatus, errorThrown) {
			var errorMsg = 'Ocurrió un error al intentar agregar la Etiqueta';
			if (errorThrown != undefined)
				errorMsg += ': ' + errorThrown;
			setStatus('error', errorMsg);
		}
	});
	form.reset();
}
</script>
|-/if-|
