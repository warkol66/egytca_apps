<h2>Documentos</h2>
<h1>|-if $keyWord neq ''-|Editar|-else-|Ingresar|-/if-| palabras clave</h1>
<p>|-if $keyWord neq ''-|
Ingrese los cambiso a la palabra clave y haga click en "Guardar cambios"
|-else-|
Ingrese la palabra clave y haga click en "Agregar palabra clave".
|-/if-|
</p>
<form method="post" enctype="multipart/form-data" action="Main.php?do=documentsKeyWordDoEdit">
	|-if $keyWord neq''-|
	<input type="hidden" name="id" value="|-$keyWord->getId()-|">
	|-/if-|
	<fieldset title="Formulario para Agregar Nuevo Documento">
		|-if $document neq ''-|
		<legend>Editar Documento</legend>
		|-else-|
		<legend>Formulario de Documentos</legend>
		|-/if-|
		<p>Ingrese la palabra clave.</p>
			<p>
				<label for="keyWord">Palabra clave</label>
				 <input name="keyWord" type="text" value="|-if $keyWord neq ''-||-$keyWord->getKeyWord()|escape-||-/if-|" size="40" />
			</p>

			 <p> <input name="save" type="submit" value="|-if $keyWord neq ''-|Guardar Cambios|-else-|Agregar palabra clave|-/if-|" class="button" /> 
			 </p>
	</fieldset>
</form> 

 