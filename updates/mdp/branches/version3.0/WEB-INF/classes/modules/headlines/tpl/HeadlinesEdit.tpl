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
				<label for="params[content]">Contenido</label>
                                <textarea id="params[content]" name="params[content]" cols="42" rows="6" wrap="VIRTUAL" title="Contenido">|-$headline->getContent()|escape-|</textarea><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
                        <p>     
				<label for="params[datePublished]">Fecha de Publicación</label>
				<input id="params[datePublished]" name="params[datePublished]" type='text' value='|-$headline->getDatePublished()-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[datePublished]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
                        <p>     
				<label for="params[headlineDate]">Fecha del Titular</label>
				<input id="params[headlineDate]" name="params[headlineDate]" type='text' value='|-$headline->getHeadlineDate()-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[headlineDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>     <label for="params[url]">Url del Titular</label>
				<input id="params[url]" name="params[url]" type='text' value='|-$headline->getUrl()-|' size="65" />
			</p>
			<p>     
				<label for="params[twitts]">Twitts del Titular</label>
				<input id="params[twitts]" name="params[twitts]" type='text' value='|-$headline->getTwitts()-|' size="10" />
			</p>
			<p>     
				<label for="params[fcb]">Fcb del Titular</label>
				<input id="params[fcb]" name="params[fcb]" type='text' value='|-$headline->getFcb()-|' size="10" />
			</p>
			<p>     
				<label for="params[gplus]">G+ del Titular</label>
				<input id="params[gplus]" name="params[gplus]" type='text' value='|-$headline->getGplus()-|' size="10" />
			</p>
			<p>     
				<label for="params[comment]">Comment del Titular</label>
				<input id="params[comment]" name="params[comment]" type='text' value='|-$headline->getComment()-|' size="10" />
			</p>
			<p>     
				<label for="params[picture]">Foto del Titular</label>
				<select id="params[picture]" name="params[picture]">
					<option value=0 |-if $headline->getPicture() neq 1-|selected="selected"|-/if-|>No</option>
					<option value=1 |-if $headline->getPicture() eq 1-|selected="selected"|-/if-|>Sí</option>
				</select>
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


|-if $headline->getId() ne ''-|

|-include file="CommonAutocompleterInclude.tpl" -|
<script type="text/javascript" language="javascript" charset="utf-8">
function addActorToHeadline(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'actorList'},
				'Main.php?do=headlinesDoAddActorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('actorMsgField').innerHTML = '<span class="inProgress">Agregando actor al titular...</span>';
    $('autocomplete_actors').value = '';
    $('addActorSubmit').disable();
	return true;
}

function removeActorFromHeadline(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'actorMsgField'},
				'Main.php?do=headlinesDoRemoveActorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('actorMsgField').innerHTML = '<span class="inProgress">Eliminando actor...</span>';
	return true;
}
</script>

<fieldset title="Formulario de actores asociados al ##headlines,4,titular##">
	<legend>Actores</legend>
	<div id="actorMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Agregar actor al ##headlines,4,titular##" url="Main.php?do=actorsAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="actor[id]" disableSubmit="addActorSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="headlinesDoAddActorX" />
		<input type="hidden" name="headlineId" id="headlineId" value="|-$headline->getId()-|" /> 
    <input type="button" id="addActorSubmit" disabled="disabled" name="addActorSubmit" value="Agregar actor al ##headlines,4,titular##" title="Agregar actor al ##headlines,4,titular##" onClick="javascript:addActorToHeadline(this.form)"/> </p>
	</form>
  <div id="headlinesActorsList">
		<ul id="actorList" class="iconOptionsList">
			|-foreach from=$headline->getActors() item=actor-|
			<li id="actorListItem|-$actor->getId()-|">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="headlinesDoRemoveActorX" /> 
							<input type="hidden" name="headlineId" value="|-$headline->getid()-|" /> 
							<input type="hidden" name="actorId" value="|-$actor->getid()-|" /> 
							<input type="button" name="submit_go_remove_actor" value="Borrar" onclick="if (confirm('Seguro que desea quitar el actor del titular?')) removeActorFromHeadline(this.form);" class="icon iconDelete" /> 
						</form> |-$actor-|
						|-foreach from=$headline->getHeadlineActors() item=headlineActor-|
							|-if $headlineActor->getActorId() eq $actor->getId()-|
								|-assign var=role value=$headlineActor->getRole()-|
							|-/if-|
						|-/foreach-|
						|-if $role neq ''-||-assign var=action value='show'-||-else-||-assign var=action value=''-||-/if-|
						|-assign var=headlinePeer value=$headline->getPeer()-|
						<span id='span_role_for_|-$actor->getId()-|'>
						|-include file='HeadlinesSelectActorRole.tpl' action=$action actorId=$actor->getId() headlineId=$headline->getId() role=$role roles=$headlinePeer->getHeadlineRoles()-|
						</span>
					</li>
			|-/foreach-|
			</ul>    
		</div> 
