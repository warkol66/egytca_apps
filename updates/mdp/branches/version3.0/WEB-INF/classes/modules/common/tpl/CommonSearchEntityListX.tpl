<h3>|-block name=title-||-/block-|</h3>
<p>
	<a href=# onclick="$('filters').show(); return false;">filtros</a>
</p>
<div id="filters" style="display:none">
	<p>
		<form id="filters">
			<p>
				<label for="filters[perPage]" class="labelWide">Resultados por página</label> &nbsp;
				|-html_options name="filters[perPage]" id="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getMaxPerPage()-|
			</p>
			<input id="page" type="hidden" name="page" value="" />
			<p>
				|-block name=filters-||-/block-|
			</p>
		</form>
	</p>
	<p>
		<button onclick="loadRelatedEntitiesContent('|-block name=entityType-||-/block-|', $('filters'));">Filtrar</button>
	</p>
</div>
<div id="entities">
	|-foreach $entities as $entity-|
		|-block name=entity-||-/block-|
	|-/foreach-|
</div>
|-if isset($pager) && $pager->haveToPaginate()-|
	<div>
		<div id="div_paginate" style="text-align:center">
			|-assign var="page" value=$pager->getPage()-|
			<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="#" onclick="$('page').value='|-$firstPage-|'; loadRelatedEntitiesContent('|-block name=entityType-||-/block-|', $('filters')); return false;" class="detail">Inicio</a>|-else-|<span class="deactivated">Inicio</span>|-/if-|</div>
			<div id="paginatePrevious" class="paginateText">|-assign var="prevpage" value=$pager->getPreviousPage()-||-if $prevpage neq $page-|<a href="#" onclick="$('page').value='|-$prevpage-|'; loadRelatedEntitiesContent('|-block name=entityType-||-/block-|', $('filters')); return false;" class="detail">&lt;&lt; Anterior</a>|-else-|<span class="deactivated">&lt;&lt; Anterior</span>|-/if-|</div>
			<div id="paginatePage" class="paginateText">|-if $page ne ''-| Página: |-$page-| de |-$pager->getLastPage()-| |-/if-|</div>
			<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getNextPage()-||-if $nextpage ne $page-|<a href="#" onclick="$('page').value='|-$nextpage-|'; loadRelatedEntitiesContent('|-block name=entityType-||-/block-|', $('filters')); return false;" class="detail">Siguiente &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|</div>
			<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="#" onclick="$('page').value='|-$lastpage-|'; loadRelatedEntitiesContent('|-block name=entityType-||-/block-|', $('filters')); return false;" class="detail">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</div>
</div>

	</div>
|-/if-|