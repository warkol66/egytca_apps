<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>Configuración del Sistema</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Variables de Configuración del Sistema</td>
	</tr>
|-if $message eq "ok"-|	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			Configuración Guardada!  </td>
	</tr>|-/if-|
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>A continuación podrá ver las variables de configuración del sistema.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<ul>
	|-foreach from=$config item=module name=for_modules key=name-|
	<li><span class='titulo2'>|-$name-|</span></li>
	<ul>
		|-include file=config_view_include.tpl elements=$module-|
	</ul>
	</li>
	|-/foreach-|
</ul>
<br />
<a href="Main.php?do=configEdit">Editar Config</a>