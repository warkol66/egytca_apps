|-if isset($error) and $error eq 'true'-|
<div class="errorMessage">La extensión del archivo que intenta subir es incorrecta.</div>
|-elseif isset($success) and $success eq 'true'-|
<div class="successMessage">Archivo subido correctamente.</div>
|-/if-|
<form method="POST" action="Main.php">
	<input type="hidden" name="do" value="documentsEdit" />
	<input type="hidden" name="entityId" value="|-$entityId-|" />
	<input type="hidden" name="requester" value="|-$requester-|" />
	<input type="hidden" name="entity" value="|-$entity-|" />
	<button type="submit" title="Agregar nuevo documento">Adjuntar nuevo documento</button>
</form>
