 <h1>Mediciones</h1>
<div id="div_measures"> 
|-if $message eq "ok"-|
	<div class="successMessage">Measure guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Measure eliminado correctamente</div>
|-/if-|
	<table width='100%' border="0" cellpadding='5' cellspacing='0'  class='tableTdBorders' id="tabla-measures"> 
		<thead> 
		<tr>
			<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filter|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroMeasuresList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filter.searchString)-||-$filter.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="tableroMeasuresList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMeasuresEdit" class="addLink">Agregar Medición</a></div></th>
			</tr>
			<tr> 
				<th width="5%" class="thFillTitle">Id</th> 
				<th width="65%" class="thFillTitle">Indicador</th> 
				<th width="5%" class="thFillTitle">Fecha</th> 
				<th width="10%" class="thFillTitle">Medici&oacute;n</th> 
				<th width="10%" class="thFillTitle">Medici&oacute;n Esperada </th> 
				<th width="5%" class="thFillTitle">&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>|-if $measures|@count eq 0-|
			<tr>
				 <td colspan="7">|-if isset($filter)-|No hay Mediciones que concuerden con la búsqueda|-else-|No hay mediciones disponibles|-/if-|</td>
			</tr>
		|-else-|
		  |-foreach from=$measures item=measure name=for_measures-|
		<tr> 
			<td>|-$measure->getid()-|</td> 
			<td>|-assign var='indicator' value=$measure->getTableroIndicator()-||-$indicator->getName()-|</td> 
			<td>|-$measure->getmeasureDate()|change_timezone|date_format-|</td> 
			<td>|-$measure->getmeasureNumber()-|</td> 
			<td>|-$measure->getmeasureExpectedNumber()-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroMeasuresEdit" /> 
					<input type="hidden" name="id" value="|-$measure->getid()-|" /> 
					<input type="submit" name="submit_go_edit_measure" value="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroMeasuresDoDelete" /> 
					<input type="hidden" name="id" value="|-$measure->getid()-|" /> 
					<input type="submit" name="submit_go_delete_measure" value="Borrar" onclick="return confirm('Seguro que desea eliminar el measure?')" class="icon iconDelete" /> 
			</form></td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr> 
		|-/if-|
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMeasuresEdit" class="addLink">Agregar Medición</a></div></th>
			</tr>
		|-/if-|
		</tbody> 
  </table> 
</div>
