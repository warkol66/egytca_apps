<script language="JavaScript" type="text/javascript">
function issuesAddCategory(form) {

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
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">agregando ##issues,2,Asunto## a la categoría...</span>';
	return true;
}

function issuesRemoveCategory(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('categoryMsgField').innerHTML = '<span class="inProgress">eliminando ##issues,2,Asunto## de la categoría...</span>';
	return true;
}
</script>
<h2>##issues,1,Asuntos##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| ##issues,2,Asunto##</h1>
<div id="div_issue">
	<p>Ingrese los datos del ##issues,2,Asunto##</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el ##issues,2,Asunto##</span>|-/if-|
	<form name="form_edit_issue" id="form_edit_issue" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un issue">
			<legend>Formulario de Administración de ##issues,1,Asuntos##</legend>
			<p>
				<label for="params[issue]">Asunto</label>
				<input type="text" id="params[issue]" name="params[issue]" size="20" value="|-$issue->getIssue()|escape-|" title="Asunto" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$issue->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="issuesDoEdit" />
				<input type="submit" id="button_edit_issue" name="button_edit_issue" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=issuesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if $issue->getId() ne ''-|
|-include file="IssuesEditCategoriesInclude.tpl"-|

|-include file="CommonAutocompleterInclude.tpl" -|
<script type="text/javascript" language="javascript" charset="utf-8">
function addActorToIssue(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'actorList'},
				'Main.php?do=issuesDoAddActorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('actorMsgField').innerHTML = '<span class="inProgress">Agregando actor al asunto...</span>';
	return true;
}

function removeActorFromIssue(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'actorMsgField'},
				'Main.php?do=issuesDoRemoveActorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('actorMsgField').innerHTML = '<span class="inProgress">Eliminando actor...</span>';
	return true;
}
</script>

<fieldset title="Formulario de actores asociados al asunto">
	<legend>Actores</legend>
	<div id="actorMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="issueActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Agregar actor al asunto" url="Main.php?do=actorsAutocompleteListX&getCandidates=1&issueId="|cat:$issue->getId() hiddenName="actor[id]"-||-*disableSubmit="addActorSubmit"*-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="issuesDoAddActorX" />
		<input type="hidden" name="issueId" id="issueId" value="|-$issue->getId()-|" /> 
    <input type="button" id="addActorSubmit" name="addActorSubmit" value="Agregar actor al asunto" title="Agregar actos al asunto" onClick="javascript:addActorToIssue(this.form)"/> </p>
	</form>
  <div id="issuesActorsList">
		<ul id="actorList" class="iconOptionsList">
			|-foreach from=$issue->getActors() item=actor-|
			<li id="actorListItem|-$actor->getId()-|">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="issuesDoRemoveActorX" /> 
							<input type="hidden" name="issueId" value="|-$issue->getid()-|" /> 
							<input type="hidden" name="actorId" value="|-$actor->getid()-|" /> 
							<input type="button" name="submit_go_remove_actor" value="Borrar" onclick="if (confirm('Seguro que desea quitar el actor del asunto?')) removeActorFromIssue(this.form);" class="icon iconDelete" /> 
						</form> |-$actor->getName()-|
					</li>
			|-/foreach-|
			</ul>    
		</div> 
</fieldset>
|-/if-|
