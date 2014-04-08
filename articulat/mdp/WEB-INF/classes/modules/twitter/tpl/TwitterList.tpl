<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="Main.php?do=js&name=js&module=twitter&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui.css" />
<link rel="stylesheet" media="screen" type="text/css" href="scripts/jquery/fancyapps/source/jquery.fancybox.css?v=2.1.5" />
<link type="text/css" rel="stylesheet" href="scripts/jquery/jqueryTimepicker/src/jquery-ui-timepicker-addon.css" />
<script src="scripts/jquery/jquery.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jquery-ui-1.10.3.custom.min.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/jquery-ui-timepicker-addon.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/i18n/jquery-ui-timepicker-es.js" charset="utf-8"></script>
<script src="scripts/jquery/jqueryTimepicker/src/jquery-ui-sliderAccess.js" charset="utf-8"></script>
<script type="text/javascript" src="scripts/jquery/fancyapps/source/jquery.fancybox.js?v=2.1.5"></script>
<script> 
	var $j = jQuery.noConflict();

	$j(document).ready(function($) {
		$(".fancybox").fancybox({type: 'ajax'});
		$(".gallery").fancybox();

	});

	function setFbox(images){
		$j('#twitterAttachments').html('');

		$j.each(images, function(i, obj) {
			var im = $j('<img />')
				.addClass('gallery')
				.attr('src', obj)
				.attr('rel', 'attachments')
				.appendTo('#twitterAttachments');
		});

		$j('.gallery').fancybox().trigger('click');

	}
</script>
<div id="twitterAttachments" style="display: none"></div>
<div id="tweetsFilters"><a name="tweeterList"></a>
<form action="Main.php" method="get">
	<fieldset title="Formulario de Opciones de búsqueda de tweets">
		<legend>Opciones de Búsqueda</legend>
		|-if !isset($embedded)-|
		|-if !isset($fromCampaign)-|
		<p>
			<label for="filters[campaignid]">Campaña</label>
			<select name="filters[campaignid]" id="selectTwitterCampaign">
				<option value="">Sin seleccionar</option>
				|-foreach from=$activeCampaigns item=activeCampaign-|
					<option value="|-$activeCampaign->getId()-|" |-if $filters['campaignid'] eq $activeCampaign->getId()-|selected|-/if-|>|-$activeCampaign->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		|-/if-|
		<p>
			<label for="fromDate">Fecha desde</label>
			<input id="dateFrom" name="filters[dateFrom]" type="text" value="|-$filters.dateFrom|date_format:"%d-%m-%Y %H:%M"-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha desde dd-mm-aaaa">
		</p>
		<p>
			<label for="toDate">Fecha hasta</label>
			<input id="dateTo" name="filters[dateTo]" type="text" value="|-$filters.dateTo|date_format:"%d-%m-%Y %H:%M"-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha hasta dd-mm-aaaa">
		</p>
		<p>
				<label for="filters[processed]">Procesados</label>
				&nbsp; Todos <input name="filters[processed]" type="radio" value="0" |-$filters.processed|checked:0-| />
				&nbsp; Sólo procesados  <input name="filters[processed]" type="radio" value="1" |-$filters.processed|checked:1-| />
		</p>
		<p>
			<input type="hidden" name="do" value="twitterList" />
			<input type="submit" value="Filtrar">
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=twitterList'"/>|-/if-|
			|-if isset($fromCampaign) && isset($campaignid)-|<input type="button" id="return_button" onclick="location.href='Main.php?do=campaignsEdit&id=|-$campaignid-|'" value="Regresar a la campaña" />|-/if-|
		</p>
		|-else-||-*Si el list fue incluido los filtros son distintos*-|
			|-include file="TwitterFiltersInclude.tpl" campaignid=$campaignid-|
		|-/if-|
	</fieldset>
