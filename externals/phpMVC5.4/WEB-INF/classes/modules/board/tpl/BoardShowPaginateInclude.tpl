<span id="span_paginate" style="text-align:center">
	<!-- <p>
	Total Pages: |-$pager->getTotalPages()-|  Total Texts: |-$pager->getTotalRecordCount()-|
	</p>
	-->
	<span id="paginateFirst">|-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="Main.php?do=boardShow&page=|-$firstpage-|">Inicio</a>|-else-|<a href="Main.php?do=boardShow">Inicio</a>|-/if-|
	</span>
	<span id="paginatePrevious">|-assign var="prevpage" value=$pager->getPrev()-||-if $prevpage gt 0-|<a href="Main.php?do=boardShow&page=|-$prevpage-|">&lt;&lt; Anterior</a>|-else-|<span class="deactivated">&lt;&lt; Anterior</span>|-/if-|
	</span>
	<span id="paginatePage">|-assign var="page" value=$pager->getPage()-||-if $page ne ''-| Página: |-$page-| de |-$pager->getTotalPages()-| |-/if-|
	</span>
	<span id="paginateNext">|-assign var="nextpage" value=$pager->getNext()-||-if $nextpage ne ""-|<a href="Main.php?do=boardShow&page=|-$nextpage-|">Siguiente &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</span>
	<span id="paginateLast">|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="Main.php?do=boardShow&page=|-$lastpage-|">Última</a>|-else-|<span class="deactivated">Última</span>|-/if-|
	</span>
</span>
