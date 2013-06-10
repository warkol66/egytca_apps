|-if $pager->getLastPage() lt 3-|
<div id="div_paginate" style="text-align:center">
	<!-- <p>
	Total Pages: |-$pager->getLastPage()-|  Total Texts: |-$pager->count()-|
	</p>
	-->|-assign var="page" value=$pager->getPage()-|
	<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="pageLink">Inicio</a>|-else-|<span class="deactivated">Inicio</span>|-/if-|
	</div>
	<div id="paginatePrevious" class="paginateText">|-assign var="prevpage" value=$pager->getPreviousPage()-||-if $prevpage neq $page-|<a href="|-$url-|&page=|-$prevpage-|" class="pageLink">&lt;&lt; Anterior</a>|-else-|<span class="deactivated">&lt;&lt; Anterior</span>|-/if-|
	</div>
	<div id="paginatePage" class="paginateText">|-if $page ne ''-| Página: |-$page-| de |-$pager->getLastPage()-| |-/if-|
	</div>
	<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getNextPage()-||-if $nextpage ne $page-|<a href="|-$url-|&page=|-$nextpage-|" class="pageLink">Siguiente &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</div>
	<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="|-$url-|&page=|-$lastpage-|" class="pageLink">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</div>
</div>
|-else-|
<div id="div_paginate" style="text-align:center">
|-assign var="page" value=$pager->getPage()-|
	<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="pageLink">Inicio</a>|-else-|<span class="deactivated">Inicio</span>|-/if-|
	</div>
	<div id="paginatePrevious" class="paginateText">|-assign var="prevpage" value=$pager->getPreviousPage()-||-if $prevpage neq $page-|<a href="|-$url-|&page=|-$prevpage-|" class="pageLink">&lt;&lt; Anterior</a>|-else-|<span class="deactivated">&lt;&lt; Anterior</span>|-/if-|
	</div>
	<div id="paginatePrevious4" class="paginateText">
	|-assign var="prevpage" value=$pager->getPreviousPage()-4-|
	|-if $prevpage gt 1-|
	<a href="|-$url-|&page=|-$prevpage-|" class="detail">|-$prevpage-|</a>
	|-/if-|
	</div><div id="paginatePrevious3" class="paginateText">
	|-assign var="prevpage" value=$pager->getPreviousPage()-3-|
	|-if $prevpage gt 1-|
	<a href="|-$url-|&page=|-$prevpage-|" class="detail">|-$prevpage-|</a>
	|-/if-|
	</div><div id="paginatePrevious2" class="paginateText">
	|-assign var="prevpage" value=$pager->getPreviousPage()-2-|
	|-if $prevpage gt 1-|
	<a href="|-$url-|&page=|-$prevpage-|" class="detail">|-$prevpage-|</a>
	|-/if-|
	</div><div id="paginatePrevious1" class="paginateText">
	|-assign var="prevpage" value=$pager->getPreviousPage()-1-|
	|-if $prevpage gt 1-|
	<a href="|-$url-|&page=|-$prevpage-|" class="detail">|-$prevpage-|</a>
	|-/if-|
	</div><div id="paginatePrevious" class="paginateText">
	|-assign var="prevpage" value=$pager->getPreviousPage()-|
	|-if $prevpage gt 1-|
	<a href="|-$url-|&page=|-$prevpage-|" class="detail">|-$prevpage-|</a>
	|-/if-|
	</div>	
	<div id="paginatePage" class="paginateText">|-if $page ne ''-| Página: |-$page-| de |-$pager->getLastPage()-| |-/if-|
	</div>
<div id="paginateNext" class="paginateText">
	|-assign var="nextpage" value=$pager->getNextPage()-|
	|-if $nextpage lt $pager->getLastPage()-|
	<a href="|-$url-|&page=|-$nextpage-|" class="detail">|-$nextpage-|</a>|-/if-|
	</div><div id="paginateNext2" class="paginateText">
	<div id="paginateNext1" class="paginateText">
	|-assign var="nextpage" value=$pager->getNextPage()+1-|
	|-if $nextpage lt $pager->getLastPage()-|
	<a href="|-$url-|&page=|-$nextpage-|" class="detail">|-$nextpage-|</a>|-/if-|
	</div><div id="paginateNext2" class="paginateText">
	|-assign var="nextpage" value=$pager->getNextPage()+2-|
	|-if $nextpage lt $pager->getLastPage()-|
	<a href="|-$url-|&page=|-$nextpage-|" class="detail">|-$nextpage-|</a>|-/if-|
	</div><div id="paginateNext3" class="paginateText">
	|-assign var="nextpage" value=$pager->getNextPage()+3-|
	|-if $nextpage lt $pager->getLastPage()-|
	<a href="|-$url-|&page=|-$nextpage-|" class="detail">|-$nextpage-|</a>|-/if-|
	</div><div id="paginateNext4" class="paginateText">
	|-assign var="nextpage" value=$pager->getNextPage()+4-|
|-if $nextpage lt $pager->getLastPage()-|
	<a href="|-$url-|&page=|-$nextpage-|" class="detail">|-$nextpage-|</a>|-/if-|
	<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getNextPage()-||-if $nextpage ne $page-|<a href="|-$url-|&page=|-$nextpage-|" class="pageLink">Siguiente &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</div>
	<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="|-$url-|&page=|-$lastpage-|" class="pageLink">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</div>
</div>




	


|-/if-|