</form>
</div>
<div id="resultDiv"></div>
<div id="tweetsList">
	<table id="tabla-tweets" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
			<tr class="thFillTitle"> 
					<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" /></th>
					<th width="50%">Texto</th> 
					<th width="21%">Usuario</th> 
					<th width="5%">Fecha</th> 
					<th width="1%">Valoración</th> 
					<th width="1%">Relevancia</th> 
					<th nowrap width="2%">&nbsp;&nbsp;</th> 
				</tr> 
		</thead>
		<tbody>|-if $twitterTweetColl|@count eq 0-|
			<tr>
				 <td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">Aún no hay tweets en esta campaña</td>
			</tr>
		|-else-|
			|-foreach from=$twitterTweetColl item=tweet name=for_tweets-|
			|-assign var=user value=$tweet->getTwitterUser()-|
			<tr id="tr_|-$tweet->getId()-|">
				<td align="center"><input type="checkbox" name="selected[]" value="|-$tweet->getId()-|"></td>
				<td valign="top"class="twitterTextTable">|-$tweet->getText()|twitterHighlight-|</td>
				<td valign="top">|-if is_object($user)-|<a href="Main.php?do=twitterUsersViewX&id=|-$user->getId()-|" class="fancybox fancybox.ajax">|-$user->getName()-|</a>|-/if-|</td>
				<td valign="top" nowrap="nowrap">|-$tweet->getCreatedat()|date_format:"%d-%m-%Y %H:%m"|change_timezone-|</td>
				<td valign="top" nowrap="nowrap">
					<form action="Main.php" method="post" id="formValueTweets|-$tweet->getId()-|">
							|-foreach from=$tweetValues key=key item=name-|
								|-if $name@first-|<span class="radioLabelIcon">+</span>|-/if-|<input name="params[value]" type="radio" value="|-$key-|" title="|-$name-|" |-$tweet->getValue()|checked:$key-| onChange="javascript:twitterDoEditValue(this.form);"/>|-if $name@last-|<span class="radioLabelIcon">-</span>|-/if-|
							|-/foreach-|	
						<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
						<input type="hidden" name="do" value="twitterDoEditX" id="do">
					</form>
				</td> 
				<td valign="top" nowrap="nowrap">
					<form action="Main.php" method="post" id="formRelevanceTweets|-$tweet->getId()-|">
							|-foreach from=$tweetRelevances key=key item=name-|
								|-if $name@first-|<span class="radioLabelIcon">+</span>|-/if-|<input name="params[relevance]" type="radio" value="|-$key-|"  title="|-$name-|" |-$tweet->getRelevance()|checked:$key-| onChange="javascript:twitterDoEditValue(this.form);"/>|-if $name@last-|<span class="radioLabelIcon">-</span>|-/if-|
							|-/foreach-|
						<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
						<input type="hidden" name="do" value="twitterDoEditX" id="do">
					</form>
				</td> 
				<td valign="top">
					<form action="Main.php" method="post" id="formStatusTweets|-$tweet->getId()-|">
						<img src="images/clear.png" class="icon iconDelete" onClick='{new Ajax.Updater("resultDiv", "Main.php?do=twitterDoEditX&id=|-$tweet->getId()-|", { method: "post", parameters: { id: "|-$tweet->getId()-|", todo: "discard"}, evalScripts: true})};$("resultDiv").innerHTML = "<span class=\"inProgress\">descartando tweet...</span>";' value="Descartar tweet" />
						<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
						<input type="hidden" name="do" value="twitterDoEditX" id="do">
					</form>
					|-assign var=attachments value=$tweet->getTwitterAttachments()-|
					|-if count($attachments) gt 0-|
					<img src="images/clear.png" class="icon iconView" onClick='setFbox(|-$tweet->getAttachmentsPathJson()-|)' value="Descartar tweet" />
					|-/if-|
				</td> 
			</tr>
			|-/foreach-|
			</tbody> 
			<tfoot>
			|-if $twitterTweetColl|@count neq 0-|
				<tr>
					<td colspan="7">
						<form action="Main.php" method="post" id='multipleTweetsChangeValueForm'>
							<p>Cambiar la valoración de los tweets seleccionados a
								<select name="newValue" id="selectEntryStatus">
								|-foreach from=$tweetValues key=key item=name-|
									<option value="|-$key-|">|-$name-|</option>
								|-/foreach-|
								</select>
								|-if isset($pager)-|
									<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
								|-/if-|
								<input type="hidden" name="field" value="Value" id="field">
								<input type="hidden" name="do" value="twitterDoEditMultipleX" id="do">
								<input type="button" onClick="javascript:twitterDoEditMultiple(this.form,|-if isset($embedded)-|'acceptedResDiv'|-else-|'resultDiv'|-/if-|); return false;" value="Cambiar Valoracion" title="Cambiar Valoracion" class="button">
							</p>
						</form>
						<form action="Main.php" method="post" id='multipleTweetsChangeRelevanceForm'>
							<p>Cambiar la relevancia de los tweets seleccionados a
								<select name="newValue" id="selectTweetRelevance">
								|-foreach from=$tweetRelevances key=key item=name-|
									<option value="|-$key-|">|-$name-|</option>
								|-/foreach-|
								</select>
								|-if isset($pager)-|
									<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
								|-/if-|
								<input type="hidden" name="do" value="twitterDoEditMultipleX" id="do">
								<input type="hidden" name="field" value="Relevance" id="field">
								<input type="button" onClick="javascript:twitterDoEditMultiple(this.form,|-if isset($embedded)-|'acceptedResDiv'|-else-|'resultDiv'|-/if-|); return false;" value="Cambiar Relevancia" title="Cambiar Relevancia" class="button">
							</p>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
						</form>
					</td>
				</tr>
			|-/if-|
			|-if isset($pager) && ($pager->getLastPage() gt 1)-|
			<tr> 
				<td colspan="|-if class_exists('Client')-|7|-else-|7|-/if-|">|-include file="ModelPagerInclude.tpl"-|</td> 
			</tr>
			|-/if-|
		|-/if-|
	</table>
	<script type="text/javascript">
		function getCampaignTweets(form){
			$("tweetsList").innerHTML = " ";
			new Ajax.Updater('tweetsList', "Main.php?do=twitterListX", {
				parameters: Form.serialize(form),
				insertion: 'top',
				evalScripts: true
			});
			$("twitterResultsDiv").innerHTML = "<span class=\"inProgress\">Buscando tweets...</span>";
			return false;	
		}
		
	var startDateTextBox = $j('#dateFrom');
	var endDateTextBox = $j('#dateTo');
	
	startDateTextBox.datetimepicker({ 
		dateFormat: 'dd-mm-yy',
		timeFormat: 'HH:mm:ss',
		onClose: function(dateText, inst) {
			if (endDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					endDateTextBox.datetimepicker('setDate', testStartDate);
			}
			else {
				endDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			var select_dt = new Date(selectedDateTime);
			var original_end = endDateTextBox.val();
			var testEndDate = endDateTextBox.datetimepicker('getDate');
			endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
			if (original_end != '') {
	            if(testEndDate < select_dt){
	                endDateTextBox.val(selectedDateTime);
	            }else{
	                endDateTextBox.val(original_end);
	            }
	        }else{
	            endDateTextBox.val(selectedDateTime);
	        }
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	endDateTextBox.datetimepicker({
		dateFormat: 'dd-mm-yy', 
		timeFormat: 'HH:mm:ss',
		onClose: function(dateText, inst) {
			if (startDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					startDateTextBox.datetimepicker('setDate', testEndDate);
			}
			else {
				startDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			var select_dt = new Date(selectedDateTime);
	        var original_start = startDateTextBox.val();
	        var testStartDate = startDateTextBox.datetimepicker('getDate');
	        startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );

	        if (original_start != '') {
	            if(testStartDate > select_dt){
	                startDateTextBox.val(selectedDateTime);
	            }else{
	                startDateTextBox.val(original_start);
	            }
	        }else{
	            startDateTextBox.val(selectedDateTime);
	        }
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	</script>
</div>
