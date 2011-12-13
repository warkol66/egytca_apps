<h2>Configuración del Sistema</h2>
<h1>Mantenimiento de HTML</h1>
<p>Listado de archivos de HTML plano disponibles en el sistema</p>
|-if $message eq "deleted_ok"-|
	<div class='successMessage'>HTML eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div class='errorMessage'>No se pudo eliminar el HTML</div>
|-/if-|
<table class="tableTdBorders" cellpadding="5" cellspacing="0" width="100%">
	|-if "htmlsEdit"|security_has_access-|
	<tr>
		<th colspan="2"><div class="rightLink"><a href="Main.php?do=htmlsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar HTML</a></div></th>
	</tr>
	|-/if-|
	<tr>
	<th width="95%">Nombre</th><th width="5%"></th>
	</tr>
|-foreach from=$htmlFiles item=htmlFile name=for_htmlsFiles-|
		<tr>
			<td>|-$htmlFile.name-||-if $htmlFile.external-|*|-/if-|</td><td nowrap="nowrap">
			<a href="Main.php?do=htmlsShow&name=|-$htmlFile.name-|" target="_blank"><img src="images/clear.png" class="icon iconView" /></a>
			  <form method='post' action="Main.php">
			<input name="fileName" type="hidden" value="|-$htmlFile.fileName-|" />
			<input name="do" type="hidden" value="htmlsDoDelete" />
			<input name="delete" type="submit" class="icon iconDelete">
			</form>
			</td>
		</tr>
|-/foreach-| 
</table>
