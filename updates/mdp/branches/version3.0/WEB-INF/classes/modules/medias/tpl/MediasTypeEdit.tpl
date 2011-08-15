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
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">agregando ##actors,2,Actor## a la categoría...</span>';
	
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
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">eliminando ##actors,2,Actor## de la categoría...</span>';
	
	return true;

}
</script>
<h2>##actors,1,Actores##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| ##actors,2,Actor##</h1>
<div id="div_type">
	<p>Ingrese los datos del ##actors,2,Actor##</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el ##actors,2,Actor##</span>|-/if-|
	<form name="form_edit_type" id="form_edit_type" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un actor">
			<legend>Formulario de Administración de ##actors,1,Actores##</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="20" value="|-$mediaType->getName()|escape-|" title="Nombre" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$mediaType->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="mediasTypeDoEdit" />
				<input type="submit" id="button_edit_type" name="button_edit_type" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=mediasTypeList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
