<h2>##common,18,Configuración del Sistema##</h2>
<h1>Variables de Configuración del Sistema</h1>
<p>A continuación podrá editar las variables de configuración del sistema.</p>
<!-- BOX VARIABLES ------------------------------->
<div id="boxVariables">
<form method="post" action="Main.php">
	<ul>
		<li id="config"> <a class="a_image" href="#" onclick="javascript:addConfigSection(this.parentNode)"><img src="images/add-folder-green.gif" alt="Agregar Secci&oacute;n" border="0" title="Agregar Secci&oacute;n" /></a>
			<ul id="config_ul">
				|-foreach from=$config item=eachModule name=for_modules key=module_name-|
				<li id="config[|-$module_name-|]"><span class='titulo2'>|-$module_name-|</span> <a class="a_image" href="#" onclick="javascript:addConfigAttribute(this.parentNode)"><img src="images/add-comment-blue.gif" alt="Agregar Atributo" border="0" title="Agregar Atributo" /></a> <a class="a_image" href="#" onclick="javascript:addConfigSection(this.parentNode)"><img src="images/add-folder-green.gif" alt="Agregar Secci&oacute;n" border="0" title="Agregar Secci&oacute;n" /></a> <a class="a_image" href="#" onclick="javascript:deleteConfigAttribute(this.parentNode)"><img src="images/delete-folder-green.gif" alt="Eliminar" border="0" title="Eliminar" /></a>
					<ul id="config[|-$module_name-|]_ul">
						|-include file="CommonConfigEditInclude.tpl" elements=$eachModule name=[$module_name]-|
					</ul>
				</li>
				|-/foreach-|
			</ul>
		</li>
	</ul>
	<input type="hidden" name="do" value="commonConfigDoEdit" />
	<input type="submit" value="Guardar" />
</form>
</div>
