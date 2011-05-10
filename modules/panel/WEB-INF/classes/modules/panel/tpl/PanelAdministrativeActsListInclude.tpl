	<table id="tabla-administrativeActs" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr>
				 <th colspan="8" class="thFillTitle">Actos administrativos más recientes</th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="5%">Fecha</th> 
				<th width="5%">Préstamo</th> 
				<th width="15%">##projects,1,Proyecto##</th> 
				<th width="15%">Objeto</th> 
				<th width="10%">Tipo</th> 
				<th width="20%">Descripción</th> 
				<th width="20%">Participantes</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $result|@count eq 0-|
		<tr>
			 <td colspan="8">|-if isset($filter)-|No hay actos administrativos que concuerden con la búsqueda|-else-|No hay actos administrativos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$result item=administrativeAct name=for_administrativeActs-|
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
		|-/if-|
		</tbody> 
		 </table> 
