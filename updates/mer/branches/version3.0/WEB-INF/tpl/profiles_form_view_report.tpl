<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="titulo">##197,Caracterización de Actores##</td>
	</tr>
	<tr>
		<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="fondotitulo">##198,Edición de Perfiles##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	<tr>
		<td class="texto">##201,Ingrese la información de caracterización del Actor## <strong>&quot;|-$actor->getName()-|&quot;</strong>.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tr>
		<th colspan="2">##202,Caracterización de## |-$actor->getName()-|</th>
	</tr>
	|-foreach from=$forms item=form -|
	|-if $form->getRootSection()-|
	|-include file=profiles_form_view_section.tpl section=$form->getRootSection() -|
	|-/if-|
	|-/foreach-|
	</tr>
	<tr>
		<td colspan="2" class="tablebottom"><img src="index.php_files/clear.gif" height="1" width="1"></td>
	</tr>
</table>
