<h2>Configuración del Sistema</h2>
	<h1>Editar Formularios</h1>
	<p>A continuación podrá administrar los Formularios ingresados en el sistema.</p>
|-if $message eq "ok"-|
<div class="successMessage">Cambios guardados satisfactoriamente</div>
|-elseif $message eq "deleted_ok"-|
<div class="successMessage">Formulario eliminado satisfactoriamente</div>
|-elseif $message eq "not_deleted"-|
<div class="errorMessage">No se pudo eliminar el formulario</div>
|-/if-|

|-if $forms|count gt 0-|
<table class="tableTdBorders" width="100%" border="0" cellspacing="1" cellpadding="5">
	|-if "profilesFormEdit"|security_has_access-|
	<tr>
		<th colspan="5"><div class="rightLink"><a href="Main.php?do=profilesFormEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Formulario</a></div></th>
	</tr>
	|-/if-|
	<tr>
		<th width="25%">Formulario</th>
		<th width="60%">Descripción</th>
		<th width="5%">Relaciones</th>
		<th width="5%">&nbsp;</th>
		<th width="5%" nowrap>Preguntas</th>
	</tr>
	|-foreach from=$forms item=form name=for_forms-|
	<tr>
		<td>|-$form->getName()-|</td>
		<td>|-$form->getDescription()-|</td>
		<td align="center">|-$form->getRelationship()|si_no-|</td>
		<td nowrap><a href="Main.php?do=profilesFormEdit&id=|-$form->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" title="Editar"><img src="images/clear.png" class="icon iconEdit" /></a>
			<a href="Main.php?do=profilesFormDoDelete&id=|-$form->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" title="Eliminar" onclick="return confirm('##116,Esta opción eliminar permanentemente a este Formulario\n¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete" /></a></td>
		<td align="center" nowrap><a href="Main.php?do=profilesFormQuestionEdit&id=|-$form->getId()-|" title="Editar Questionario"><img src="images/clear.png" class="icon iconListEdit" /></a></td>
	</tr>
	|-/foreach-|
</table>
|-/if-| 