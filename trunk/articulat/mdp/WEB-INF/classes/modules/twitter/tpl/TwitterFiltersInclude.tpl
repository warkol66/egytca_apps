		<p>
			<label for="fromDate">Fecha desde</label>
			<input id="twitter[filters][dateRange][createdat][min]" name="twitter[filters][dateRange][createdat][min]" type="text" value="|-$twitterFilters[filters][dateRange][createdat][min]|date_format:"%d-%m-%Y"-|" size="12" title="Fecha desde dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('twitter[filters][dateRange][createdat][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha desde dd-mm-aaaa">
		</p>
		<p>
			<label for="toDate">Fecha hasta</label>
			<input id="twitter[filters][dateRange][createdat][max]" name="twitter[filters][dateRange][createdat][max]" type="text" value="|-$twitterFilters[filters][dateRange][createdat][max]|date_format:"%d-%m-%Y"-|" size="12" title="Fecha hasta dd-mm-aaaa" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('twitter[filters][dateRange][createdat][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha hasta dd-mm-aaaa">
		</p>
		<p>
				<label for="twitter[filters][processed]">Procesados</label>
				&nbsp; Todos <input name="twitter[filters][processed]" type="radio" value="0" |-$filters.processed|checked:0-| />
				&nbsp; Sólo procesados <input name="twitter[filters][processed]"  type="radio" value="1" |-$filters.processed|checked:1-| />
		</p>
		<p>
			<input type="hidden" name="do" value="campaignsEdit" />
			<input type="hidden" name="id" value=|-$campaignid-| />
			<input type="hidden" name="twitter[filters][campaignid]" value=|-$campaignid-| />
			<input type="hidden" name="filters[anchor]" value="tweetsList" />
			<input type="submit" value="Filtrar">
			|-if $campaignFilters-||-$filters = $campaignFilters-||-/if-|
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=campaignsEdit&id=|-$campaign->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|#tweetsList'"/>|-/if-|
		</p>
