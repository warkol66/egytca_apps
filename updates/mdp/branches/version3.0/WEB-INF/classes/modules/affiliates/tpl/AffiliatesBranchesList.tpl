<h2>##affiliates,5,Sucursales##</h2> 
<h1>Administración de ##affiliates,5,Sucursales##</h1> 
<p>A continuación podrá editar la información de ##affiliates,5,Sucursales##.</p> 
<div id="div_branches">
|-if $message eq "ok"-|
	<div class="successMessage">Cambios guardados correcamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Registro eliminado correctamente</div>
|-/if-|

	<table width="100%" border="0" cellpadding="5" cellspacing="0" id="tabla-branches" class="tableTdBorders"> 
		<thead> 
|-if $affiliates|@count gt 0-|			<tr>
				<th colspan="8" class="tdSearch">
		<form action="Main.php" method="get"> 
				<label for="filters[searchAffiliateId]">##affiliates,3,Afiliado##:</label> 
				<select name="filters[searchAffiliateId]"  onchange="this.form.submit();" title="Filtrar ##affiliates,5,Sucursales## por ##affiliates,3,Afiliado##"> 
					<option value="">Todos</option> 
					|-foreach from=$affiliates item=affiliate-|
					<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $filters.searchAffiliateId-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option> 
					|-/foreach-|
				</select>
				<input type="hidden" name="do" value="affiliatesBranchesList" /> 
				<input type="submit" value="Buscar" /> 
				|-if $filters.searchAffiliateId gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=affiliatesBranchesList';" />|-/if-|</p>
		</form> 
</th>
			</tr>|-/if-|
			<tr>
				<th colspan="8"><div class="rightLink"><a href="Main.php?do=affiliatesBranchesEdit" class="addLink">Agregar ##affiliates,4,Sucursal##</a></div></th>
			</tr>
			<tr> 
				<th width="20%">Afiliado</th> 
				<th width="5%">Nro.</th> 
				<th width="5%">Código</th>
				<th width="15%">Sucursal</th> 
				<th width="10%">Teléfono</th> 
				<th width="10%">Contacto</th> 
				<th width="30%">Memo</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>  |-foreach from=$branches item=branch name=for_branches-|
		<tr> 
			<td>|-$branch->getAffiliate()-|</td> 
			<td>|-$branch->getnumber()-|</td> 
      <td>|-$branch->getCode()-|</td> 
			<td>|-$branch->getname()-|</td> 
			<td>|-$branch->getphone()-|</td> 
			<td>|-$branch->getcontact()-||-if $branch->getcontactEmail() ne ''-|, email: |-$branch->getcontactEmail()-||-/if-|</td> 
			<td>|-$branch->getmemo()-|</td> 
			<td class="tdSize1 center" nowrap="nowrap"> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="affiliatesBranchesEdit" /> 
					<input type="hidden" name="id" value="|-$branch->getid()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="submit" name="submit_go_edit_branch" value="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="affiliatesBranchesDoDelete" /> 
					<input type="hidden" name="id" value="|-$branch->getid()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="submit" name="submit_go_delete_branch" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar este registro?')" class="icon iconDelete" /> 
			</form></td> 
		</tr> 
		|-/foreach-|
	|-if isset($pager) && $pager->getTotalPages() gt 1-|
	<tr>
		<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td>
	</tr>
	|-/if-|						
			<tr>
				<th colspan="8"><div class="rightLink"><a href="Main.php?do=affiliatesBranchesEdit" class="addLink">Agregar ##affiliates,4,Sucursal##</a></div></th>
			</tr>
		</tbody> 
	</table> 
</div>
