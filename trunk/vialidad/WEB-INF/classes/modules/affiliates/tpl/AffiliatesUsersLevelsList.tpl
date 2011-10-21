<h2>##40,Configuración del Sistema##</h2>
<h1>Administración de Niveles de Usuarios</h1>
<p>A continuación podrá ver la lista de niveles de usuarios.</p>
|-if $message eq "deleted"-|
<div class="successMessage">##181,Nivel de Usuarios eliminado##</div>
|-elseif $message eq "saved"-|
<div class="successMessage">##183,Nivel de Usuarios guardado##</div>
|-/if-|
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
	<tr>
		<th colspan="2"><div class="rightLink"><a href="Main.php?do=affiliatesUsersLevelsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Nivel</a></div></th>
	</tr>
	<tr>
		<th width="90%" nowrap="nowrap">##194,Niveles de Usuarios del Sistema ##</th>
		<th width="10%" nowrap="nowrap">&nbsp;</th>
	</tr>
	|-foreach from=$levels item=level name=for_levels-|
	<tr>
		<td>|-$level->getName()-|</td>
		<td width="1%" nowrap>
			<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesUsersLevelsEdit" /> 
			  <input type="hidden" name="id" value="|-$level->getId()-|" /> 
			  <input type="submit" name="submit_go_edit_affiliate" title="Editar" value="Editar" class="icon iconEdit" /> 
			</form>
			<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesUsersLevelsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$level->getId()-|" /> 
			  <input type="submit" name="submit_go_delete_affiliate" value="Borrar" title="Eliminar" class="icon iconDelete" onclick="return confirm('Seguro que desea eliminar el nivel de usuario?')"  /> 
			</form>
		</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>							
	|-/if-|
    <tr>
		<th colspan="2"><div class="rightLink"><a href="Main.php?do=affiliatesUsersLevelsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Nivel</a></div></th>
	</tr>
</table>
