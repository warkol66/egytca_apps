<h2>Documentos</h2>
<h1>|-if $document neq ''-|Editar|-else-|Ingresar|-/if-| datos de documentos</h1>
<p>|-if $document neq ''-|
Ingrese los datos del documento a editar y haga click en "Editar Documento".<br>
Puede cambiar los datos que se muestran a contimnuación, si desea modificar el archivo, busque el archivo correspondiente en el campo Archivo y 
súbalo nuevamente.
|-if $moduleParameters.usePasswords.value eq 'YES'-|
	|-if $document->getPassword() eq ''-|
		Si desea proteger el archivo con contraseña, ingrese una la clave en los campos correspondientes
	|-else-|
		Si desea modificar la contraseña, ingrese la contraseña actual, e ingres ela nueva contraseña en los campos correspondientes. Las contraseñas deben coincidir para guardar el cambio.
	|-/if-|
|-/if-|
|-else-|
Ingrese los datos del documento y haga click en "Agregar Documento".
	|-if $moduleParameters.usePasswords.value eq 'YES'-|
			Si desea proteger el archivo con contraseña, ingrese una la clave en los campos correspondientes. Las contraseñas deben coincidir para guardar el archivo.
	|-/if-|
|-/if-|
</p>
|-if $message eq "wrongPasswordComparison"-|
	<div class="failureMessage">Error: Las contraseñas ingresadas no concuerdan</div>
|-elseif $message eq "wrongPassword"-|
	<div class="failureMessage">Error: Se ha ingresado incorectamente la contraseña actual</div>
|-elseif $msg eq "wrongPasswordComparison"-|
	<div class="failureMessage">Error: Las contraseñas ingresadas no concuerdan</div>
	|-elseif $msg eq "wrongCategory"-|
	<div class="failureMessage">Error: Debe seleccionar un tipo de documento</div>
|-/if-|

<form method="post" enctype="multipart/form-data" action="Main.php?do=documentsDoEdit">
	|-if $document neq''-|
	<input type="hidden" name="id" value="|-$document->getId()-|">
	|-/if-|
	<fieldset title="Formulario para Agregar Nuevo Documento">
		|-if $document neq ''-|
		<legend>Editar Documento</legend>
		|-else-|
		<legend>Formulario de Documentos</legend>
		|-/if-|
		<p>Ingrese los datos correspondientes al documento. 
		|-if $document neq ''-|
			Seleccione un nuevo documento si desea reemplazar el documento actual ("|-$document->getRealFilename()-|")
		|-/if-|</p>
			<p>
				<label for="document">Archivo</label>
				<input name="document" type="file" size="45" />
			</p>
			<p><label for="date">Fecha</label>
				 <input name="date" type="text" value="|-if $document neq ''-||-$document->getDocumentDate()|date_format:'%d-%m-%Y'-||-else-||-$smarty.now|date_format:'%d-%m-%Y'-||-/if-|" size="10" />
			</p>
			<p>
				<label for="title">Título</label>
				<textarea name="title" cols="55" rows="3" wrap="virtual">|-if $document neq ''-||-$document->getTitle()-||-/if-|</textarea>
			</p>
			<p><label for="category">Categoría</label>
				<select name="category">
					<option value=''>Sin Categoría</option>
					|-include file="DocumentsCategoriesInclude.tpl" categories=$categories user=$user document=$document count='0'-|
				</select>
			</p>
			<p><label for="description">Descripción</label>
			 <textarea name="description" cols="55" rows="6" wrap="VIRTUAL">|-if $document neq ''-||-$document->getDescription()-||-/if-|</textarea>
  </p> 
|-if $document neq '' && $document->getPassword() neq ''-|
			<p><label for="old_password">Contraseña |-if $document neq ''-|actual|-/if-|</label>
			 	<input name="old_password" type="password" size="15" />
			</p>
|-/if-|
|-if $moduleParameters.usePasswords.value eq 'YES'-|
			<p><label for="password">Contraseña nueva</label>
			  <input name="password" type="password" size="15" />
			</p>
			<p><label for="password_compare">Repita contraseña</label>
			  <input name="password_compare" type="password" size="15" />
	</p>
|-/if-|
			 <p> <input name="save" type="submit" value="|-if $document neq ''-|Guardar Cambios|-else-|Agregar Documento|-/if-|"> 
			 </p>
	</fieldset>
</form> 

 