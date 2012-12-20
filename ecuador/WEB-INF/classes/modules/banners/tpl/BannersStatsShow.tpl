<script>
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
        $( ".datepickerFrom" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerTo").datepicker("option", "minDate", selectedDate);
            }
		});
		$(".datepickerTo").datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
            }
		});
    });
</script>
<h2>Banners</h2>
<h1>Consulta de estadísticas de Banners</h1>
<p>A continuación encontrará el listado de banners y sus estadísticas relacionadas. 
</p>
<form name="form_select_stats" id="form_select_stats" action="Main.php" method="get">
<fieldset>
	<legend>Filtros</legend>
	<p>Seleccione los filtros para ver las estadísticas de baners específicos</p>
	<p>
		<label for="clientId">Cliente</label>
		<select name="filters[clientId]" size="1">
			<option value="0">Seleccione un cliente</option>
		|-foreach from=$clients item=client name=for_clients-|
			<option value="|-$client->getId()-|" |-if isset($filters.clientId) and ($filters.clientId eq $client->getId())-|selected="selected"|-/if-|>|-$client->getName()|truncate:45:"..."-|</option>
		|-/foreach-|
		</select>
	</p>
	<p id="bannersList">
		<label for="bannerId">Banner</label>
		<select name="filters[id]" size="1">
			<option value="0">Seleccione un Banner</option>
		|-foreach from=$banners item=banner name=for_banners-|
			<option value="|-$banner->getId()-|" |-if isset($filters.id) and ($filters.id eq $banner->getId())-|selected="selected"|-/if-|>|-$banner->getName()|truncate:45:"..."-|</option>
		|-/foreach-|
		</select>
	</p>
	<p>
		<label for="zones">Zonas</label>
		<select name="filters[zones]" size="1">
			<option value="0">Seleccione una Zona</option>
		|-foreach from=$zones item=zone name=for_zones-|
			<option value="|-$zone->getId()-|" |-if isset($filters.zones) and ($filters.zones eq $zone->getId())-|selected="selected"|-/if-|>|-$zone->getName()|truncate:45:"..."-|</option>
		|-/foreach-|
		</select>
	</p>
	<p>
		<label for="initialDate">Fecha desde</label>
		<input name="initialDate" type="text" size="12" />
		<input name="filters[dateRange][campaignStartDate]" type="text" id="filters_dateRange_min" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.campaignStartDate|date_format:"%d-%m-%Y"-|" size="12" />			
		<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
	</p>
	<p>
		<label for="endDate">Fecha hasta</label>
		<input name="endDate" type="text" size="12" />
		<input name="filters[dateRange][campaignFinalDate]" type="text" id="filters_dateRange_max" class="datepickerTo" title="toDate" value="|-$filters.dateRange.campaignFinalDate|date_format:"%d-%m-%Y"-|" size="12" />
		<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
	</p>
	<p>
		<label for="groupByMonth">Agrupar Meses</label>
		<input name="groupByMonth" type="checkbox" value="1" />
	</p>
	<p>
		<label for="includeInactives">Incluir inactivos</label>
		<input name="inludeInactives" type="checkbox" value="1" />
	</p>
	<p>
		<input type='hidden' name='do' value='bannersStatsShow' />
		<input type="submit" id="button_request_stats" name="button_request_stats" title="Consultar" value="Consultar" />
	</p>
</fieldset>
</form>
|-* IMPORTANTE!!!!: 
Solo se hace display de banner si se hizo alguna selección de filtro
El listado de banners se muestra una vez seleccionado el cliente *-|
|-if $stats|@count gt 0-|
<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-bannersStats">
	<tr>
		<th>Banner</th>
		<th>Impresiones Restantes / Total</th>
		<th>Impresiones</th>
		<th>Click thru</th>
	</tr>
	|-foreach from=$BannerColl item=banner name=for_stats-|
	<tr>
		<td>|-$banner.NAME-|</td>
		<td>|-$banner.PRINTSLEFT-| / |-$banner.PRINTSTOTAL-|</td>
		<td>|-$banner.printsReached-|</td>
		<td>|-$banner.clickthru-|</td>
	</tr>
	|-/foreach-|
</table>
|-/if-|
