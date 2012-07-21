|-extends file="TemplateCalendar.tpl"-|
|-block name="dateFilter"-|
	<li class="pickDate">
		<input type="text" name="filters[minDate]" id="minDate" class="dateFilter" value="|-$filters.minDate-|" size="10" maxlength="10" style="position:relative;z-index: 1050;" />
		<input type="text" name="filters[maxDate]" id="maxDate" class="dateFilter" value="|-$filters.maxDate-|" size="10" maxlength="10" style="position:relative;z-index: 1050;" />
		<!-- <a href="javascript:document.filters.submit();" class="dateGo">Ir</a> -->
	</li>
	<script type="text/javascript">
		$(function() {
			$('#filters #input_do').val('calendarStatisticsShow');
			// Datepicker
			$('.dateFilter').datepicker({
				dateFormat: 'dd-mm-yy',
				changeYear: true,
				changeMonth: true,
				inline: true
			});
		});
	</script>
|-/block-|
|-block name="centralContent"-|
	|-if $useSolapas-|
		<div class="boxNavSolapas">
			<ul>
				|-foreach from=$axes item=axis-|
					<li class="|-$axis->getTabClass()-|" hide="|-$axis->getName()-|"><a href="#">|-$axis->getName()-|</a></li> 
				|-/foreach-|
			</ul>                                                                                    
		</div>
	|-/if-|
	<div class="clear"></div>
	<div>|-$centerHTML-|</div>
|-/block-|
|-block name="sidebar"-||-/block-| |-* no quiero la barra *-|
