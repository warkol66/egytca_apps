<h2>Configuración del Sistema</h2>
<h1>Mantenimiento de HTML</h1>
<p>A continuación podrá agregar contenido HTML al sistema, puede agregar contenido HTML y externo para mostrar con formato diferente al sistema.<br />También puede seleccionar si el contenido será o no público a visitantes no ingresados en el sistema.</p>
<fieldset>
<legend>Formulario de carga de contenido HTML</legend>
	<form method="post" enctype="multipart/form-data" action="Main.php?do=htmlsDoEdit">
	<p><label for="name">Nombre del HTML</label>
		<input type="text" name="name" maxlength="30" />  
		Utilice un nombre corto y descriptivo</p>
	<p>
	  <label for="external">External</label>
		<input type="checkbox" name="external" value="1" /> 
		Recuerde que el external y el contenido HTML  deben tener el mismo nombre</p>
	<p>
	  <label for="private">Privado</label>
		<input type="checkbox" name="private" value="1" /> Solo los usuarios que hayan iniciado sesión podran acceder.</p>
	<p><label for="document">Archivo</label>
		<input name="document" type="file" size="45"></p>
	<p>NOTA:<br>
				Recuerde que lo mejor es utilizar un editor de HTML para generar el archivo.
				</p>
				<p><input name="subir" type="submit" value="Subir html" />
			|-if !$uploaded-|<input name="regresar" type="button" value="Regresar al listado" onClick="location.href='Main.php?do=htmlsList'" />|-/if-|</p>
	</form>
</fieldset>
|-if $uploaded-|
<h3>Fin de Procesamiento</h3>
<p>|-if $uploaded && !$uploadError-|El archivo ingresado por UD. ha sido procesado con exito.</p>
<p>El link para acceder al HTML subido es <a href="|-$link-|">|-$link-|</a>
|-elseif $uploaded && !$uploadError-| Ha ocurrido	un error proecesando el arhivo. 
|-/if-|</p>
<p>
<input name="regresar" type="button" value="Regresar al listado" onClick="location.href='Main.php?do=htmlsList'" /></p>
|-/if-|
