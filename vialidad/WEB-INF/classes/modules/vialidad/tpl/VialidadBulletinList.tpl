<h2>Boletines</h2>
<h1>Administración de Boletines Formula Paramétrica</h1>
<p>A continuación se muestra la lista de Boletines cargados en el sistema.</p>
<div id="div_bulletins"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Boletín guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Boletín eliminado correctamente</div>
	|-/if-|
	<table id="table_bulletins" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Boletines</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
				<p>
						<label for="filters[number]">Número</label>
						<input name="filters[number]" type="text" value="|-if isset($filters.number)-||-$filters.number-||-/if-|" size="5" title="Ingrese el número a buscar" />
					</p>
				<p>
						<label for="filters[published]">Publicado</label>
						<select name="filters[published]">
							<option value="" |-if isset($filters.published)-|selected="selected"|-/if-|>Seleccionar</option>
							<option value="0" |-$filters.published|selected:"0"-|>No</option>
							<option value="1" |-$filters.published|selected:"1"-|>Si</option>
						</select>
					</p>
					<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <p><label>Fecha</label>
      </p></td>
    <td valign="top"><p>
						<label for="filters[bulletindate][min]">desde</label>
						<input name="filters[bulletindate][min]" type='text' value='|-if isset($filters.bulletindate.min)-||-$filters.bulletindate.min|date_format-||-/if-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[bulletindate][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
						</p>
						<td valign="top"><p>
						<label for="filters[bulletindate][max]">hasta</label>
						<input name="filters[bulletindate][max]" type='text' value='|-if isset($filters.bulletindate.max)-||-$filters.bulletindate.max|date_format-||-/if-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[bulletindate][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
					</p></td>
  </tr>
</table>
					

					<p>
						<input type="submit" value="Buscar" title="Buscar con los par&aacute;metros ingresados" />
						<input type="hidden" name="do" value="vialidadBulletinList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadBulletinList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "vialidadBulletinEdit"|security_has_access-|
		<tr>
			<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadBulletinEdit" class="addLink">Agregar Boletín</a></div></th>
		</tr>
		|-/if-|
		<tr class="thFillTitle"> 
			<th width="5%">N°</th> 
			<th width="85%">Mes</th> 
			<th width="5%">Publicado</th> 
			<th width="5%">&nbsp;</th> 
		</tr> 
		</thead> 
		<tbody>
		|-if $bulletins|@count eq 0-|
		<tr>
			<td colspan="4">|-if isset($filters)-|No hay Boletines que concuerden con la búsqueda|-else-|No hay Boletines disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$bulletins item=bulletin name=for_bulletins-|
		<tr> 
			<td align="center">|-$bulletin->getNumber()-|</td>
			<td>|-$bulletin->getBulletindate()|date_format:"%B / %Y"|@ucfirst-|</td>
			<td align="center">|-$bulletin->getPublished()|si_no-|</td>
			<td nowrap>
				|-if "vialidadBulletinEdit"|security_has_access-|
				<form action="Main.php" method="get">
					<input type="hidden" name="do" value="vialidadBulletinEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$bulletin->getid()-|" />
					<input type="submit" name="submit_go_edit_vialidad_bulletin" value="Editar" title="Editar" class="icon iconEdit" />
				</form>
				|-/if-|
				|-if "vialidadBulletinDoDelete"|security_has_access-|
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="vialidadBulletinDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$bulletin->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_bulletin" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Boletín?')" class="icon iconDelete" />
				</form>
				|-/if-|
					<a href="Main.php?do=vialidadBulletinEdit&id=|-$bulletin->getid()-|&toPrint=true" target="_blank" tilte="Imprimir"><img src="images/clear.png" class="icon iconPrint" /></a>
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<tr>
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
		</tr>
		|-/if-|
		|-if "vialidadBulletinEdit"|security_has_access-|
		<tr>
			<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadBulletinEdit" class="addLink">Agregar Boletín</a></div></th>
		</tr>
		|-/if-|
		</tbody> 
	</table> 
</div>

<script type="text/javascript">

function copyItem(form) {
	var fields = Form.serialize(form);
	new Ajax.Updater(
		{success: 'items_table_body'},
		'Main.php?do=vialidadConstructionsAddItemFromOtherX',
		{
			method: 'post',
			parameters: fields,
			insertion: 'bottom',
			evalScripts: true
		}
	);
}

</script>