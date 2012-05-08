<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='title'>Creación de Xml's para modulos</td>
	</tr>
	<tr>
		<td class='underlineTitle'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='backgroundTitle'>Crear Xml</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
|-if $message eq "ok"-|	<tr>
		<td class="errorMessage">Configuración Guardada!</td>
	</tr>
<tr>
	<td>&nbsp;</td>
</tr>
|-/if-|	<tr>
		<td>A continuación podrá elegir un módulo para posteriormente ver y editar su xml.</td>
	</tr>
	<tr>
		<td>
			|-if $selectedModule ne ""-|
				Modulo: |-$selectedModule-|
			|-/if-|&nbsp;
      	<form action="Main.php" method="get">
					<select name="module" onchange="this.parentNode.submit();">
						<option value="">Seleccionar Modulo</option>
					|-foreach from=$modules item=module name=for_modules key=module_name-|
						<option value="|-$module-|">|-$module-|</option>
					|-/foreach-|
					</select>
					<input type="hidden" name="do" value="modulesCreateXml" />
		  </form>
		</td>
	</tr>
</table>
|-if $selectedModule ne ""-|
<form method="post" action="Main.php">
			<ul id="config_ul">
				<li id="config[|-$selectedModule-|]"><span class='titulo2'>|-$selectedModule-|</span>
					<ul id="config[|-$selectedModule-|]_ul">
						<p>|-include file=ConfigSetInclude.tpl elements=$config name=[$selectedModule]-|</p>
						<p>&nbsp;</p>
					</ul>
					|-if $flag != 1-|
					<ul id="configb">
						<p><strong>Nuevos Actions Encontrados:</strong> |-include file=ConfigCreateXmlForActionInclude.tpl elements=$actionXmls name=[$selectedModule]-| </p>
					</ul>
					|-/if-|
			  </li>
			</ul>
	<input type="hidden" name="do" value="configDoCreateXmlForAction" />
	<input type="hidden" name="module" value="|-$selectedModule-|" />
	<input type="submit" value="Guardar" class="button" />
</form>
|-/if-|
