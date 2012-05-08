|-if !$result-|<h2>Tablero de Gestión</h2>
<h1>Administración de Misiones</h1>
<p>A continuación se muestra la lista de Misiones cargadas en el sistema.</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Misión guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Misión eliminada correctamente</div>
	|-/if-|
|-else-|
	|-assign var=pager value=$result-|
	|-assign var=missions value=$pager->getResult()-|
	<h1>Misiones</h1> 
|-/if-|
<div id="div_missions"> 
	<table id="tabla-missions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
<thead> |-if !$result-|		
		<tr>
			<td colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de misiones</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelMissionList" />
					Texto a buscar: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />

					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="panelMissionList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=panelMissionEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Misión</a></div></th>
			</tr>
|-/if-|


			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="5%">Fechas</th> 
				<th width="20%">Préstamo</th> 
				<th width="10%">Tipo</th> 
				<th width="30%">Descripción</th> 
				<th width="30%">Participantes</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $missions|@count eq 0-|
		<tr>
			 <td colspan="6">|-if isset($filter)-|No hay misiones que concuerden con la búsqueda|-else-|No hay misiones disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$missions item=mission name=for_missions-|
		<tr> 
	<!--		<td>|-$mission->getid()-|</td> -->
			<td align="center">|-$mission->getStartDate()|date_format:"%d-%m-%Y"-| al |-$mission->getFinishDate()|date_format:"%d-%m-%Y"-|</td> 
			<td>|-assign var=policyGuideline value=$mission->getPolicyGuideline()-| |-$policyGuideline->getName()-|</td>
			<td>|-$mission->getTypeTranslated()-|</td> 
			<td>|-$mission->getDescription()-|</td> 
			<td>|-foreach from=$mission->getMissionParticipants() item=party name=for_parties-|<ul>
     |-if $party->getObject() != NULL-||-assign var=partyObject value=$party->getObject()-||-$partyObject->getName()-| |-$partyObject->getSurname()-||-if $party->getObjectType() eq 'Actor' && $partyObject->getInstitution() ne ''-| (|-$partyObject->getInstitution()-|)|-/if-||-/if-|<ul>
    |-/foreach-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="panelMissionEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mission->getid()-|" /> 
					<input type="submit" name="submit_go_edit_mission" value="Editar" class="icon iconEdit" /> 
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelMissionDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mission->getid()-|" /> 
					<input type="submit" name="submit_go_delete_mission" value="Borrar" onclick="return confirm('Seguro que desea eliminar esta misión?')" class="icon iconDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelMissionDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mission->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_mission" value="Borrar" onclick="return confirm('Seguro que desea eliminar esta misión definitivamente?')" class="icon iconDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="6" class="thFillTitle">|-if $missions|@count gt 5-|<div class="rightLink"><a href="Main.php?do=panelMissionEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Misión</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
