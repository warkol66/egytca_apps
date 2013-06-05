|-if !isset($requester) and !isset($success)-|
<h2>Documentos</h2>
|-if isset($level)-|
<p>No tiene permisos para editar este documento</p>
|-else-|
<h1>|-if !$document->isNew()-|Editar|-else-|Ingresar|-/if-| datos de documentos</h1>
<p>|-if !$document->isNew()-|
Ingrese los datos del documento a editar y haga click en "Editar Documento".<br>
Puede cambiar los datos que se muestran a contimnuación, si desea modificar el archivo, busque el archivo correspondiente en el campo Archivo y 
súbalo nuevamente.
|-if $usePasswords-|
	|-if $document->getPassword() eq ''-|
		Si desea proteger el archivo con contraseña, ingrese una la clave en los campos correspondientes
	|-else-|
		Si desea modificar la contraseña, ingrese la contraseña actual, e ingres ela nueva contraseña en los campos correspondientes. Las contraseñas deben coincidir para guardar el cambio.
	|-/if-|
|-/if-|
|-else-|
Ingrese los datos del documento y haga click en "Agregar Documento".
	|-if $usePasswords-|
			Si desea proteger el archivo con contraseña, ingrese una la clave en los campos correspondientes. Las contraseñas deben coincidir para guardar el archivo.
	|-/if-|
|-/if-|
</p>
|-include file="DocumentsEditInclude.tpl"-|
|-/if-|
|-else-|
|-include file="DocumentsEditInclude.tpl" requester=$requester entity=$entity entityId=$entityId success=$success-|
|-/if-|

 
