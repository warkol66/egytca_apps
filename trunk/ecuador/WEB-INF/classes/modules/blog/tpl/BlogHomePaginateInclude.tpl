<div id="div_paginate">
	<div id="paginateNext">|-assign var="nextpage" value=$pager->getNext()-||-if $nextpage ne ""-|<a href="Main.php?do=blogShow&page=2">Ver más entradas &gt;&gt;</a>|-else-|<span class="deactivated">Siguiente &gt;&gt;</span> |-/if-|
	</div>
</div>
