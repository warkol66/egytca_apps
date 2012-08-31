<h2>##headlines,1,Titulares##</h2>
|-if !$notValidId-|
<h1>|-if !$headline->isNew()-|Editar|-else-|Crear|-/if-| ##headlines,2,Titular##</h1>
<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox2" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p> 
	|-include file="ActorsEditInclude.tpl"-|
</div> 

<div id="lightbox_medias" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p> 
	<form onsubmit="createMedia(this); return false;">
		<fieldset title="Formulario de edición de datos de un ##medias,2,Medio##">
			<legend>Formulario de Creación de ##medias,1,Medios##</legend>
			<div id="createMediaOperationInfo"></div>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="60" title="Nombre" />
			</p>
					<p>
						<label for="params[typeId]">Tipo</label>
						<select id="params[typeId]" name="params[typeId]" >
								<option value="">Seleccione</option>
						|-foreach from=$mediaTypes item=mediaType name=for_mediaType-|
								<option value="|-$mediaType->getId()-|">|-$mediaType->getName()-|</option>
						|-/foreach-|
						</select>
						</p>
					<p>
						<label for="params[importance]">Importancia</label>
						&nbsp; 1 <input name="params[importance]" type="radio" value="1" />
						&nbsp; 2 <input name="params[importance]" type="radio" value="2" />
						&nbsp; 3 <input name="params[importance]" type="radio" value="3" />
						&nbsp; 4 <input name="params[importance]" type="radio" value="4" />
					</p>			
			<p>
				<label for="params[bias]">Afinidad</label>
				&nbsp; -2 <input name="params[bias]" type="radio" value="-2" />
				&nbsp; -1 <input name="params[bias]" type="radio" value="-1" />
				&nbsp; 0 <input name="params[bias]" type="radio" value="0" />
				&nbsp; 1 <input name="params[bias]" type="radio" value="1" />
				&nbsp; 2 <input name="params[bias]" type="radio" value="2" />
			</p>
					<p>
				<input type="submit" title="Aceptar" value="Agregar nuevo" />
				<a href="#" class="lbAction noDecoration" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>
