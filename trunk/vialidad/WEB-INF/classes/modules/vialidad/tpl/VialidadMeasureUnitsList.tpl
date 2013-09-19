<h2>Unidades de Medida</h2>
<h1>Administración de Unidades de Medida</h1>
<p>A continuación se muestra la lista de Unidades de Medida cargadas en el sistema.</p>
<div id="div_supplies"> 
	|-if $message eq "deleted_ok"-|
		<div id="deleted_message" class="successMessage">Unidad de Medida eliminada correctamente</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar la Unidad de Medida. No se pueden eliminar Unidades de Medida que se encuentren en uso.</div>
|-/if-|
	<div name="working_status_message" style="display:none;" class="inProgress">Trabajando...</div>
	<div name="done_status_message" style="display:none;" class="successMessage">Unidad de Medida agregada</div>
<script language="JavaScript" type="text/JavaScript">
function toggleInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}
function setStatus(status) {
	try {
		document.getElementById('deleted_message').hide();
	}
	catch(err) { //Handle errors here
  }
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
function updateCode(id, value) {
	new Ajax.Updater(
		'span_code_'+id,
		'Main.php?do=commonDoEditFieldX',
		{
			method: 'post',
			parameters: {
				id: id,
				paramName: 'code',
				paramValue: value
			}
		}
	);
}
function updateName(id, value) {
	new Ajax.Updater(
		'span_name_'+id,
		'Main.php?do=commonDoEditFieldX',
		{
			method: 'post',
			parameters: {
				id: id,
				paramName: 'name',
				paramValue: value
			}
		}
	);
}
Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});
</script>

	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
<!--		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Unidades de Medida </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p><label>Texto</label><input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
						<input type="hidden" name="do" value="vialidadMeasureUnitsList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadMeasureUnitsList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr> -->
		|-if "vialidadMeasureUnitsEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="javascript:void(null);" onclick="toggleInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Unidad de Medida</a>
					<form id="addInput1" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink1', 'addInput1'); reset(this); return false;" style="display: none;">
						<label>Nombre de la unidad</label>
						<input type="text" name="params[name]" />
						<label for="name[code]">Código</label>
						<input type="text"  name="params[code]" />
						<input type="hidden" name="do" value="vialidadMeasureUnitsDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="toggleInput('addLink1', 'addInput1');" />
					</form>
				</div>
			</th>
		</tr>
		|-/if-|
		<tr class="thFillTitle"> 
			<th width="60%">Unidad de Medida</th>
			<th width="35%">C&oacute;digo</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
		<tbody id="measureUnitsList">
			|-include file="VialidadMeasureUnitsListInclude.tpl"-|
		</tbody>
		<tfoot>
		|-if "vialidadMeasureUnitsEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="javascript:void(null);" onclick="toggleInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Unidad de Medida</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink2', 'addInput2'); reset(this); return false;" style="display: none;">
						<label>Nombre de la unidad</label>
						<input type="text" name="params[name]" />
						<label for="name[code]">Código</label>
						<input type="text"  name="params[code]" />
						<input type="hidden" name="do" value="vialidadMeasureUnitsDoEditX" />
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
<script language="JavaScript" type="text/JavaScript">
function prepareAndSubmit(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
		{ success: 'measureUnitsList' },
		'Main.php',
		{
			method: 'post',
			postBody: fields,
			evalScripts: true
		}
	);
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
</script>
