<div id="searchForm">
	<form action="Main.php" method="get" accept-charset="utf-8">
	<fieldset>
		<p>
			<label for="searchString">Buscar</label>
			<input type="hidden" name="do" value="blogSearch" id="do" />
			<input type="text" name="searchString" value="|-if isset($searchString)-||-$searchString-||-/if-|" size="45" id="searchString" /> 			
		</p>
		<p>		
			<input type="submit" value="Buscar" name="searchSubmit" />
		</p>
		</fieldset>	
	</form>
</div>

<div id="searchResults">
		
		<p>|-if $blogEntryColl|@count gt 0-|
			Resultados Encontrados: |-$pager->getTotalRecordCount()-| Entradas |-if $searchString ne ''-|que contienen "|-$searchString-|"|-/if-|. Mostrando del |-$fromRecord-| al |-$toRecord-|.
			|-else-|
			No se encontraron entradas |-if $searchString ne ''-|que contengan "|-$searchString-|"|-/if-|
			|-/if-|
		</p>
</div>	
		|-include file="BlogShow.tpl"-|
