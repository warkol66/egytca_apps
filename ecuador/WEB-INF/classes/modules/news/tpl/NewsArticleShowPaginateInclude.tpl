<div id="div_paginate" style="text-align:center">
|-*	<!-- <p>
	Total Pages: |-$pager->getLastPage()-|  Total Texts: |-$pager->getTotalRecordCount()-|
	</p>
	-->*-|
	<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="detail">Inicio</a>|-else-|<a href="|-$url-|" class="detail">Inicio</a>|-/if-|
	</div>
	<div id="paginatePrevious" class="paginateText">|-assign var="prevpage" value=$pager->getPreviousPage()-||-if $prevpage gt 0-|<a href="|-$url-|&page=|-$prevpage-|" class="detail">&lt;&lt; Anterior</a>|-else-|<span class="deactivated">&lt;&lt; Anterior</span>|-/if-|
	</div>
	<div id="paginatePage" class="paginateText">|-assign var="page" value=$pager->getPage()-||-if $page ne ''-| Página: |-$page-| de |-$pager->getLastPage()-| |-/if-|
	</div>
	<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getNextPage()-||-if $nextpage ne ""-|<a href="|-$url-|&page=|-$nextpage-|" class="detail">Siguiente &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</div>
	<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="|-$url-|&page=|-$lastpage-|" class="detail">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</div>
</div>
