|-include file='ValidationJavascriptInclude.tpl'-|
<script language="JavaScript" type="text/javascript">
function actorsAddCategoryToActor(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress"> agregando ##actors,2,Actor## a la categoría... </span>';
	
	return true;
}

function actorsDeleteCategoryFromActor(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress"> eliminando ##actors,2,Actor## de la categoría... </span>';
	
	return true;

}
</script>
<h2>##actors,1,Actores##</h2>
<h1>|-if $actor->isNew()-|Crear|-else-|Editar|-/if-| ##actors,2,Actor##</h1>
<div id="div_actor">
	<p>Ingrese los datos del ##actors,2,Actor##</p>
		|-if $message eq "error"-|
			<div class="errorMessage">Ha ocurrido un error al intentar guardar el ##actors,2,Actor##</div>
		|-else if $message eq "ok"-|
			<div class="successMessage">##actors,2,Actor## guardado correctamente</div>
		|-/if-|
	
	<form name="form_edit_actor" id="form_edit_actor" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un actor">
			<legend>Formulario de Administración de ##actors,1,Actores##</legend>
			|-include file='ActorsForm.tpl'-|
				|-if !$actor->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$actor->getid()-|" />
				|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
				<input type="hidden" name="do" id="do" value="actorsDoEdit" />
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" id="Regresar" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=actorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if !$actor->isNew() && method_exists($actor,"getActorCategorys")-|
|-include file="ActorsEditCategoriesInclude.tpl"-|
|-/if-|
