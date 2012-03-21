<div id="div_paginate" style="text-align:center">
	<!-- <p>
	Total Pages: |-$pager->getTotalPages()-|  Total Texts: |-$pager->getTotalRecordCount()-|
	</p>
	-->
	<div style="text-align:right">
		<table cellpadding="3" cellspacing="1" id="table_paginate" align="right">
			<tr>
				<td class="celldato"> |-assign var="firstpage" value=$pager->getFirstPage()-||-assign var="page" value=$pager->getPage()-||-if $page gt 1-|<a href="|-$url-|&page=|-$firstpage-|" class="deta">First</a>|-else-|<span class="desac">First</span>|-/if-| </td>
				<td class="celldato"> |-assign var="prevpage" value=$pager->getPrev()-||-if $prevpage gt 0-|<a href="|-$url-|&page=|-$prevpage-|" class="deta">&lt;&lt; Previous</a>|-else-|<span class="desac">&lt;&lt; Previous</span>|-/if-| </td>
				<td class="celldato"> |-assign var="page" value=$pager->getPage()-||-if $page ne ''-| Page: |-$page-|  |-/if-| </td>
				<td class="celldato"> |-assign var="nextpage" value=$pager->getNext()-||-if $nextpage ne ""-|<a href="|-$url-|&page=|-$nextpage-|" class="deta">Next &gt;&gt; </a>|-else-|<span class="desac">Next &gt;&gt;</span> |-/if-| </td>
				<td class="celldato"> |-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|<a href="|-$url-|&page=|-$lastpage-|" class="deta">Last</a>|-else-|<span class="desac">Last</span>|-/if-| </td>
			</tr>
		</table>
	</div>
</div>
