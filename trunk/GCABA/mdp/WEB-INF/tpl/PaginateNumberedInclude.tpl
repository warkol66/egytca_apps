<div id="div_paginate" style="text-align:right">
	<div id="paginateFirst" class="paginateText">		
	|-assign var="previousPages" value=$pager->getPrevLinks()-|
	<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="detail">Inicio</a>|-else-|<span class="deactivated">Inicio</span>|-/if-|
	</div>
	|-math equation="x - 1" x=$pager->getPage() assign=paginated-|
	|-if $paginated gt $previousPages|@count-|
	...
	|-/if-|
|-foreach from=$previousPages item=previousPage name=previousPages-|
	|-if $previousPage ne $pager->getFirstPage()-|
	<div id="paginateFirst|-$previousPage-|" class="paginateText"><a href="|-$url-|&page=|-$previousPage-|" class="detail">|-$previousPage-|</a></div>
	|-/if-|
|-/foreach-|
	<div id="paginatePage" class="paginateText">|-assign var="page" value=$pager->getPage()-||-if $page ne ''-| Página: |-$page-|  |-/if-|
	</div>
|-assign var="nextPages" value=$pager->getNextLinks()-|
|-math equation="x - y" x=$pager->getTotalPages() y=$pager->getPage() assign=pagesLeft-|
|-foreach from=$nextPages item=nextPage name=nextPages-|
	|-if $nextPage ne $pager->getLastPage()-|
	<div id="paginateFirst|-$nextPage-|" class="paginateText"><a href="|-$url-|&page=|-$nextPage-|" class="detail">|-$nextPage-|</a></div>
	|-/if-|
|-/foreach-|
	|-if $pagesLeft gt $nextPages|@count-|
	...
	|-/if-|
	<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="|-$url-|&page=|-$lastpage-|" class="detail">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</div>
</div>
