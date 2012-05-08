<fieldset title="Actos administrativos asociados al ##projects,4,proyecto##">
	<legend>Actos Administrativos</legend>
	<table id="tabla-administrativeActs" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr>
				 <th colspan="6" class="thFillTitle"> </th>
			</tr>
			<tr class="thFillTitle"> 
				<th width="5%">Fecha</th> 
				<th width="20%">Objeto</th> 
				<th width="10%">Tipo</th> 
				<th width="20%">Descripción</th> 
				<th width="20%">Participantes</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $administrativeActs|@count eq 0-|
		<tr>
			 <td colspan="6">No hay actos administrativos disponibles</td>
		</tr>
	|-else-|
		|-foreach from=$administrativeActs item=administrativeAct name=for_administrativeActs-|
		<tr> 
			<td>|-$administrativeAct->getActDate()|date_format:"%d-%m-%Y"-|</td> 
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
					<input type="submit" name="submit_go_edit_administrativeAct" value="Editar" class="icon iconEdit" /> 
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelAdministrativeActsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$administrativeAct->getid()-|" /> 
					<input type="submit" name="submit_go_delete_administrativeAct" value="Borrar" onclick="return confirm('Seguro que desea eliminar este acto?')" class="icon iconDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelAdministrativeActsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$administrativeAct->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_administrativeAct" value="Borrar" onclick="return confirm('Seguro que desea eliminar este acto definitivamente?')" class="icon iconDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-/if-|
		</tbody> 
		 </table> 
</fieldset>