</div> 
<div id="mediasCreateResponseDummy" style="display:none"></div>
<script type="text/javascript">
	function createMedia(form) {
		
		$('createMediaOperationInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />';
		
		new Ajax.Updater(
			"mediasCreateResponseDummy" ,
			"Main.php?do=mediasDoEditX",
			{
				method: 'post',
				postBody: Form.serialize(form),
				evalScripts: true,
				onComplete: function() {
					$('createMediaOperationInfo').innerHTML='<span class="resultSuccess">Medio creado</span>';
					
					document.getElementsByName("params[mediaId]")[0].value = $("editedMediaResponseId").value;
					$("autocomplete_mediaId").value = $("editedMediaResponseName").value;
				}
			}
		);
	}
</script>

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
		|-if $configModule->get('headlines','uniqueByCampaigns')-|<div id="campaign" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_campaignId" label="Campaña" url="Main.php?do=campaignsAutocompleteListX" hiddenName="params[campaignId]" defaultHiddenValue=$headline->getCampaignId() defaultValue=$headline->getCampaign()-|
		</div>|-/if-|
		<div id="media" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" onChange="initialize();" id="autocomplete_mediaId" label="Medio" url="Main.php?do=mediasAutocompleteListX&lightboxId=lightbox_medias" hiddenName="params[mediaId]" defaultHiddenValue=$headline->getMediaId() defaultValue=$headline->getMedia() class="emptyValidation"-|
		</div>
			<p>
				<label for="params[name]">Titular</label>
				<input type="text" id="params[name]" name="params[name]" size="50" value="|-$headline->getname()|escape-|" title="Nombre" class="emptyValidation" /> |-validation_msg_box idField="params[name]"-|
			</p>
			<p>
				<label for="params[content]">Contenido</label>
					<textarea id="params[content]" name="params[content]" cols="75" rows="8" wrap="VIRTUAL" title="Contenido" class="emptyValidation">|-$headline->getContent()|escape-|</textarea> 
					|-validation_msg_box idField="params[content]"-|
			</p>
			<p>     
				<label for="params[datePublished]">Fecha de Publicación</label>
				<input id="params[datePublished]" name="params[datePublished]" type='text' value='|-$headline->getDatePublished()|dateTime_format-|' size="20" title="Ingrese la fecha de publicación" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[datePublished]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>     
				<label for="params[headlineDate]">Fecha del Titular</label>
				<input id="params[headlineDate]" name="params[headlineDate]" type='text' value='|-$headline->getHeadlineDate()|dateTime_format-|' size="20" title="Ingrese la fecha de titular" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[headlineDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
		<p>
			<label for="params[url]">Url</label>
			<input id="params[url]" name="params[url]" type='text' value='|-$headline->getUrl()-|' size="65" title="Ingrese el url del titular incluyendo el http://" />|-if $headline->getUrl() ne ''-| <a href="|-$headline->getUrl()-|" target="_blank" title="Ir a nota original" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a> |-/if-|
			|-if $headline->getStrategy() neq 'feed'-|
				|-if $headline->hasClipping()-|<a href="Main.php?do=headlinesViewClipping&id=|-$headline->getId()-|" title="Ver recorte"><img src="images/clear.png" class="icon iconNewsClipping" /></a>|-else-|<a href="Main.php?do=headlinesRenderUrl&id=|-$headline->getId()-|" title="Generar recorte"><img src="images/clear.png" class="icon iconNewsAdd" /></a> |-/if-|
			|-else-|
				|-if $headline->getHeadlineAttachments()|count gt 0-|<a href="Main.php?do=headlinesViewAttachments&id=|-$headline->getId()-|" title="Ver archivos adjuntos"><img src="images/clear.png" class="icon iconNewsClipping" /></a>|-else-||-/if-|
			|-/if-|
			</p>
			<p>     
				<label for="params[author]">Participante</label>
				<input id="params[author]" name="params[author]" type='text' value='|-$headline->getAuthor()-|' size="80" title="Participante" />
			</p>
	<p>
		<label for="params_classKey">Tipo de titular</label>
		|-if $headline->getStrategy() ne 'feed'-|<select id="params_classKey" name="params[classKey]" title="Tipo de titular"  onChange="classKeyForm('params_classKey');" >
			<option value="">Seleccione tipo de titular</option>
			|-foreach from=$headlineTypes key=key item=name-|
						<option value="|-$key-|" |-$headline->getClassKey()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
		|-else-|
		<input type="text" value="|-$headlineTypes[$headline->getClassKey()]-|" readonly="readonly">
		|-/if-|
	</p>

			<div id="pressHeadline" style="display:|-if $headline->getClassKey() eq 2-|block|-else-|none|-/if-|">
			<p>     
				<label for="params_picture_press">Foto</label>
				<select id="params_picture_press" name="params[picture]" title="Indique si incluye foto">
					<option value="0" |-$headline->getPicture()|selected:0-|>No</option>
					<option value="1" |-$headline->getPicture()|selected:1-|>Sí</option>
				</select>
			</p>
			<p>     
				<label for="params[section]">Sección</label>
				<input id="params[section]" name="params[section]" type='text' value='|-$headline->getSection()-|' size="40" title="Sección" />
			</p>
			<p>     
				<label for="params[page]">Página</label>
				<input id="params[page]" name="params[page]" type='text' value='|-$headline->getPage()-|' size="5" title="Página" />
			</p>
			<p>     
				<label for="params_length_press">Superficie</label>
				<input id="params_length_press" name="params[length]" type='text' value='|-$headline->getLength()-|' size="5" title="Superficie" /> mm2
			</p>
			<p>     
				<label for="params_author_press">Participante</label>
				<input id="params_author_press" name="params[author]" type='text' value='|-$headline->getAuthor()-|' size="80" title="Participante" />
			</p>
			</div><!--end pressHeadline-->

			<div id="multimediaHeadline" style="display:|-if $headline->getClassKey() eq 3-|block|-else-|none|-/if-|">
			<p>     
				<label for="params[program]">Programa</label>
				<input id="params[program]" name="params[program]" type='text' value='|-$headline->getProgram()-|' size="40" title="Programa" />
			</p>
			<p>     
				<label for="params_program_length">Duración</label>
				<input id="params_length_multimedia" name="params[length]" type='text' value='|-$headline->getLength()-|' size="5" title="Duración"/> segs
			</p>
			<p>     
				<label for="params_author_multimedia">Participante</label>
				<input id="params_author_multimedia" name="params[author]" type='text' value='|-$headline->getAuthor()-|' size="80" title="Participante" />
			</p>
			</div><!--end multimediaHeadline-->

			<div id="webHeadline" style="display:|-if $headline->getClassKey() eq 4-|block|-else-|none|-/if-|"><p>     
				<label for="params_picture_web">Foto</label>
				<select id="params_picture_web" name="params[picture]" title="Indique si incluye foto">
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
			</div><!--end webHeadline-->

			<p>
				<label for="params[value]">Valoración</label><div class="optionEncolsure">
				<input name="params[value]" type="hidden" value="0" />
				<span class="radioOption"> Muy positivo <input name="params[value]" type="radio" value="1" |-$headline->getValue()|checked:1-| title="Seleccione el valor de la noticia" /></span>
				<span class="radioOption"> Positivo <input name="params[value]" type="radio" value="2" |-$headline->getValue()|checked:2-| title="Seleccione el valor de la noticia" /></span>
				<span class="radioOption"> Neutro <input name="params[value]" type="radio" value="3" |-$headline->getValue()|checked:3-| title="Seleccione el valor de la noticia" /></span>
				<span class="radioOption"> Negativo <input name="params[value]" type="radio" value="4" |-$headline->getValue()|checked:4-| title="Seleccione el valor de la noticia" /></span>
				<span class="radioOption"> Muy negativo <input name="params[value]" type="radio" value="5" |-$headline->getValue()|checked:5-| title="Seleccione el valor de la noticia" /></span>
				</div>
			</p>
			<p>
				<label for="params[relevance]">Relevancia</label><div class="optionEnclosure">
				<input name="params[relevance]" type="hidden" value="0" />
				<span class="radioOption"> Muy relevante <input name="params[relevance]" type="radio" value="1" |-$headline->getRelevance()|checked:1-|/></span>
				<span class="radioOption"> Relevante <input name="params[relevance]" type="radio" value="2" |-$headline->getRelevance()|checked:2-|/></span>
				<span class="radioOption"> Poco relevante <input name="params[relevance]" type="radio" value="3" |-$headline->getRelevance()|checked:3-|/></span>
				<span class="radioOption"> Muy poco relevante <input name="params[relevance]" type="radio" value="4" |-$headline->getRelevance()|checked:4-|/></span>
				</div>
			</p>
	<p>
		<label for="params_agenda">Agenda</label>
		<select id="params_agenda" name="params[agenda]" title="Agenda">
			<option value="">Seleccione agenda</option>
			|-foreach from=$headlineAgendas key=key item=name-|
						<option value="|-$key-|" |-$headline->getAgenda()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>

			<p>
				<label for="params[processed]">Procesado</label>
				<input name="params[processed]" type="hidden" value="0" />
				<input name="params[processed]" type="checkbox" value="1" |-$headline->getProcessed()|checked_bool:1-| />
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

<script type="text/javascript">
	function classKeyForm(elementId) {
			var selectType = document.getElementById(elementId);
			var chosenOption = selectType.options[selectType.selectedIndex];
			switch(chosenOption.value) {
					case '2':
							$('pressHeadline').show();
							$('multimediaHeadline').hide();
							$('webHeadline').hide();
							disableInputId('params_picture_web');
							enableInputId('params_picture_press');
							disableInputId('params_length_multimedia');
							enableInputId('params_length_press');
							break;
					case '3':
							$('multimediaHeadline').show();
							$('pressHeadline').hide();
							$('webHeadline').hide();
							disableInputId('params_length_press');
							enableInputId('params_length_multimedia');
							break;
					case '4':
							$('webHeadline').show();
							$('pressHeadline').hide();
							$('multimediaHeadline').hide();
							disableInputId('params_picture_press');
							enableInputId('params_picture_web');
							break;
					default:
							$('pressHeadline').hide();
							$('multimediaHeadline').hide();
							$('webHeadline').hide();
			}
	}
	function disableInputId(elementId) {
		document.getElementById(elementId).disable();
	}
	function enableInputId(elementId) {
		document.getElementById(elementId).enable();
	}
</script>

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
	<legend>Relación con ##issues,1,Asuntos##</legend>
	<div id="issueMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="headlineIssue" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_issues" label="Relacionar con ##issues,4,asunto##" url="Main.php?do=issuesAutocompleteListX&getCandidates=1&headlineId="|cat:$headline->getId() hiddenName="issue[id]" disableSubmit="addIssueSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="headlinesDoAddIssueX" />
		<input type="hidden" name="headlineId" id="headlineId" value="|-$headline->getId()-|" /> 
    <input type="button" id="addIssueSubmit" disabled="disabled" name="addIssueSubmit" value="Agregar ##issues,4,asunto## al ##headlines,4,titular##" title="Agregar ##issues,4,asunto## al ##headlines,4,titular##" onClick="javascript:addIssueToHeadline(this.form)"/> </p>
	</form>
  <div id="headlinesIssuesList">
		<ul id="issueList" class="iconOptionsList">
			|-foreach from=$headline->getIssues() item=issue-|
			<li id="issueListItem|-$issue->getId()-|">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="headlinesDoRemoveIssueX" /> 
							<input type="hidden" name="headlineId" value="|-$headline->getid()-|" /> 
							<input type="hidden" name="issueId" value="|-$issue->getid()-|" /> 
							<input type="button" name="submit_go_remove_issue" value="Eliminar" onclick="if (confirm('Seguro que desea quitar el ##issues,4,asunto## del ##headlines,4,titular##?')) removeIssueFromHeadline(this.form);" class="icon iconDelete" /> 
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