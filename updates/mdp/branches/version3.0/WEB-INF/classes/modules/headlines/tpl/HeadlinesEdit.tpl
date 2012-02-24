<h2>##headlines,1,Titulares##</h2>
|-if !$notValidId-|
<h1>|-if !$headline->isNew()-|Editar|-else-|Crear|-/if-| ##headlines,2,Titular##</h1>
<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox2" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p> 
	|-include file="ActorsEditInclude.tpl"-|
</div> 
|-include file="CommonAutocompleterInclude.tpl"-|
<div id="div_headline">
	<p>Ingrese los datos del ##headlines,2,Titular##</p>
	|-if $message eq "ok"-|
		<div class="successMessage" id="actionMessage">Titular guardado correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage" id="actionMessage">Ha ocurrido un error al intentar guardar el ##headlines,2,Titular##</div>
	|-/if-|
	<form name="form_edit_headline" id="form_edit_headline" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un titular">
			<legend>Formulario de Administración de ##headlines,1,Titulares##</legend>
		<div id="campaign" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_campaignId" label="Campaña" url="Main.php?do=campaignsAutocompleteListX" hiddenName="params[campaignId]" defaultHiddenValue=$headline->getCampaignId() defaultValue=$headline->getCampaign()-|
		</div>
		<div id="media" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_mediaId" label="Medio" url="Main.php?do=mediasAutocompleteListX" hiddenName="params[mediaId]" defaultHiddenValue=$headline->getMediaId() defaultValue=$headline->getMedia() class="emptyValidation"-|
		</div>
			<p>
				<label for="params[name]">Titular</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$headline->getname()|escape-|" title="Nombre" class="emptyValidation" /> |-validation_msg_box idField="params[name]"-|
			</p>
			<p>
				<label for="params[content]">Contenido</label>
					<textarea id="params[content]" name="params[content]" cols="42" rows="6" wrap="VIRTUAL" title="Contenido" class="emptyValidation">|-$headline->getContent()|escape-|</textarea> |-validation_msg_box idField="params[content]"-|
			</p>
			<p>     
				<label for="params[datePublished]">Fecha de Publicación</label>
				<input id="params[datePublished]" name="params[datePublished]" type='text' value='|-$headline->getDatePublished()-|' size="12" title="Ingrese la fecha de publicación" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[datePublished]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>     
				<label for="params[headlineDate]">Fecha del Titular</label>
				<input id="params[headlineDate]" name="params[headlineDate]" type='text' value='|-$headline->getHeadlineDate()-|' size="12" title="Ingrese la fecha de titular" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[headlineDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
		<p>
			<label for="params[url]">Url</label>
			<input id="params[url]" name="params[url]" type='text' value='|-$headline->getUrl()-|' size="65" title="Ingrese el url del titular incluyendo el http://" />|-if $headline->getUrl() ne ''-| <a href="|-$headline->getUrl()-|" target="_blank" title="Ir a nota original" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a> |-/if-|
			|-if $headline->hasClipping()-|<a href="Main.php?do=headlinesViewClipping&id=|-$headline->getId()-|" title="Ver recorte"><img src="images/clear.png" class="icon iconNewsClipping" /></a>|-else-|<a href="Main.php?do=headlinesRenderUrl&id=|-$headline->getId()-|" title="Generar recorte"><img src="images/clear.png" class="icon iconNewsAdd" /></a> |-/if-|
			</p>
			<p>     
				<label for="params[picture]">Foto</label>
				<select id="params[picture]" name="params[picture]" title="Indique si incluye foto">
					<option value="0" |-$headline->getPicture()|selected:0-|>No</option>
					<option value="1" |-$headline->getPicture()|selected:1-|>Sí</option>
				</select>
			</p>
			<p>     
				<label for="params[twitts]">Twitts</label>
				<input id="params[twitts]" name="params[twitts]" type='text' value='|-$headline->getTwitts()-|' size="5" title="Retweets"/>
			</p>
			<p>     
				<label for="params[fcb]">Fcb</label>
				<input id="params[fcb]" name="params[fcb]" type='text' value='|-$headline->getFcb()-|' size="5" title="Fcbkpost" />
			</p>
			<p>     
				<label for="params[gplus]">G+ </label>
				<input id="params[gplus]" name="params[gplus]" type='text' value='|-$headline->getGplus()-|' size="5" title="G+" />
			</p>
			<p>     
				<label for="params[comment]">Comentarios</label>
				<input id="params[comment]" name="params[comment]" type='text' value='|-$headline->getComment()-|' size="5" title="Commments" />
			</p>
			<p>
				<label for="params[value]">Valoración</label>
				<input name="params[value]" type="hidden" value="0" />
				&nbsp; 1 <input name="params[value]" type="radio" value="1" |-$headline->getValue()|checked:1-| title="Seleccione el valor de la noticia" />
				&nbsp; 2 <input name="params[value]" type="radio" value="2" |-$headline->getValue()|checked:2-| title="Seleccione el valor de la noticia" />
				&nbsp; 3 <input name="params[value]" type="radio" value="3" |-$headline->getValue()|checked:3-| title="Seleccione el valor de la noticia" />
				&nbsp; 4 <input name="params[value]" type="radio" value="4" |-$headline->getValue()|checked:4-| title="Seleccione el valor de la noticia" />
				&nbsp; 5 <input name="params[value]" type="radio" value="5" |-$headline->getValue()|checked:5-| title="Seleccione el valor de la noticia" />
			</p>
			<p>
				<label for="params[relevance]">Relevancia</label>
				<input name="params[relevance]" type="hidden" value="0" />
				&nbsp; 1 <input name="params[relevance]" type="radio" value="1" |-$headline->getRelevance()|checked:1-|/>
				&nbsp; 2 <input name="params[relevance]" type="radio" value="2" |-$headline->getRelevance()|checked:2-|/>
				&nbsp; 3 <input name="params[relevance]" type="radio" value="3" |-$headline->getRelevance()|checked:3-|/>
				&nbsp; 4 <input name="params[relevance]" type="radio" value="4" |-$headline->getRelevance()|checked:4-|/>
				&nbsp; 5 <input name="params[relevance]" type="radio" value="5" |-$headline->getRelevance()|checked:5-|/>
			</p>
			<p>
			<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
				|-include file="HiddenInputsInclude.tpl" filters="$filters" page="$page"-|
				<input type="hidden" name="do" id="do" value="headlinesDoEdit" />
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" id="cancel" name="cancel" title="Regresar al listado" value="Regresar al listado" onClick="location.href='Main.php?do=headlinesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && $page gt 0-|&page=|-$page-||-/if-|'"/>
				|-if !$headline->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$headline->getid()-|" />
				<input type='button' id='button_create_new' value='Crear nuevo' onClick='location.href="Main.php?do=headlinesEdit&campaignId=|-$headline->getCampaignId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && $page gt 0-|&page=|-$page-||-/if-|"' />|-/if-|
			</p>
		</fieldset>
	</form>
</div>


|-if !$headline->isNew()-|

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

	function selectRole(actorId, roleValue) {
		new Ajax.Updater (
			'span_role_for_'+actorId,
			'Main.php?do=headlinesSelectActorRole',
			{
				method: 'get',
				parameters: {
					headlineId: |-$headline->getId()-|,
					actorId: actorId,
					role: roleValue
				}
			});
	}

	function displayRoleSelector(actorId) {
		$('p_role_for_'+actorId).hide();
		$('select_role_for_'+actorId).show();
	}
</script>

<fieldset title="Formulario de actores asociados al ##headlines,4,titular##">
	<legend>Relación con Actores</legend>
    |-if $action neq 'showLog'-|
		<p>Para asociar un actor al titular, ingrese el nombre en la casilla. Si no está en el sistema puede <a href="#lightbox2" rel="lightbox2" class="lbOn addLink">Crear actor</a></p>
	<div id="actorMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Relacionar con actor" url="Main.php?do=actorsAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="actor[id]" disableSubmit="addActorSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="headlinesDoAddActorX" />
		<input type="hidden" name="headlineId" id="headlineId" value="|-$headline->getId()-|" /> 
    <input type="button" id="addActorSubmit" disabled="disabled" name="addActorSubmit" value="Agregar actor al ##headlines,4,titular##" title="Agregar actor al ##headlines,4,titular##" onClick="javascript:addActorToHeadline(this.form)"/> </p>
	</form>
    |-/if-|
  <div id="headlinesActorsList">
		<ul id="actorList" class="iconOptionsList">
			|-foreach from=$headline->getActors() item=actor-|
			<li id="actorListItem|-$actor->getId()-|" title="Actor asociado al titular">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="headlinesDoRemoveActorX" /> 
							<input type="hidden" name="headlineId" value="|-$headline->getid()-|" /> 
							<input type="hidden" name="actorId" value="|-$actor->getid()-|" /> 
							<input type="button" name="submit_go_remove_actor" value="Borrar" title="Eliminar actor de titular" onclick="if (confirm('Seguro que desea quitar el actor del titular?')) removeActorFromHeadline(this.form);" class="icon iconDelete" /> 
						</form> |-$actor-| &nbsp; &nbsp;
						|-foreach from=$headline->getHeadlineActors() item=headlineActor-|
							|-if $headlineActor->getActorId() eq $actor->getId()-|
								|-assign var=role value=$headlineActor->getRole()-|
							|-/if-|
						|-/foreach-|
						|-if $role neq ''-||-assign var=actorRoleAction value='show'-||-else-||-assign var=actorRoleAction value=''-||-/if-|
						|-assign var=headlinePeer value=$headline->getPeer()-|
						<span id='span_role_for_|-$actor->getId()-|' class="bold italic" title="Modifique el rol del actor en el titular">
						|-include file='HeadlinesSelectActorRole.tpl' action=$actorRoleAction actorId=$actor->getId() role=$role roles=$headlinePeer->getHeadlineRoles()-|
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
	<legend>Relación con Asuntos</legend>
	<div id="issueMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineIssue" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" label="Relacionar con asunto" url="Main.php?do=issuesAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="issue[id]" disableSubmit="addIssueSubmit"-|
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
	<legend>Relación con Titulares</legend>
	<div id="relationMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineRelation" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_relations" label="Relacionar con ##headlines,4,titular##" url="Main.php?do=headlinesAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="relation[id]" disableSubmit="addRelationSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="headlinesDoAddRelationX" />
		<input type="hidden" name="headlineId" id="headlineId" value="|-$headline->getId()-|" /> 
    <input type="button" id="addRelationSubmit" disabled="disabled" name="addRelationSubmit" value="Agregar titular al ##headlines,4,titular##" title="Agregar titular al ##headlines,4,titular##" onClick="javascript:addRelationToHeadline(this.form)"/> </p>
	</form>
  <div id="headlinesRelationsList">
		<ul id="relationList" class="iconOptionsList">
			|-foreach from=$headline->getHeadlineRelations() item=relation-|
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

	|-include file="DocumentsListInclude.tpl" entity="Headline" entityId=$headline->getId() label="Clipping"-|
	|-include file="DocumentsEditInclude.tpl" entity="Headline" entityId=$headline->getId() label="Clipping"-|

|-/if-|
|-else-|
<div class="errorMessage">El identificador ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=headlinesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Titulares"/>
|-/if-|