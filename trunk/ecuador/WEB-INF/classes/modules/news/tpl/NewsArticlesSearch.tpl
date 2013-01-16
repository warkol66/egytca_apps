<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
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
<div id="searchForm">

	<form action="Main.php" method="get" accept-charset="utf-8">
<fieldset>
		<p>
			<label for="searchString">Buscar</label>
			<input type="hidden" name="do" value="newsArticlesSearch" id="do" />
			<input type="text" name="searchString" value="|-if isset($searchString)-||-$searchString-||-/if-|" size="45" id="searchString" /> 			
		</p>
		
		<div id="newsArticlesSearch" style="display: |-if $filters.fromDate ne '' ||  $filters.toDate ne '' || $filters.categoryId ne 0 || $filters.regionId ne 0 || $archive neq ''-|block|-else-|none|-/if-|;">
			<p>
				<label for="fromDate">Fecha Desde</label>
				<input name="filters[fromDate]" type="text" id="fromDate" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.creationdate.min|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0"  title="Seleccione la fecha">
			</p>
			<p>
				<label for="toDate">Fecha Hasta</label>
				<input name="filters[toDate]" type="text" id="toDate" class="datepickerTo" title="toDate" value="|-$filters.dateRange.creationdate.max|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="categoryId">Categoría</label>
				<select name='filters[categoryId]'>
						<option value=''>Seleccione una categoría</option>
					|-foreach from=$categories item=category name=from_categories-|
						<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryId eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="regionId">Provincia</label>
				<select name='filters[regionId]'>
						<option value="">Seleccione una provincia</option>
					|-foreach from=$regions item=region name=from_region-|
						<option value="|-$region->getid()-|" |-if $filters neq '' and $filters.regionId eq $region->getid()-|selected="selected" |-/if-|>|-$region->getname()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p><label for="filters[archive]">Mostrar Archivadas</label>
					<input type="checkbox" name='filters[archive]' value="1" |-if $archive neq ''-|checked="checked" |-/if-|/>
			</p>	
		</div>
	
		<p>		
			<input type="submit" value="Buscar" name="searchSubmit" />
			<a href="#" onclick="$('#newsArticlesSearch').toggle()" id="newsArticleSearchLink">Búsqueda Avanzada</a>		
		</p>
		</fieldset>	
	</form>
</div>

|-if isset($_GET['filters'])-|
<div id="searchResults">		
		<p>|-if $newsArticle|@count gt 0-|
			Resultados Encontrados: |-$pager->getTotalRecordCount()-| Artículos |-if $searchString ne ''-|que contienen "|-$searchString-|"|-/if-| |-if $categorySelected ne ''-| de la categoría "|-$categorySelected->getName()-|"|-/if-|. Mostrando del |-$fromRecord-| al |-$toRecord-|.
			|-else-|
			No se encontraron artículos |-if $searchString ne ''-|que contengan "|-$searchString-|"|-/if-||-if $categorySelected ne ''-| de la categoría "|-$categorySelected->getName()-|"|-/if-|
			|-/if-|
		</p>
		
		|-foreach from=$newsArticlesColl item=newsarticle name=for_newsarticles-|
			<div id="article|-$newsarticle->getId()-|" class="news01">
					<h2>|-assign var=region value=$newsarticle->getRegion()-|
					|-if not empty($region)-||-$region->getName()-| &gt;&gt;|-/if-|
					|-assign var=category value=$newsarticle->getCategory()-|
					|-if not empty($category)-||-$category->getName()-| &gt;&gt;|-/if-|
				<strong>|-$newsarticle->gettoptitle()-|</strong></h2>
				<h1><a href="Main.php?do=newsArticlesView&amp;id=|-$newsarticle->getId()-|">|-$newsarticle->gettitle()-|</a></h1>
				<!--<p>Estado: |-$newsarticle->getStatusName()-|</p>
				<p>
					|-assign var=newsUser value=$newsarticle->getUser()-|
					|-if not empty($newsUser)-|
						|-$newsUser->getUsername()-|
					|-/if-|
				</p>-->
				<p>|-$newsarticle->getSummary()-|</p>
				<div class="masInfo"><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|">Ver nota completa</a></div>
	</div><!-- end NEWS01  -->
	|-/foreach-|			
			|-if isset($pager) && ($pager->getLastPage() gt 1)-|
				<p>|-include file="PaginateInclude.tpl"-|</p>
			|-/if-|
</div>
|-/if-|

