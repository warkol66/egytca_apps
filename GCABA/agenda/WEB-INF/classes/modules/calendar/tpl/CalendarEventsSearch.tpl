<div id="searchForm">

	<form action="Main.php" method="get" accept-charset="utf-8">
		<p>
			<input type="hidden" name="do" value="newsArticlesSearch" id="do" />
			<input type="text" name="searchString" value="|-if isset($searchString)-||-$searchString-||-/if-|" size="60" id="searchString" /> 			
		</p>
		
		<div id="newsArticlesSearch" style="display: none">
			<p>
				<label for="fromDate">Fecha Desde</label>
				<input name="filters[fromDate]" type="text" id="fromDate" title="fromDate" value="|-$filters.fromDate|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[fromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="toDate">Fecha Hasta</label>
				<input name="filters[toDate]" type="text" id="toDate" title="toDate" value="|-$filters.toDate|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[toDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
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
			<p>
					<input type="checkbox" name='filters[archive]' value="1"|-if $archive neq ''-| checked="checked"|-/if-|>Mostrar Archivadas<br>
			</p>	
		</div>
	
		<p>		
			<input type="submit" value="Buscar" name="searchSubmit" />
			<a href="#" onclick="toggleNewsArticlesSearch()" id="newsArticleSearchLink">Búsqueda Avanzada</a>		
		</p>			
	</form>
</div>

<div id="searchResults">
		
		<p>|-if $newsarticles|@count gt 0-|
			Resultados Encontrados: |-$newsarticles|@count-| Artículos |-if $searchString ne ''-|que contienen "|-$searchString-|"|-/if-| |-if $categorySelected ne ''-| de la categoría "|-$categorySelected->getName()-|"|-/if-|
			|-else-|
			No se encontraron artículos |-if $searchString ne ''-|que contengan "|-$searchString-|"|-/if-||-if $categorySelected ne ''-| de la categoría "|-$categorySelected->getName()-|"|-/if-|
			|-/if-|
		</p>
		
		|-foreach from=$newsarticles item=newsarticle name=for_newsarticles-|
			<div id="article|-$newsarticle->getId()-|" class="news01">|-if $smarty.foreach.for_newsarticles.iteration is odd-|<img src="images/agenda_images_foto.jpg" width="85" height="86" align="left" class="newsImage"/>|-/if-|
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
			|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
				<p>|-include file="PaginateInclude.tpl"-|</p>
			|-/if-|
</div>

