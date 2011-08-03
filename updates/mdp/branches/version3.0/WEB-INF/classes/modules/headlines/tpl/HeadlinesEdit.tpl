<!--
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
-->

<h2>##headlines,1,Titulares##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| ##headlines,2,Titular##</h1>
<div id="div_headline">
	<p>Ingrese los datos del ##headlines,2,Titular##</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el ##headlines,2,Titular##</span>|-/if-|
	<form name="form_edit_headline" id="form_edit_headline" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un titular">
			<legend>Formulario de Administración de ##headlines,1,Titulares##</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$headline->getname()|escape-|" title="Nombre" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[content]">Content</label>
				<input type="text" id="params[content]" name="params[content]" size="50" value="|-$headline->getcontent()|escape-|" title="Contenido" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$headline->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="headlinesDoEdit" />
				<input type="submit" id="button_edit_headline" name="button_edit_headline" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=headlinesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>

<!--
aca borre el ultimo parrafo de ActorsEdit, que no se dejaba comentar por algun
motivo
-->
