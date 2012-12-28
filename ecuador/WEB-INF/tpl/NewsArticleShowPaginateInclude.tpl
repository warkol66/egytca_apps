<div id="div_paginate" class="paginateBar curved">
	<!-- <p>
	Total Pages: |-$pager->getTotalPages()-|  Total Texts: |-$pager->getTotalRecordCount()-|
	</p>
	-->
	<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="changePages">Inicio</a>|-else-|<a href="|-$url-|" class="changePages">Inicio</a>|-/if-|
	</div>
	<div id="paginatePrevious" class="paginateText">|-assign var="prevpage" value=$pager->getPrev()-||-if $prevpage gt 0-|<a href="|-$url-|&page=|-$prevpage-|" class="changePages">&lt;&lt; Anterior</a>|-else-|<span class="deactivated">&lt;&lt; Anterior</span>|-/if-|
	</div>
	<div id="paginatePage" class="paginateText">|-assign var="page" value=$pager->getPage()-||-if $page ne ''-|<span class="changePages"> Página: |-$page-| de |-$totalPages-| |-/if-|</span>
	</div>
	<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getPage()+1-||-if $nextpage lte $totalPages-|<a href="|-$url-|&page=|-$nextpage-|" class="changePages">Siguiente &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</div>
	<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $totalPages neq $page-|<a href="|-$url-|&page=|-$totalPages-|" class="changePages">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</div>
</div>
