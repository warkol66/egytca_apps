<h2>Configuración del Sistema</h2>
|-if !$notValidId-|
<h1>Administración de Módulos - |-$currentModule->getName()|capitalize-|</h1>
<p>A continuación podrá cambiar la etiqueta del nombre del módulo y su descripción. Estos cambios no alteran la funcionalidad de los módulos, son sólo los nombres y descripciones que se le  mostrarán al usuario.</p> 
<form name="moduleEdit" action="Main.php?do=modulesDoEdit" method="POST">
<input type=hidden name="moduleName" value="|-$currentModule->getName()-|" />
<fieldset title="Formulario de informaciónd el módulo"> 
	<legend>Información del módulo</legend>
		<p><label for="moduleNameReadonly">Módulo</label>
			<input name="moduleNameReadonly" id="moduleNameReadonly" type="text" value="|-$currentModule->getName()|capitalize-|" size="25" readonly="readonly" class="readOnly" />
	</p>			
		<p><label for="label">Etiqueta</label>
			<input name="label" id="label" type="text" value="|-$currentModule->getLabel()-|" size="50" /></td>
		</p>
		<p><label for="description">Descripción</label>
				<textarea name="description" id="description" cols="60" rows="5" wrap="VIRTUAL">|-$currentModule->getDescription()-|</textarea>
	</p>
		<p>
				<input type="submit" name="Activar" value="Guardar Cambios" />
			<input name="return" type="button"  value="Regresar" title="Regresar" onClick="location.href='Main.php?do=modulesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
			</p> 
</fieldset> 
</form>
|-else-|
<div class="errorMessage">Ingresó un Identificador de Módulo inexistente, regrese al listado haciendo <a href="Main.php?do=modulesList">click aquí</a></div>
|-/if-|
