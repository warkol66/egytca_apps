<h2>Fuentes de Financiamiento</h2>
<h1>Administración de Fuentes de Financiamiento</h1>
<p>A continuación se muestra la lista de Fuentes de Financiamiento cargados en el sistema.</p>
<div id="div_sources"> 
	|-if $message eq "deleted_ok"-|
		<div class="successMessage" id="actionMessage">Fuente de Financiamiento eliminada correctamente</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar Fuente de Financiamiento. No se pueden eliminar Fuentes de Financiamiento que se encuentren en uso.</div>
|-/if-|
	<div name="working_status_message" style="display:none;" class="inProgress">Trabajando...</div>
	<div name="done_status_message" style="display:none;" class="successMessage"> Fuente de Financiamiento agregada</div>
	<table id="table_sources" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Fuentes de Financiamiento </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p><label>Texto</label><input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
						<input type="hidden" name="do" value="vialidadSourcesList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadSourcesList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "vialidadSourcesEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="toggleInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Fuente de Financiamiento</a>
					<form id="addInput1" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink1', 'addInput1'); setStatus('done'); reset(this); return false;" style="display: none;">
						Fuente de Financiamiento <label for="name[code]">Código</label>
						<input type="text" name="params[code]" size="3" />
						<label for="name[name]">Nombre</label>
						<input type="text" name="params[name]" size="25" />
						<input type="hidden" name="do" value="vialidadSourcesDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="toggleInput('addLink1', 'addInput1');" />
					</form>
				</div>
			</th>
		</tr>
		|-/if-|
		
		<tr class="thFillTitle"> 
			<th width="5%" nowrap="nowrap">Código</th>
			<th width="90%" nowrap="nowrap">Nombre</th>
			<th width="5%" nowrap="nowrap">&nbsp;</th>
		</tr>
		</thead>
	
		<tbody id="sourcesList">

	|-include file="VialidadSourcesListInclude.tpl"-|

		</tbody>
		<tfoot>
		|-if "vialidadSourcesEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="toggleInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Fuente de Financiamiento</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink2', 'addInput2'); setStatus('done'); reset(this); return false;" style="display: none;">
						Fuente de Financiamiento <label for="name[code]">Código</label>
						<input type="text" name="params[code]" size="3" />
						<label for="name[name]">Nombre</label>
						<input type="text" name="params[name]" size="25" />
						<input type="hidden" name="do" value="vialidadSourcesDoEditX" />
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
		{ success: 'sourcesList' },
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
function chomp(raw_text) {
    return raw_text.replace(/(\n|\r)+$/, '');
}
function clean(value) {
	var aux;
	aux = value.replace(/---\s/, '');
	return aux.replace(/\s---$/, '');
}

</script>