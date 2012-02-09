<h2>Fuentes de Financiamiento</h2>
<h1>Administración de Fuentes de Financiamiento</h1>
<p>A continuación se muestra la lista de Fuentes de Financiamiento cargados en el sistema.</p>
<div id="div_sources"> 
	|-if $message eq "deleted_ok"-|
		<div class="successMessage">Fuente de Financiamiento eliminado correctamente</div>
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
					<a href="#" onclick="showInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Fuente de Financiamiento</a>
					<form id="addInput1" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); showInput('addLink1', 'addInput1'); setStatus('done'); return false;" style="display: none;">
						Fuente de Financiamiento <label for="name[code]">Código</label>
						<input type="text" name="params[code]" size="3" />
						<label for="name[name]">Nombre</label>
						<input type="text" name="params[name]" size="25" />
						<input type="hidden" name="do" value="vialidadSourcesDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="showInput('addLink1', 'addInput1');" />
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
		|-if $sources|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filter)-|No hay Fuentes de Financiamiento que concuerden con la búsqueda|-else-|No hay Fuentes de Financiamiento disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$sources item=source name=for_sources-|
		<tr> 
			<td>
				|-if "vialidadSourcesEdit"|security_has_access-|
				<span id="code_|-$source->getId()-|" class="in_place_editable">|-$source->getCode()-|</span>
				|-else-|
				|-$source->getCode()-|
				|-/if-|
			</td>
			<td>
				|-if "vialidadSourcesEdit"|security_has_access-|
				<span id="name_|-$source->getId()-|" class="in_place_editable">|-$source->getName()-|</span>
				|-else-|
				|-$source->getName()-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "vialidadSourcesEdit"|security_has_access-|
					<input type="hidden" name="do" value="vialidadSourcesEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$source->getid()-|" />
					<input type="submit" id="source_edit_|-$source->getId()-|" name="submit_go_edit_vialidad_source" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "vialidadSourcesDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSourcesDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$source->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_source" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar la Fuente de Financiamiento?')" class="icon iconDelete" />
				</form>
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		</tbody>
		<tfoot>
		|-if "vialidadSourcesEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="showInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Fuente de Financiamiento</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); showInput('addLink2', 'addInput2'); setStatus('done'); return false;" style="display: none;">
						Fuente de Financiamiento <label for="name[code]">Código</label>
						<input type="text" name="params[code]" size="3" />
						<label for="name[name]">Nombre</label>
						<input type="text" name="params[name]" size="25" />
						<input type="hidden" name="do" value="vialidadSourcesDoEditX" />
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


<script type="text/javascript">
function setStatus(status) {
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

function attachNameInPlaceEditors() {
	|-foreach from=$sources item=source name=for_sources_ajax-|
	new Ajax.InPlaceEditor(
		'name_|-$source->getId()-|',
		'Main.php?do=vialidadSourcesEditFieldX',
		{
			rows: 1,
			size: 35,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			externalControl: 'name_edit_|-$source->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'id=|-$source->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Nombre: ') });
			}
		}
	);
|-/foreach-|
}
function attachCodeInPlaceEditors() {
	|-foreach from=$sources item=source name=for_sources_ajax-|
	new Ajax.InPlaceEditor(
		'code_|-$source->getId()-|',
		'Main.php?do=vialidadSourcesEditFieldX',
		{
			rows: 1,
			size: 6,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			externalControl: 'code_edit_|-$source->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'id=|-$source->getId()-|&paramName=code&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Código: ') });
			}
		}
	);
|-/foreach-|
}
window.onload = function() {
	attachNameInPlaceEditors();
	attachCodeInPlaceEditors();
}

function showInput(to_show, to_hide) {
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
</script>