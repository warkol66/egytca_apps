|-if isset($embedded)-|
|-/if-|
<div id="tweetsFilters">
<form action="Main.php" method="get">
	<fieldset title="Formulario de Opciones de búsqueda de tweets">
		<legend>Opciones de Búsqueda</legend>
		<p>
			<label for="filters[campaignId]">Campaña</label>
			<select name="filters[campaignid]" id="selectTwitterCampaign">
				<option value="">Sin seleccionar</option>
				|-foreach from=$campaigns item=campaign-|
					<option value="|-$campaign->getId()-|" |-$filters['campaignid']|selected:$campaign->getId()-| >|-$campaign->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="fromDate">Fecha desde</label>
			<input id="filters[dateRange][createdat][min]" name="filters[dateRange][createdat][min]" type="text" value="|-$filters.dateRange.createdat.min|date_format:"%d-%m-%Y"-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[dateRange][createdat][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde dd-mm-aaaa">
		</p>
		<p>
			<label for="toDate">Fecha hasta</label>
			<input id="filters[dateRange][createdat][max]" name="filters[dateRange][createdat][max]" type="text" value="|-$filters.dateRange.createdat.max|date_format:"%d-%m-%Y"-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[dateRange][createdat][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta dd-mm-aaaa">
		</p>
		<p>
				<label for="filters[processed]">Procesados</label>
				Todos <input name="filters[processed]" type="radio" value="-1" |-if isset($filters.processed)-||-$filters.processed|checked:-1-||-/if-| />
				Sin procesar <input name="filters[processed]" type="radio" value="0" |-if isset($filters.processed)-||-$filters.processed|checked:0-||-/if-| />
				Procesados <input name="filters[processed]" type="radio" value="1" |-if isset($filters.processed) -||-$filters.processed|checked:1-||-/if-| />
		</p>
		<p>
			<input type="hidden" name="do" value="twitterList" />
			<input type="submit" value="Filtrar">
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=twitterList'"/>|-/if-|
		</p>
	</fieldset>
</form>
</div>
<div id="twitterResultsDiv"></div>
<div id="tweetsList">
	<table id="tabla-tweets" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
			<tr class="thFillTitle"> 
					<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" /></th>
					<th width="60%">Texto</th> 
					<th width="18%">Usuario</th> 
					<th width="5%">Fecha</th> 
					<th width="5%">Valoración</th> 
					<th width="5%">Relevancia</th> 
					<th width="5%">Estado</th> 
				</tr> 
		</thead>
		<tbody>|-if $twitterTweetColl|@count eq 0-|
			<tr>
				 <td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">Aún no hay tweets en esta campaña</td>
			</tr>
		|-else-|
			|-foreach from=$twitterTweetColl item=tweet name=for_tweets-|
			|-assign var=user value=$tweet->getTwitterUser()-|
			<tr>
				<td align="center"><input type="checkbox" name="selected[]" value="|-$tweet->getId()-|"></td>
				<td class="twitterTextTable">|-$tweet->getText()|twitterHighlight-|</td>
				<td>|-$user->getName()-|</td>
				<td nowrap="nowrap">|-$tweet->getCreatedat()|date_format:"%d-%m-%Y %H:%m"-|</td>
				<td>
					<form action="Main.php" method="post" id="formValueTweets|-$tweet->getId()-|">
						<select name="params[value]" id="selectTweetValue|-$tweet->getId()-|" onChange="javascript:twitterDoEditValue(this.form);">
								<option value="0">Sin seleccionar</option>
							|-foreach from=$tweetValues key=key item=name-|
								<option value="|-$key-|" |-$tweet->getValue()|selected:$key-|>|-$name-|</option>
							|-/foreach-|
						</select>											
						<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
						<input type="hidden" name="do" value="twitterDoEditX" id="do">
					</form>
				</td> 
				<td>
					<form action="Main.php" method="post" id="formRelevanceTweets|-$tweet->getId()-|">
						<select name="params[relevance]" id="selectTweetRelevance|-$tweet->getId()-|" onChange="javascript:twitterDoEditValue(this.form);">
								<option value="0">Sin seleccionar</option>
							|-foreach from=$tweetRelevances key=key item=name-|
								<option value="|-$key-|" |-$tweet->getRelevance()|selected:$key-|>|-$name-|</option>
							|-/foreach-|
						</select>											
						<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
						<input type="hidden" name="do" value="twitterDoEditX" id="do">
					</form>
				</td> 
				<td>
					<form action="Main.php" method="post" id="formStatusTweets|-$tweet->getId()-|">
						<select name="params[status]" id="selectTweetStatus|-$tweet->getId()-|" onChange="javascript:twitterDoEditValue(this.form);">
							|-foreach from=$tweetStatuses key=key item=name-|
								<option value="|-$key-|" |-$tweet->getStatus()|selected:$key-|>|-$name-|</option>
							|-/foreach-|
						</select>											
						<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
						<input type="hidden" name="do" value="twitterDoEditX" id="do">
					</form>
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
	</script>
</div>
