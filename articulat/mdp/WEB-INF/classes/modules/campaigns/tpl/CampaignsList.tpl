|-if !$result-|<h2>Campañas</h2>
<h1>Administración de Campañas</h1>
<p>A continuación se muestra la lista de Campañas cargadas en el sistema.</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Campaña guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Campaña eliminada correctamente</div>
	|-/if-|
|-else-|
	|-assign var=pager value=$result-|
	|-assign var=campaigns value=$pager->getResult()-|
	<h1>Campañas</h1> 
|-/if-|
<div id="div_campaigns">
	<table id="tabla-campaigns" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
<thead> |-if !$result-|		
		<tr>
			<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de campañas</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="campaignsList" />
					Texto a buscar: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />

					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="campaignsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=campaignsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Campaña</a></div></th>
			</tr>
|-/if-|


			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="5%">Fechas</th> 
				|-if class_exists('Client')-|<th width="10%">Cliente</th> |-/if-|
				<th width="10%">Tipo</th> 
				<th width="10%">Nombre</th> 
				<th width="30%">Descripción</th> 
				<th width="30%">Participantes</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $campaigns|@count eq 0-|
		<tr>
			 <td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">|-if isset($filter)-|No hay campañas que concuerden con la búsqueda|-else-|No hay campañas disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$campaigns item=campaign name=for_campaigns-|
		<tr> 
	<!--		<td>|-$campaign->getid()-|</td> -->
			<td align="center">|-$campaign->getStartDate()|date_format:"%d-%m-%Y"-| al |-$campaign->getFinishDate()|date_format:"%d-%m-%Y"-|</td> 
			|-if class_exists('Client')-|<td>|-$campaign->getClient()-|</td>|-/if-|
			<td>|-$campaign->getTypeTranslated()-|</td> 
			<td>|-$campaign->getName()-|</td> 
			<td>|-$campaign->getDescription()-|</td> 
			<td>|-foreach from=$campaign->getCampaignParticipants() item=party name=for_parties-|<ul>
     |-if $party->getObject() != NULL-||-assign var=partyObject value=$party->getObject()-||-$partyObject->getName()-| |-$partyObject->getSurname()-||-if $party->getObjectType() eq 'Actor' && $partyObject->getInstitution() ne ''-| (|-$partyObject->getInstitution()-|)|-/if-||-/if-|<ul>
    |-/foreach-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="campaignsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$campaign->getid()-|" /> 
					<input type="submit" name="submit_go_edit_campaign" value="Editar" class="icon iconEdit" title="Editar" /> 
				</form>
					|-if $campaign->getTwitterCampaign()-|
					<input type="button" name="obtain_headlines" value="Obtener Tweets" title="Obtener Tweets" onclick="location.href='Main.php?do=twitterParsedList&filters[campaignId]=|-$campaign->getId()-|'" class="icon iconTwitterAdd" />
					<input type="button" name="obtain_headlines" value="Generar reporte" title="Generar reporte" onclick="location.href='Main.php?do=twitterCampaignsReportView&id=|-$campaign->getId()-|'" class="icon iconPrint" />
					|-else-|
					<input type="button" name="obtain_headlines" value="Obtener Titulares" title="Obtener Titulares" onclick="location.href='Main.php?do=headlinesParsedList&filters[campaignId]=|-$campaign->getId()-|'" class="icon iconNewsAdd" /> 
					<input type="button" name="obtain_headlines" value="Generar reporte" title="Generar reporte" onclick="location.href='Main.php?do=campaignsEdit&report=1&id=|-$campaign->getId()-|'" class="icon iconPrint" />
					|-/if-|
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="campaignsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$campaign->getid()-|" /> 
					<input type="submit" name="submit_go_delete_campaign" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar esta campaña?')" class="icon iconDelete" /> 
			</form>
			|-/if-|
			</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr class="thFillTitle">
				 <th colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">|-if $campaigns|@count gt 5-|<div class="rightLink"><a href="Main.php?do=campaignsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Campaña</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