</fieldset>


<script type="text/javascript" language="javascript" charset="utf-8">
function addIssueToHeadline(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'issueList'},
				'Main.php?do=headlinesDoAddIssueX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('issueMsgField').innerHTML = '<span class="inProgress">Agregando asunto al titular...</span>';
    $('autocomplete_issues').value = '';
    $('addIssueSubmit').disable();
	return true;
}

function removeIssueFromHeadline(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'issueMsgField'},
				'Main.php?do=headlinesDoRemoveIssueX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('issueMsgField').innerHTML = '<span class="inProgress">Eliminando asunto...</span>';
	return true;
}
</script>

<fieldset title="Formulario de asuntos asociados al ##headlines,4,titular##">
	<legend>Asuntos</legend>
	<div id="issueMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineIssue" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" label="Agregar asunto al ##headlines,4,titular##" url="Main.php?do=issuesAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="issue[id]" disableSubmit="addIssueSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="headlinesDoAddIssueX" />
		<input type="hidden" name="headlineId" id="headlineId" value="|-$headline->getId()-|" /> 
    <input type="button" id="addIssueSubmit" disabled="disabled" name="addIssueSubmit" value="Agregar asunto al ##headlines,4,titular##" title="Agregar asunto al ##headlines,4,titular##" onClick="javascript:addIssueToHeadline(this.form)"/> </p>
	</form>
  <div id="headlinesIssuesList">
		<ul id="issueList" class="iconOptionsList">
			|-foreach from=$headline->getIssues() item=issue-|
			<li id="issueListItem|-$issue->getId()-|">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="headlinesDoRemoveIssueX" /> 
							<input type="hidden" name="headlineId" value="|-$headline->getid()-|" /> 
							<input type="hidden" name="issueId" value="|-$issue->getid()-|" /> 
							<input type="button" name="submit_go_remove_issue" value="Borrar" onclick="if (confirm('Seguro que desea quitar el asunto del titular?')) removeIssueFromHeadline(this.form);" class="icon iconDelete" /> 
						</form> |-$issue->getName()-|
					</li>
			|-/foreach-|
			</ul>    
		</div> 
</fieldset>

<script type="text/javascript" language="javascript" charset="utf-8">
function addRelationToHeadline(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'relationList'},
				'Main.php?do=headlinesDoAddRelationX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('relationMsgField').innerHTML = '<span class="inProgress">Agregando titular al titular...</span>';
    $('autocomplete_relations').value = '';
    $('addRelationSubmit').disable();
	return true;
}

function removeRelationFromHeadline(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'relationMsgField'},
				'Main.php?do=headlinesDoRemoveRelationX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('relationMsgField').innerHTML = '<span class="inProgress">Eliminando titular...</span>';
	return true;
}
</script>

<fieldset title="Formulario de titulares asociados al ##headlines,4,titular##">
	<legend>Titulares</legend>
	<div id="relationMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineRelation" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_relations" label="Agregar titular al ##headlines,4,titular##" url="Main.php?do=headlinesAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="relation[id]" disableSubmit="addRelationSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="headlinesDoAddRelationX" />
		<input type="hidden" name="headlineId" id="headlineId" value="|-$headline->getId()-|" /> 
    <input type="button" id="addRelationSubmit" disabled="disabled" name="addRelationSubmit" value="Agregar titular al ##headlines,4,titular##" title="Agregar titular al ##headlines,4,titular##" onClick="javascript:addRelationToHeadline(this.form)"/> </p>
	</form>
  <div id="headlinesRelationsList">
		<ul id="relationList" class="iconOptionsList">
			|-foreach from=$headline->getHeadlinesRelatedByHeadlinetoid() item=relation-|
			<li id="relationListItem|-$relation->getId()-|">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="headlinesDoRemoveRelationX" /> 
							<input type="hidden" name="headlineId" value="|-$headline->getid()-|" /> 
							<input type="hidden" name="relationId" value="|-$relation->getid()-|" /> 
							<input type="button" name="submit_go_remove_relation" value="Borrar" onclick="if (confirm('Seguro que desea quitar el titular del titular?')) removeRelationFromHeadline(this.form);" class="icon iconDelete" /> 
						</form> |-$relation->getName()-|
					</li>
			|-/foreach-|
			</ul>    
		</div> 
</fieldset>

|-/if-|