<div id="div_paginate" style="text-align:center">
	<div id="paginateNext" class="paginateText">|-assign var="nextpage" value=$pager->getNextPage()-||-if $nextpage ne ""-|<a href="|-$url-|&page=1" class="detail">Ver más noticias &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</div>
</div>
