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
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>A continuaci&oacute;n podr&aacute; editar las variables de configuración del sistema.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<form method="post" action="Main.php">
	<ul>
		<li id="config"> <a class="a_image" href="#" onclick="javascript:addConfigSection(this.parentNode)"><img src="images/add-folder-green.gif" alt="Agregar Secci&oacute;n" border="0" title="Agregar Secci&oacute;n" /></a>
			<ul id="config_ul">
				|-foreach from=$config item=module name=for_modules key=module_name-|
				<li id="config[|-$module_name-|]"><span class='titulo2'>|-$module_name-|</span> <a class="a_image" href="#" onclick="javascript:addConfigAttribute(this.parentNode)"><img src="images/add-comment-blue.gif" alt="Agregar Atributo" border="0" title="Agregar Atributo" /></a> <a class="a_image" href="#" onclick="javascript:addConfigSection(this.parentNode)"><img src="images/add-folder-green.gif" alt="Agregar Secci&oacute;n" border="0" title="Agregar Secci&oacute;n" /></a> <a class="a_image" href="#" onclick="javascript:deleteConfigAttribute(this.parentNode)"><img src="images/delete-folder-green.gif" alt="Eliminar" border="0" title="Eliminar" /></a>
					<ul id="config[|-$module_name-|]_ul">
						|-include file=config_edit_include.tpl elements=$module name=[$module_name]-|
					</ul>
				</li>
				|-/foreach-|
			</ul>
		</li>
	</ul>
	<input type="hidden" name="do" value="configDoEdit" />
	<input type="submit" value="Guardar" class="boton" />
</form>

<a href="Main.php?do=configView">Ver Config</a>
