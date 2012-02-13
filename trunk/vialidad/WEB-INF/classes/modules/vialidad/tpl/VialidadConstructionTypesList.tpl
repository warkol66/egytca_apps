<h2>Tipos de Obra</h2>
<h1>Administración de Tipos de Obra</h1>
<p>A continuación se muestra la de los departamentos.</p>
<div id="div_sources"> 
	|-if $message eq "deleted_ok"-|
		<div class="successMessage" id="actionMessage">Tipo de Obra eliminado correctamente</div>
	|-/if-|
	<div name="working_status_message" style="display:none;" class="inProgress">Trabajando...</div>
	<div name="done_status_message" style="display:none;" class="successMessage"> Tipo de Obra agregado</div>
	<table id="table_sources" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="2" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Tipos de Obra </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p><label>Texto</label><input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
						<input type="hidden" name="do" value="vialidadConstructionTypesList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadConstructionTypesList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "vialidadConstructionTypesEdit"|security_has_access-|
		<tr>
			<th colspan="2" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="toggleInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Tipo de Obra</a>
					<form id="addInput1" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink1', 'addInput1'); setStatus('done'); reset(this); return false;" style="display: none;">
						<label for="name[name]">Tipo de Obra</label>
						<input type="text" name="params[name]" size="25" />
						<input type="hidden" name="do" value="vialidadConstructionTypesDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="toggleInput('addLink1', 'addInput1');" />
					</form>
				</div>
			</th>
		</tr>
		|-/if-|
		<tr class="thFillTitle"> 
			<th width="95%" nowrap="nowrap">Nombre</th>
			<th width="5%" nowrap="nowrap">&nbsp;</th>
		</tr>
		</thead>
		<tbody id="constructionTypesList">
	|-include file="VialidadConstructionTypesListInclude.tpl"-|
		</tbody>
		<tfoot>
		|-if "vialidadConstructionTypesEdit"|security_has_access-|
		<tr>
			<th colspan="2" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="toggleInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Tipo de Obra</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink2', 'addInput2'); setStatus('done'); reset(this); return false;" style="display: none;">
						<label for="name[name]">Tipo de Obra</label>
						<input type="text" name="params[name]" size="25" />
						<input type="hidden" name="do" value="vialidadConstructionTypesDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="toggleInput('addLink2', 'addInput2');" />
					</form>
				</div>

			</th>
		</tr>
		|-/if-|
		</tfoot>
	</table> 
</div>


<script type="text/javascript">
function setStatus(status) {

	var actionMessage = $('actionMessage');
	if (actionMessage)
		actionMessage.hide();

	switch (status) {
		case 'working':
			msgs = document.getElementsByName('done_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].hide();
			msgs = document.getElementsByName('working_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].show();
			break;
		case 'done':
			msgs = document.getElementsByName('working_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].hide();
			msgs = document.getElementsByName('done_status_message');
			for (var i=0; i<msgs.length; i++)
				msgs[i].show();
			break;
		default:
			// unimplemented status
			break;
	}
}

Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});


function toggleInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}

function prepareAndSubmit(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
		{ success: 'constructionTypesList' },
		'Main.php',
		{
			method: 'post',
			postBody: fields,
			evalScripts: true
		}
	);
	form.name.value = '';
}

function chomp(raw_text) {
    return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
    element.innerHTML = chomp(element.innerHTML);
}
</script>