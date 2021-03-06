|-if !$notValidId-|
|-if !$report-|
|-include file="CommonAutocompleterInclude.tpl"-|
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="scripts/lightbox.js"></script>
<script src="scripts/jquery/jquery.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery-ui-1.10.3.custom.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery.ui.datepicker-es.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery/fancyapps/source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" language="javascript" charset="utf-8">

var $j = jQuery.noConflict();

$j(document).ready(function($) {
	$.datepicker.setDefaults($.datepicker.regional['es']);
    $( ".datepickerFrom" ).datepicker({
		dateFormat:"dd-mm-yy",
		onClose: function(selectedDate) {
            $(".datepickerTo").datepicker("option", "minDate", selectedDate);
        }
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	$(".datepickerTo").datepicker({
		dateFormat:"dd-mm-yy",
		onClose: function(selectedDate) {
            $(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
        }
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	$(".datepickerDocuments").datepicker({
		dateFormat:"dd-mm-yy"
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
});

function addParticipantToCampaign(form) {
		$j.ajax({
			url: url,
			data: $j(form).serialize(),
			type: 'post',
			success: function(data){
				$j('#participantsList').html(data);
			}
		});
		$j('#partieMsgField').html('<span class="inProgress">agregando participante a campaña...</span>');
		return true;
	}

	function addParticipantToCampaign(form) {
		$j.ajax({
			url: url,
			data: $j(form).serialize(),
			type: 'post',
			success: function(data){
				$j('#participantsList').html(data);
			}
		});
		$j('#partieMsgField').html('<span class="inProgress">agregando participante a campaña...</span>');
		return true;
	}

	function deleteParticipantFromCampaign(form){
		$j.ajax({
			url: url,
			data: $j(form).serialize(),
			type: 'post',
			success: function(data){
				$j('#partieMsgField').html(data);
			}
		});
		$j('#partieMsgField').html('<span class="inProgress">eliminando participante...</span>');
		return true;
	}

	function showParticipantType(type) {
		if (type == "Actor") {
			$j('#participantActor').show();
			$j('#participantUser').hide();
		}
		if (type == "User") {
			$j('#participantActor').hide();
			$j('#participantUser').show();
		}	
	}

	function clearElement(element) {
		$j('#' + element).html('');
	}

	function getTrendingTopics(){
		$j.ajax({
			url: 'Main.php?do=twitterTrendingTopicsSearchX',
			type: 'post',
			success: function(data){
				$j('#trendingTopicsList').html(data);
			}
		});
		$j('#trendingTopicsList, #ttDateField').html('');
		$j('#ttMsgField').html('<span class="inProgress">Actualizando Trending Topics...</span>');
		return false;
	}

	function viewTT(form) {
		$j.ajax({
			url: 'Main.php?do=twitterTrendingTopicsSearchX',
			type: 'post',
			data: $j(form).serialize(),
			success: function(data){
				$j('#trendingTopicsList').html(data);
			}
		});
		$j('#trendingTopicsList, #ttDateField').html('');
		$j('#ttMsgField').html('<span class="inProgress">buscando trending topics...</span>');
		return false;
	}
</script>
<div id="lightbox2" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p> 
	|-include file="ActorsEditInclude.tpl"-|
</div> 
|-if $campaign->getTwitterCampaign()-|
	|-include "TwitterQueryBuilderLightboxInclude.tpl"-|
|-/if-|
<h2>Campañas</h2>
<h1>|-if $campaign->isNew()-|Crear|-else-|Editar|-/if-| Campaña</h1>
<div id="div_campaign">
	<p>Ingrese los datos del Campaña</p>
		<p align="right"><a href="#" class="iconTextLink" onClick="location.href='Main.php?do=campaignsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"><img src="images/clear.png" class="iconFollow iconSize">Volver al listado</a> &nbsp;&nbsp; |-if !$campaign->isNew()-| 
			|-if !$campaign->getTwitterCampaign()-| 
			<a class="iconTextLink" href="Main.php?do=headlinesParsedList&filters[campaignid]=|-$campaign->getId()-|"><img src="images/clear.png" class="iconNews iconSize">Obtener Titulares</a>&nbsp; &nbsp; <a class="iconTextLink" href="Main.php?do=campaignsEdit&report=1&id=|-$campaign->getId()-|"><img src="images/clear.png" class="iconPrint iconSize">Generar Reporte</a>
			|-else-|
			<a class="iconTextLink" href="Main.php?do=twitterParsedList&filters[campaignid]=|-$campaign->getId()-|"><img src="images/clear.png" class="iconTwitter iconSize">Obtener Tweets</a>&nbsp; &nbsp; <a class="iconTextLink" href="Main.php?do=twitterList&filters[campaignid]=|-$campaign->getId()-|&filters[fromCampaign]=1"><img src="images/clear.png" class="iconTwitter iconSize">Administrar Tweets</a>&nbsp; &nbsp; <a class="iconTextLink" href="Main.php?do=twitterCampaignsReportView&id=|-$campaign->getId()-|"><img src="images/clear.png" class="iconPrint iconSize">Generar Reporte</a>
			|-/if-|
		|-/if-|
		</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Campaña guardada correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar la campaña</div>
	|-/if-|
	<form name="form_edit_campaign" id="form_edit_campaign" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de una Campaña">
			<legend>Formulario de Administración de Campañas</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input name="params[name]" type="text" id="params[name]" title="Nombre" value="|-$campaign->getName()|escape-|" size="50" class="emptyValidation"> |-validation_msg_box idField="params[name]"-|
			</p>
			<p>
				<label for="params[twitterCampaign]">Es campaña de Twitter</label>
				<input name="params[twitterCampaign]" type="hidden" value="0" />
				<input type="checkbox" name="params[twitterCampaign]" value="true" |-if $campaign->getTwitterCampaign()-|checked|-/if-|> 
			</p>
			<p>
				<label for="params[type]">Tipo</label>
				<select id="params[type]" name="params[type]" title="Tipo de Campaña" class="emptyValidation"> 
					<option value="">Seleccione tipo</option>
					|-foreach from=$types item=typeName key=typeKey name=for_types-|
					<option value="|-$typeKey-|" |-$campaign->getType()|selected:$typeKey-|>|-$typeName|multilang_get_translation:"campaigns"-|</option>
					|-/foreach-|
      </select> |-validation_msg_box idField="params[type]"-|
			</p>
			<p> 
				<label for="params[startDate]">Fecha de Inicio</label>
				<input name="params[startDate]" type="text" id="params[startDate]" class="datepickerFrom dateValidation emptyValidation" title="fromDate" value="|-$campaign->getstartDate()|date_format:"%d-%m-%Y"-|" size="12" />
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha"> |-validation_msg_box idField="params[startDate]"-|</p> 
			<p> 
				<label for="params[finishDate]">Fecha de Finalización</label>
				<input name="params[finishDate]" type="text" id="params[finishDate]" class="datepickerTo dateValidation emptyValidation" title="fromDate" value="|-$campaign->getfinishDate()|date_format:"%d-%m-%Y"-|" size="12" />
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha"> |-validation_msg_box idField="params[finishDate]"-|</p> 
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="70" rows="6" wrap="virtual" id="params[description]" title="Descripción">|-$campaign->getdescription()|escape-|</textarea>
			</p>
		|-if class_exists('Client')-|<div id="client" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_clientId" label="Cliente" url="Main.php?do=commonAutocompleteListX&object=client" hiddenName="params[clientId]" defaultHiddenValue=$campaign->getClientId() defaultValue=$campaign->getClient()-|
		</div>|-/if-|
			|-if !$campaign->getTwitterCampaign()-|
				<p>
					<label for="params[defaultKeywords]">Palabras clave</label>
					<input name="params[defaultKeywords]" type="text" id="params[defaultKeywords]" title="Estas palabras clave son las que propondrá por defecto para la búsqueda" value="|-$campaign->getDefaultKeywords()|escape-|" size="50">
					<a class="tooltipWide" href="#"><span>Las palabras clave se muestran por defecto antes de realizar la búsqueda de titulares, puede agregar o eliminar palabras antes de buscar.<br />Utilice comillas para búsquedas de varias palabras literales.</span><img src="images/icon_info.png"></a>
				</p>
			|-else-|
				|-include "CampaignsTwitterSearchQueriesInclude.tpl" useLightbox=true-|
			|-/if-|
			
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
				|-if $campaign->isNew()-|
			<p>* Para agregar información sobre participantes o anexar documentos, debe guardar primero el campaña. </p>
				|-else-|
					<input type="hidden" name="id" id="id" value="|-$campaign->getid()-|" />
			|-/if-|
			<p>
				|-include file="HiddenInputsInclude.tpl" filters="$filters" page="$page"-|
				<input type="hidden" name="do" id="do" value="campaignsDoEdit" />
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" id="cancel" name="cancel" title="Volver al listado" value="Volver al listado" onClick="location.href='Main.php?do=campaignsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if !$campaign->isNew()-|
<fieldset title="Formulario de edición de participantes asociadas al campaña">
	<legend>Participantes</legend>
<div id="PartyAdding"> <span id="partieMsgField"></span> 
  <form method="post" name="party_add_form" id="party_add_form"> 
		<p>
			<label>El participante es</label>
			<input type="radio" name="participant[type]" value="Actor" onclick="showParticipantType(this.value)" checked="checked" title="Si el participante no está en el listado de usuarios del sistema" />Actor
			<a class="tooltipWide" href="#"><span>Sólo podrá agregar Actores que estén cargados en el sistema.</span><img src="images/icon_info.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#lightbox2" rel="lightbox2" class="lbOn addLink">Crear nuevo actor </a> <br />
			<input type="radio" name="participant[type]" value="User" onclick="showParticipantType(this.value)" title="Para incluir como participante a personas de la institución y con usuario del sistema" />Usuario
		</p>

		<div id="participantActor" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="Actor" url="Main.php?do=actorsAutocompleteListX&getCandidates=1&campaignId="|cat:$campaign->getId() hiddenName="participant[actorId]" disableSubmit="addParticipant"-|
		</div>
	
		<div id="participantUser" style="display:none; position: relative;z-index:10000">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_users" label="Usuario" url="Main.php?do=usersAutocompleteListX&getCandidates=1&campaignId="|cat:$campaign->getId() hiddenName="participant[userId]" disableSubmit="addParticipant"-|
		</div>
	<p>
      <input type="hidden" name="do" id="do" value="campaignsDoAddParticipantX" /> 
      <input type="hidden" name="campaignId" id="campaignId" value="|-$campaign->getId()-|" /> 
      <input type="button" id="addParticipant" value="Agregar participante a campaña" disabled onClick="javascript:addParticipantToCampaign(this.form)"/> 
    </p> 
  </form> 
	<h3>Participantes</h3>
  <div id="participantsList">
	|-include file="CampaignsParticipantsInclude.tpl"-|
  </div>	
</div>
</fieldset>
<div id="lightbox1" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p>
	|-include file="CampaignsCommitmentForm.tpl"-|
</div> 
<fieldset title="Formulario de edición de compromisos asociadas al campaña">
	<legend>Compromisos</legend>
|-assign var=commitments value=$campaign->getCampaignCommitments()-|
			<div id="commitmentInfo"></div>
		<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders" id="commitmentsList">
			<th colspan="6" class="thFillTitle"><form name="campaign_add_commitment"><div class="rightLink" onclick="clearCommitmentForm();"><input type="hidden" name="do" value="campaignsCommitmentEditX" /><input name="commitmentId" value="" type="hidden"><a href="#lightbox1" rel="lightbox1" class="lbOn addLink">Agregar compromiso</a></div></form></th>
			<tr class="thFillTitle">
				<th width="50%">Compromiso</th>
				<th width="40%">Responsable</th>
				<th width="5%">Fecha</th>
				<th width="5%">Cumplido</th>
				<th width="5%"></th>
			</tr>
			<tbody>
|-if $commitments|@count gt 0-|
     |-foreach from=$commitments item=commitment name=for_commitments-|
			<tr id="row_|-$commitment->getId()-|">
			 <td>|-$commitment->getCommitment()-|</td>
			 <td>|-$commitment->getResponsible()-|</td>
			 <td align="center">|-$commitment->getDate()|date_format-|</td>
			 <td align="center">|-$commitment->getAchieved()|yes_no|multilang_get_translation:"common"-|</td>
			 <td nowrap="nowrap">|-if "campaignsCommitmentEditX"|security_has_access-|
			 <form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="campaignsCommitmentEditX" /> 
					<input type="hidden" name="id" value="|-$commitment->getid()-|" />
					<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" name="submit_go_delete_campaign" value="Editar" title="Editar" onclick="editCommitment(this.form);" class="icon iconEdit" /></a>
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="campaignsCommitmentDoDeleteX" /> 
					<input type="hidden" name="id" value="|-$commitment->getid()-|" /> 
					<input type="button" name="submit_go_delete_campaign" value="Borrar" title="Borrar" onclick="javascript: if (confirm('Seguro que desea eliminar este compromiso?')){deleteCommitment(this.form)}; return false" class="icon iconDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="campaignsCommitmentDoDeleteX" /> 
					<input type="hidden" name="id" value="|-$commitment->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="button" name="submit_go_delete_campaign" value="Borrar definitivamente" title="Borrar definitivamente" onclick="javascript: if (confirm('Seguro que desea eliminar este compromiso definitivamente?')){deleteCommitment(this.form)}; return false" class="icon iconHardDelete" /> 
			</form>|-/if-||-/if-|</td>
		  </tr>
    |-/foreach-|
|-/if-|
		</tbody>
		</table>
</fieldset>
	|-include file="DocumentsListInclude.tpl" entity="Campaign" entityId=$campaign->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="Campaign" entityId=$campaign->getId()-|
|-/if-|

|-if $acceptedTweets|count gt 0 or isset($twitterFilters)-| |-*/Si tiene tweets*-|
<fieldset>
	<legend>Trending Topics  &nbsp; &nbsp; <button type="button" onclick="getTrendingTopics();return false;"><img src="images/clear.png" class="iconTwitter iconSize">Obtener Trending Topics</button></legend>
	
	<div id="trendsContainer">
<form name="form_edit_trends" id="form_edit_trends" action="Main.php" method="post">	
				<input type="hidden" name="dateShowing" id="dateShowing" value="|-$dateShowing-|"/>
				<input type="hidden" name="do" value="twitterTrendingTopicsViewX"/>
				<input type="hidden" name="TTview" id="TTview" value=""/>
		<table width="380" border="0" cellpadding="5" cellspacing="0">
			<tr height="40">
          <td>&nbsp;</td>
          <td><div id="ttDateField"><span class="resultSuccess">Trending topics del |-$dateShowing|date_format:"%d-%m-%Y"-|</span></div></td>
          <td>&nbsp;</td>
        </tr>
      <tr height="170">
    <td width="40" align="center" valign="middle">
		<div id="otherTrends">
				<input type="button" id="previous" value="ver día anterior" title="ver día anterio" onClick="javascript: $('TTview').setValue('previous'); viewTT(this.form);" class="icon iconBack" />
		</div>
		</td>
    <td width="300"><div id="ttMsgField"></div><div id="trendingTopicsList">|-include file="TwitterTrendingTopicsList.tpl" twitterTrendingTopicsColl=$latestTopics-|</div></td>
    <td width="20" align="center" valign="middle"><input type="button" id="next" value="ver próximo día" title="ver próximo día" onClick="javascript: $('TTview').setValue('next'); viewTT(this.form); return false;" class="icon iconGoTo" |-if $dateShowing eq $currentDate-|style="display: none;"|-/if-|/></td>
  </tr>
</table>
</form>

		
		
		
	</div>
</fieldset>
|-/if-||-*/Si tiene tweets*-|

|-if $campaign->getHeadlines()|count gt 0-|
|-assign var=headlines value=$campaign->getHeadlines()-|
<div id="div_headlines"> 
<h4>Titulares</h4>
	<table id="tabla-headlines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr class="thFillTitle"> 
				<th width="1%">&nbsp;</th> 
				<th width="20%">##headlines,2,Titulares##</th>
				<th width="10%">Medio</th>
				<th width="59%">##headlines,3,Contenido##</th> 
				<th width="1%">&nbsp;</th> 
				<th width="1%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>
		|-foreach from=$headlines item=headline name=for_headlines-|
		<tr> 
				<td>|-if $headline->hasClipping()-|<a href="Main.php?do=headlinesGetClipping&image=|-$headline->getId()-|.jpg" title="Ver recorte" class="icon iconNewsClipping" target="_blank"></a>|-/if-|</td>
				<td>|-$headline->getName()-|</td>
				<td>|-$headline->getMedia()-|</td>
				<td>|-$headline->getContent()|truncate:800:"..."-|</td>
				<td nowrap="nowrap"|-if $headline->processed()-| class="processed"|-/if-|>|-if $headline->getUrl() ne ''-| <a href="|-$headline->getUrl()-|" target="_blank" title="Ir a nota original" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a> |-/if-|
				
			<td nowrap>|-if "headlinesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="submit" name="submit_go_edit_headline" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form>|-/if-|
				|-if "headlinesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="submit" name="submit_go_delete_headline" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##headlines,2,Titular##?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 						</tr> 
		|-/foreach-|
		</tbody> 
 </table> 
</div>
|-/if-|

|-else-||-*Si es reporte*-|
|-assign var=headlines value=$campaign->getHeadlines()-|
<h1>|-$campaign->getName()-|</h1> 
<h2>Resumen</h2>
		<p>Tipo: |-$campaign->getTypeTranslated()-| - Período: |-$campaign->getStartDate()|date_format:"%d-%m-%Y"-| al |-$campaign->getFinishDate()|date_format:"%d-%m-%Y"-|</p> 
		<p>|-$campaign->getDescription()-|</p>
|-if $campaign->getHeadlines()|count gt 0-|
<table border="1">
	<tr>
			<th>Medio</th>
			<th>Fecha</th>
			<th>Publicación</th>
			<th>Tipo</th>
			<th>Foto</th>
			<th>Twitts</th>
			<th>Fcb</th>
			<th>G+</th>
			<th>Coment.</th>
			<th>Importancia</th>
			<th>Valoración</th>
			<th>Relevancia</th>
			<th>Actores</th>
	</tr>
	|-foreach from=$headlines item=headline name=for_headlines-|
	<tr>
			<td>|-$headline->getMedia()-|</td>
			<td>|-$headline->getHeadlineDate()|date_format-|</td>
			<td>|-$headline->getDatePublished()|date_format-|</td>
			<td>|-*$media->getType()*-|</td>
			<td>|-$headline->getPicture()|si_no-|</td>
			<td>|-$headline->getTwitts()-|</td>
			<td>|-$headline->getFcb()-|</td>
			<td>|-$headline->getGplus()-|</td>
			<td>|-$headline->getComment()-|</td>
			<td>|-$headline->getImportance()-|</td>
			<td>|-$headline->getValue()-|</td>
			<td>|-$headline->getRelevance()-|</td>
		<td>|-if $headline->getActors()|count gt 0-|<ul>|-foreach from=$headline->getActors() item=actor-|
						<ul>|-$actor-|</ul>
				|-/foreach-|</ul>|-/if-|
</td>
	</tr>
	|-/foreach-|
</table>		
	
<h2>Clipping de repercusiones de prensa - |-$campaign->getClient()-|</h2>
		<p>|-foreach from=$campaign->getCampaignParticipants() item=party name=for_parties-|<ul>
	 |-if $party->getObject() != NULL-||-assign var=partyObject value=$party->getObject()-||-$partyObject->getName()-| |-$partyObject->getSurname()-||-if $party->getObjectType() eq 'Actor' && $partyObject->getInstitution() ne ''-| (|-$partyObject->getInstitution()-|)|-/if-||-/if-|<ul>
	|-/foreach-|</p> 
	<br style="page-break-after:auto">
<div id="div_headlines"> 
<h4>Clipping</h4>
	|-foreach from=$headlines item=headline name=for_headlines-|
			<p><strong>Medio: </strong>|-$headline->getMedia()-|</p>
			<p><strong>Titulo: </strong> <a href="|-$headline->getUrl()-|" target="_blank"> |-$headline->getName()-|</a></p>
			<p><strong>Fecha Publicación: </strong> |-$headline->getDatePublished()|date_format-|</p>
			<p>|-if $headline->hasClipping()-|<img src="Main.php?do=headlinesGetClipping&image=|-$headline->getId()-|.jpg" />|-/if-|</p>
	|-/foreach-|
	<br style="page-break-after:auto">
	

</div>
|-else-|
<p>No hay repercusiones de prensa asociadas</p>
|-/if-|
|-/if-||-*/Si es reporte*-|
|-else-||-*Si no es valido el id*-|
Debe elegir una campaña valida
|-/if-|
