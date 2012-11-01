<h2>Usuarios por Registracion</h2> 
<h1>Importar Usuarios por Registracion</h1>
<form id="usersImportLoaderForm" action="Main.php" method="post" enctype="multipart/form-data" >
	<fieldset>
	<legend>Importar Usuarios</legend>
		<p>A continuacion indique el archivo csv desde el cual desea importar los usuarios:</p>
		<p><label>Archivo de Usuarios: </label><input type="file" name="users" value=""  /></p>		
		<p><input type="hidden" name="do" value="registrationDoImportUsers" /></p>
		<p><input type="submit" value="Importar Usuarios" accept="txt/csv"/></p>
	</fieldset>
</form>
