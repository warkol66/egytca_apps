<h2>Insumos</h2>
<h1>Administraci&oacute;n de Insumos</h1>
<p>A continuaci&oacute;n se muestra la lista de Insumos cargados en el sistema.</p>
<div id="div_supplies"> 
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="2" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">B&uacute;squeda de Insumos </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p>Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" /></p>
					<p>Resultados por página |-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|</p>
					<p>
						<input type="submit" value="Buscar" title="Buscar con los par&aacute;metros ingresados" />
						<input type="hidden" name="do" value="vialidadSupplyList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadSupplyList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "vialidadSupplyEdit"|security_has_access-|
		<tr>
			<th colspan="2" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="showInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Insumo</a>
					<form id="addInput1" action="Main.php" method="POST" onsubmit="prepareAndSubmit(this); showInput('addLink1', 'addInput1'); return false;" style="display: none;">
						<label>Ingrese nombre del tipo:</label>
						<input type="text"   name="name" />
						<input type="hidden" name="do" value="vialidadSupplyDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="showInput('addLink1', 'addInput1');" />
					</form>
				</div>
			</th>
		</tr>
		|-/if-|
		
		<tr class="thFillTitle"> 
			<th width="95%">Nombre</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
	
		<tbody id="suppliesList">
		|-if $supplies|@count eq 0-|
		<tr>
			<td colspan="2">|-if isset($filter)-|No hay Insumos que concuerden con la b&uacute;squeda|-else-|No hay Insumos disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$supplies item=supply name=for_supples-|
		<tr> 
			<td>
				|-if "vialidadSupplyEdit"|security_has_access-|
				<span id="supply_|-$supply->getId()-|" class="in_place_editable">|-$supply->getName()|escape-|</span>
				|-else-|
				|-$supply->getName()|escape-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "vialidadSupplyEdit"|security_has_access-|
					<input type="hidden" name="do" value="vialidadSupplyEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$supply->getid()-|" />
					<input type="submit" id="supply_edit_|-$supply->getId()-|" name="submit_go_edit_vialidad_supply" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "vialidadSupplyDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSupplyDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$supply->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_supply" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Insumo?')" class="icon iconDelete" />
				</form>
					
				|-if isset($loginUser) && $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSupplyDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$supply->getid()-|" />
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_vialidad_supply" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el Insumo definitivamente?')" class="icon iconHardDelete" /> 
				</form>
				|-/if-|
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		</tbody>
		<tfoot>
		|-if "vialidadSupplyEdit"|security_has_access-|
		<tr>
			<th colspan="2" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="showInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Insumo</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="prepareAndSubmit(this); showInput('addLink2', 'addInput2'); return false;" style="display: none;">
						<label>Ingrese nombre del tipo:</label>
						<input type="text"   name="name" />
						<input type="hidden" name="do" value="vialidadSupplyDoEditX" />
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

Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});

window.onload = function() {
|-foreach from=$supplies item=supply name=for_supplies_ajax-|
	new Ajax.InPlaceEditor(
		'supply_|-$supply->getId()-|',
		'Main.php?do=vialidadSupplyEditFieldX',
		{
			rows: 1,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			externalControl: 'supply_edit_|-$supply->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'id=|-$supply->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
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

function showInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}

function prepareAndSubmit(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
		{ success: 'suppliesList' },
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