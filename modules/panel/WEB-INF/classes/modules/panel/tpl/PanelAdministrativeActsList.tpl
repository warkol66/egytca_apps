<h2>Tablero de Gestión</h2>
<h1>Administración de Actos Administrativos</h1>
<p>A continuación se muestra la lista de Actos Administrativos cargados en el sistema.</p>
<div id="div_administrativeActs"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Acto Administrativo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Acto Administrativo eliminado correctamente</div>
	|-/if-|
	<table id="tabla-administrativeActs" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="8" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de actos administrativos</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelAdministrativeActsList" />
					Texto a buscar: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />

					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="panelAdministrativeActsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="8" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=panelAdministrativeActsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Acto Administrativo</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="5%">Fecha</th> 
				<th width="5%">##objectives,1,Eje de Gestión##</th> 
				<th width="15%">##projects,1,Proyecto##</th> 
				<th width="15%">Objeto</th> 
				<th width="10%">Tipo</th> 
				<th width="20%">Descripción</th> 
				<th width="20%">Participantes</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $administrativeActs|@count eq 0-|
		<tr>
			 <td colspan="8">|-if isset($filter)-|No hay actos administrativos que concuerden con la búsqueda|-else-|No hay actos administrativos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$administrativeActs item=administrativeAct name=for_administrativeActs-|
		<tr> 
	<!--		<td>|-$administrativeAct->getid()-|</td> -->
			<td>|-$administrativeAct->getActDate()|date_format:"%d-%m-%Y"-|</td> 
			<td>|-$administrativeAct->getPolicyGuidelineName()-|</td>
			<td>|-$administrativeAct->getProjectName()-|</td>
			<td>|-$administrativeAct->getObject()-|</td> 
			<td>|-$administrativeAct->getTypeTranslated()-|</td> 
			<td>|-$administrativeAct->getDescription()-|</td> 
			<td> |-if  $administrativeAct->getAdminActParticipants()|@count gt 0-| <ul class="inTable">  |-foreach from=$administrativeAct->getAdminActParticipants() item=party name=for_parties-|
    <li id="partyListItem|-$party->getId()-|">
     |-$party->getTitle()-| |-$party->getName()-| |-$party->getSurname()-| |-if $party->getInstitution() ne ''-|<em>(|-$party->getInstitution()-|)|-/if-|</em>
    </li> 
    |-/foreach-|</ul>|-/if-|
</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="panelAdministrativeActsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$administrativeAct->getid()-|" /> 
					<input type="submit" name="submit_go_edit_administrativeAct" value="Editar" class="buttonImageEdit" /> 
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelAdministrativeActsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$administrativeAct->getid()-|" /> 
					<input type="submit" name="submit_go_delete_administrativeAct" value="Borrar" onclick="return confirm('Seguro que desea eliminar este acto?')" class="buttonImageDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelAdministrativeActsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$administrativeAct->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_administrativeAct" value="Borrar" onclick="return confirm('Seguro que desea eliminar este acto definitivamente?')" class="buttonImageDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="8" class="thFillTitle">|-if $administrativeActs|@count gt 5-|<div class="rightLink"><a href="Main.php?do=panelAdministrativeActsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Acto Administrativo</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
