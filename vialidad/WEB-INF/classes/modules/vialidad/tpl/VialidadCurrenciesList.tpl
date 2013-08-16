<h2>Monedas</h2>
<h1>Administración de Monedas</h1>
<p>A continuación se muestra la lista de Monedas cargadas en el sistema.</p>
<div id="div_currencies"> 
	|-if $message eq "deleted_ok"-|
		<div class="successMessage">Moneda eliminada correctamente</div>
	|-/if-|
	<div name="working_status_message" style="display:none;" class="inProgress">Trabajando...</div>
	<div name="done_status_message" style="display:none;" class="successMessage">Moneda agregada</div>
	<table id="table_currencies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<!--<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Monedas </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p><label>Texto</label><input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
						<input type="hidden" name="do" value="vialidadCurrenciesList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadCurrenciesList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr> -->
		
		|-if "vialidadCurrenciesEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="toggleInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Moneda</a>
					<form id="addInput1" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink1', 'addInput1'); setStatus('done'); reset(this); return false;" style="display: none;">
						<label>Nombre de la moneda</label>
						<input type="text" name="params[name]" />
						<label for="name[code]">Código</label>
						<input type="text"  name="params[code]" />
						<input type="hidden" name="do" value="vialidadCurrenciesDoEditX" />
						<input type="submit" value="Guardar" class="icon iconActivate" />
						<input type="button" value="Cancelar" class="icon iconCancel" onclick="toggleInput('addLink1', 'addInput1');" />
					</form>
				</div>
			</th>
		</tr>
		|-/if-|
		
		<tr class="thFillTitle"> 
			<th width="60%">Moneda</th>
			<th width="35%">C&oacute;digo</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
	
		<tbody id="currenciesList">
		|-if $currencyColl|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filter)-|No hay Monedas que concuerden con la búsqueda|-else-|No hay Monedas disponibles|-/if-|</td>
		</tr>
		|-else-|

|-include file="VialidadCurrenciesListInclude.tpl"-|

	|-/if-|
		
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		</tbody>
		<tfoot>
		|-if "vialidadCurrenciesEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle">
				<div class="rightLink">
					<a href="#" onclick="toggleInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Moneda</a>
					<form id="addInput2" action="Main.php" method="POST" onsubmit="setStatus('working'); prepareAndSubmit(this); toggleInput('addLink2', 'addInput2'); setStatus('done'); reset(this); return false;" style="display: none;">
						<label>Nombre de la moneda</label>
						<input type="text" name="params[name]" />
						<label for="name[code]">Código</label>
						<input type="text"  name="params[code]" />
						<input type="hidden" name="do" value="vialidadCurrenciesDoEditX" />
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
function toggleInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}
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
function prepareAndSubmit(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
		{ success: 'currenciesList' },
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
function clean(value) {
	var aux;
	aux = value.replace(/---\s/, '');
	return aux.replace(/\s---$/, '');
}
</script>
