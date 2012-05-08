<div id="div_paginate" style="text-align:center">
	<!-- <p>Total Pages: |-$pager->getTotalPages()-|  Total Texts: |-$pager->getTotalRecordCount()-|</p>	-->
	<div id="paginateFirst" class="paginateText">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="detail">##common,5,Primera##</a>|-else-|<span class="deactivated">##common,5,Primera##</span>|-/if-|</div>
	<div id="paginatePrevious" class="paginateText">|-assign var="prevpage" value=$pager->getPrev()-||-if $prevpage gt 0-|<a href="|-$url-|&page=|-$prevpage-|" class="detail">&lt;&lt; ##common,6,Anterior##</a>|-else-|<span class="deactivated">&lt;&lt; ##common,6,Anterior##</span>|-/if-|</div>
	<div id="paginatePage" class="paginateText">|-assign var="page" value=$pager->getPage()-||-if $page ne ''-| ##common,7,Página##: |-$page-| ##common,8,de## |-$pager->getTotalPages()-| |-/if-|</div>
	<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getNext()-||-if $nextpage ne ""-|<a href="|-$url-|&page=|-$nextpage-|" class="detail">##common,9,Siguiente## &gt;&gt;</a>|-else-|<span class="deactivated">##common,9,Siguiente## &gt;&gt;</span> |-/if-|</div>
	<div id="paginateLast" class="paginateText">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="|-$url-|&page=|-$lastpage-|" class="detail">##common,10,Última##</a>|-else-|<span class="deactivated">##common,10,Última##</span>|-/if-|</div>
</div>
