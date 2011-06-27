
<h2>##issues,1,Asuntos##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| ##issues,2,Asunto##</h1>
<div id="div_issue">
	<p>Ingrese los datos del ##issues,2,Asunto##</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el ##issues,4,asunto##</span>|-/if-|
	<form name="form_edit_issue" id="form_edit_issue" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un issue">
			<legend>Formulario de Administración de ##issues,1,Asuntos##</legend>
			<p>
				<label for="params[name]">##issues,2,Asunto##</label>
				<input type="text" id="params[name]" name="params[name]" size="70" value="|-$issue->getName()|escape-|" title="##issues,2,Asunto##" />
			</p>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="65" rows="6" wrap="VIRTUAL" id="params[description]" title="Descripción">|-$issue->getDescription()|escape-|</textarea>
			</p>
			<p>
				<label for="params[impact]">Impacto</label>
				<select id="params[impact]" name="params[impact]" >
				|-foreach from=$issueImpactTypes key=impactKey item=impact name=for_impact-|
        		<option value="|-$impactKey-|" |-$issue->getImpact()|selected:$impactKey-|>|-$impact-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[valoration]">Valoración</label>
				<select id="params[valoration]" name="params[valoration]" >
				|-foreach from=$issueValorationTypes key=valorationKey item=valoration name=for_valoration-|
        		<option value="|-$valorationKey-|" |-$issue->getValoration()|selected:$valorationKey-|>|-$valoration-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[evolution]">Evolución</label>
				<select id="params[evolution]" name="params[evolution]" >
				|-foreach from=$issueEvolutionStages key=stageKey item=stage name=for_stage-|
        		<option value="|-$stageKey-|" |-$issue->getEvolution()|selected:$stageKey-|>|-$stage-|</option>
				|-/foreach-|
				</select>
			</p>
			|-if isset($loginUser) && $loginUser->isSupervisor()-|
				<p><label for="changedBy">|-if $issue->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label> |-$issue->changedBy()-| - |-$issue->getUpdatedAt()|change_timezone|datetime_format-| </p>
			|-/if-|
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$issue->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="issuesDoEdit" />
				<input type="submit" id="button_edit_issue" name="button_edit_issue" title="Guardar cambios" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=issuesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
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

<fieldset title="Formulario de actores asociados al ##issues,4,asunto##">
	<legend>Actores</legend>
	<div id="actorMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="issueActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Agregar actor al ##issues,4,asunto##" url="Main.php?do=actorsAutocompleteListX&getCandidates=1&issueId="|cat:$issue->getId() hiddenName="actor[id]"-||-*disableSubmit="addActorSubmit"*-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="issuesDoAddActorX" />
		<input type="hidden" name="issueId" id="issueId" value="|-$issue->getId()-|" /> 
    <input type="button" id="addActorSubmit" name="addActorSubmit" value="Agregar actor al ##issues,4,asunto##" title="Agregar actos al ##issues,4,asunto##" onClick="javascript:addActorToIssue(this.form)"/> </p>
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
