<h2>Configuración del Sistema</h2>
	<h1>Editar Formularios</h1>
	<p>A continuación podrá administrar los Formularios ingresados en el sistema.</p>
|-if $forms|count gt 0-|
<table class="tableTdBorders" width="100%" border="0" cellspacing="1" cellpadding="5">
	|-if "profilesFormEdit"|security_has_access-|
	<tr>
		<th colspan="4"><div class="rightLink"><a href="Main.php?do=profilesFormEdit&createForm=1|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Formulario</a></div></th>
	</tr>
	|-/if-|
	<tr>
		<th width="40%">Formulario</th>
		<th width="50%">Descripción</th>
		<th width="5%">Relaciones</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$forms item=form name=for_forms-|
	<tr valign="top">
		<td>|-$form->getName()-|</td>
		<td>&nbsp;</td>
		<td align="center">|-$form->getRelationship()|si_no-|</td>
		<td nowrap><a href="Main.php?do=profilesFormEdit&form=|-$form->getId()-|" title="Editar"><img src="images/clear.png" class="icon iconEdit" /></a>
			<a href="Main.php?do=profilesFormDoDelete&form=|-$form->getId()-|" title="Eliminar" onclick="return confirm('##116,Esta opción eliminar permanentemente a este Formulario\n¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete" /></a></td>
	</tr>
	|-/foreach-|
</table>
|-/if-| 