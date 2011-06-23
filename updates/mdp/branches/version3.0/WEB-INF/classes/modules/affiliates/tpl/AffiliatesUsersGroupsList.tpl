<h2>##40,Configuración del Sistema##</h2>
	<h1>##178,Administración de Grupos de Usuarios##</h1>
	<p>##179,A continuación podrá editar la lista de grupos de usuarios, permitiendo, al editar el grupo, modificar las categorías que pueden acceder los usuarios miembros del grupo.##</p>
|-if $message eq "deleted"-|
<div align='center' class='successMessage'>##181,Grupo de Usuarios eliminado##</div>
|-/if-|
|-if $message eq "saved"-|
<div align='center' class='successMessage'>##183,Grupo de Usuarios guardado##</div>
|-/if-|

<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
    <tr class="thFillTitle">
		<th colspan="8"><div class="rightLink"><a href="Main.php?do=affiliatesUsersGroupsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##affiliates,1,Afiliado##</a></div></th>
	</tr>
	<tr>
		<th width="90%" nowrap="nowrap">##194,Grupo de Usuarios del Sistema ##</th>
		<th width="10%" nowrap="nowrap">&nbsp;</th>
	</tr>
	|-foreach from=$groups item=group name=for_groups-|
	<tr>
		<td class='celldato'><div class='titulo2'>|-$group->getName()-|</div></td>
		<td width="1%" nowrap>
			<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesUsersGroupsEdit" /> 
			  <input type="hidden" name="id" value="|-$group->getId()-|" /> 
			  <input type="submit" name="submit_go_edit_affiliate_group" title="Editar" value="Editar" class="icon iconEdit" /> 
			</form>
			<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesUsersGroupsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$group->getId()-|" /> 
			  <input type="submit" name="submit_go_delete_affiliate_group" value="Borrar" title="Eliminar" class="icon iconDelete" onclick="return confirm('Seguro que desea eliminar el grupo de usuario?')"  /> 
			</form>
		</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>							
	|-/if-|
    <tr class="thFillTitle">
		<th colspan="8"><div class="rightLink"><a href="Main.php?do=affiliatesUsersGroupsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##affiliates,1,Afiliado##</a></div></th>
	</tr>
</table>
