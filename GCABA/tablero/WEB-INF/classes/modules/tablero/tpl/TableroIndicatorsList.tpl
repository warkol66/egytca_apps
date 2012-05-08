<h2>Tablero de Control</h2>
<h1>Indicadores</h1>
<div id="div_indicators"> 
|-if $message eq "ok"-|
	<div class="successMessage">Indicador guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Indicador eliminado correctamente</div>
|-/if-|
	<table width='100%' border="0" cellpadding='5' cellspacing='0'  class='tableTdBorders' id="tabla-indicators"> 
		<thead> 
		<tr>
			<td colspan="9" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroIndicatorsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="tableroIndicatorsList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr> 
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroIndicatorsEdit" class="addLink">Agregar Indicator</a></div></th> 
			</tr> 
			<tr> 
				<th width="5%" class="thFillTitle">Id</th> 
				<th width="35%" class="thFillTitle">Proyecto</th> 
				<th width="30%" class="thFillTitle">Nombre</th> 
				<th width="5%" class="thFillTitle">Vencimiento</th> 
				<th width="5%" class="thFillTitle">Iniciado</th> 
				<th width="5%" class="thFillTitle">Fecha Inicio </th> 
				<th width="5%" class="thFillTitle">Fecha Fin </th> 
				<th width="5%" class="thFillTitle">Progreso Actual </th> 
				<th width="5%" class="thFillTitle">&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>|-if $indicators|@count eq 0-|
			<tr>
				 <td colspan="9">|-if isset($filters)-|No hay Indicadores que concuerden con la b�squeda|-else-|No hay Indicadores disponibles|-/if-|</td>
			</tr>
		|-else-|
					|-foreach from=$indicators item=indicator name=for_indicators-|
		<tr> 
			<td>|-$indicator->getid()-|</td> 
			<td>|-assign var="project" value=$indicator->getTableroProject()-||-$project->getName()-|</td> 
			<td>|-$indicator->getname()-|</td> 
			<td>|-$indicator->getexpirationDate()|change_timezone|date_format-|</td> 
			<td>|-$indicator->getstarted()-|</td> 
			<td>|-$indicator->getstartDate()|change_timezone|date_format-|</td> 
			<td>|-$indicator->getendDate()|change_timezone|date_format-|</td> 
			<td>|-$indicator->getactualProgress()-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroIndicatorsEdit" /> 
					<input type="hidden" name="id" value="|-$indicator->getid()-|" /> 
					<input type="submit" name="submit_go_edit_indicator" value="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroIndicatorsDoDelete" /> 
					<input type="hidden" name="id" value="|-$indicator->getid()-|" /> 
					<input type="submit" name="submit_go_delete_indicator" value="Borrar" onclick="return confirm('Seguro que desea eliminar el indicator?')" class="icon iconDelete" /> 
				</form></td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="9" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr> 
		|-/if-|
			<tr> 
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroIndicatorsEdit" class="addLink">Agregar Indicator</a></div></th> 
			</tr> 
		|-/if-|
		</tbody> 
		 </table> 
</div>
