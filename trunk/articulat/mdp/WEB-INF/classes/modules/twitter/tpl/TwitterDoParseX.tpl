<script>
	$('.inProgress').innerHTML = '';
</script>
<table id="tabla-tweets" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
	<tbody>
	|-foreach from=$tweets item=tweet name=for_tweets-|
		</tr>
			<td>|-$tweet->getText()-|</td>
		</tr>
	|-/foreach-|
	</tbody>
</table>
