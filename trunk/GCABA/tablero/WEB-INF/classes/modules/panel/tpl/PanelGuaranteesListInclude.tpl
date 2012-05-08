	<table id="tabla-guarantees" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr>
				 <th colspan="7" class="thFillTitle">Garantías vencidas o con vencimiento en los proximos 30 días</th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="5%">Fecha</th> 
				<th width="5%">Préstamo</th> 
				<th width="20%">Proyecto</th> 
				<th width="20%">Contratista</th> 
				<th width="10%">Emisor</th> 
				<th width="5%">Monto</th> 
				<th width="15%">Vencimiento</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $result|@count eq 0-|
		<tr>
			 <td colspan="7">|-if isset($filter)-|No hay garantías que concuerden con la búsqueda|-else-|No hay garantías disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$result item=guarantee name=for_guarantees-|
		<tr> 
	<!--		<td>|-$guarantee->getid()-|</td> -->
			<td>|-$guarantee->getIssueDate()|date_format:"%d-%m-%Y"-|</td> 
			<td>|-$guarantee->getPolicyGuidelineName()-|</td>
			<td>|-$guarantee->getProjectName()-|</td>
			<td>|-$guarantee->getContractorName()-|</td> 
			<td>|-$guarantee->getIssuer()-|</td> 
			<td>|-$guarantee->getCurrencyName()-| |-$guarantee->getAmmount()|number_format:2:',':'.'-|</td> 
			<td>|-$guarantee->getExpirationDate()|date_format-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="panelGuaranteesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$guarantee->getid()-|" /> 
					<input type="submit" name="submit_go_edit_guarantee" value="Editar" class="icon iconEdit" /> 
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelGuaranteesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$guarantee->getid()-|" /> 
					<input type="submit" name="submit_go_delete_guarantee" value="Borrar" onclick="return confirm('Seguro que desea eliminar la garantía?')" class="icon iconDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelGuaranteesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$guarantee->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_guarantee" value="Borrar" onclick="return confirm('Seguro que desea eliminar la garantía definitivamente?')" class="icon iconDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-/if-|
		</tbody> 
	 </table> 
