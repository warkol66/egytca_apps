|-$allowAddRemove = $allowAddRemove|default:true-|
|-function name="searchQuery" value="" disabled=false-|
	<p>
		<label>Palabras clave</label>
		<input class="searchQueryInput" name="|-$inputName|default:"params[searchQueries][]"-|" |-if $disabled-|disabled="disabled"|-/if-| type="text" title="Estas palabras clave son las que propondrá por defecto para la búsqueda" value="|-$value|escape-|" size="50">
		<a href="#" class="tooltipWide"><span>Para búsquedas puede usar los "#" y "@" para identificar hastags y usuarios respectivamente. <br />Las palabras sin estos caracteres iniciales se buscarán como palabras sueltas.</span><img src="images/icon_info.png"></a>
		|-if $useLightbox-|
			<a href="#" rel="twitterQueryBuilderLightbox" class="lbOn queryBuilderTrigger">búsqueda avanzada</a>
		|-/if-|
		|-if $allowAddRemove-|
			<input type="button" class="icon iconDelete" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" title="Eliminar b&uacute;squeda">
		|-/if-|
	</p>
|-/function-|

|-if $allowAddRemove-|
	<p align="right">
		<a href="#" onclick="addSearchQuery(); return false;">Agregar búsqueda</a>
	</p>
|-/if-|
<div id="searchQueries">
	|-foreach $campaign->getSearchQueries() as $searchQuery-|
		|-searchQuery value=$searchQuery-|
	|-foreachelse-|
		|-searchQuery-|
	|-/foreach-|
</div>

|-if $allowAddRemove-|
	<div id="searchQueryTemplate" style="display:none">
		|-searchQuery disabled=true-|
	</div>

	<script>
		var addSearchQuery = function() {
			var newSearchQuery = document.getElementById('searchQueryTemplate')
				.querySelector('p').cloneNode(true);
			newSearchQuery.querySelector('.searchQueryInput').disabled = '';
			document.getElementById('searchQueries').appendChild(newSearchQuery);

			new lightbox(newSearchQuery.querySelector('.queryBuilderTrigger'));
			addQueryBuilder(
				newSearchQuery.querySelector('.searchQueryInput'),
				newSearchQuery.querySelector('.queryBuilderTrigger')
			);
		};
	</script>
|-/if-|

|-if $useLightbox-|
	<script>
		|-* lightbox usa prototype *-|
		Event.observe(window, 'load', function() {
			var searchQueries = document.querySelectorAll('#searchQueries p');
			for (var i = 0; i < searchQueries.length; i++) {
				var searchQuery = searchQueries[i];
				addQueryBuilder(
					searchQuery.querySelector('.searchQueryInput'),
					searchQuery.querySelector('.queryBuilderTrigger')
				);
			};
		});
	</script>
|-/if-|
