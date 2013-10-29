<div id="tweetsList">
	<h4>Tweets</h4>
	<table id="tabla-tweets" class='tableTdBorders' border="1" cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
			<tr class="thFillTitle">
					<th width="50%">Texto</th> 
					<th width="21%">Usuario</th> 
					<th width="5%">Fecha</th> 
					<th width="1%">Valoración</th> 
					<th width="1%">Relevancia</th> 
				</tr> 
		</thead>
		<tbody>
		|-if $twitterTweetColl|@count eq 0-|
			<tr>
				 <td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">No hay tweets con los filtros especificados</td>
			</tr>
		|-else-|
			|-foreach from=$twitterTweetColl item=tweet name=for_tweets-|
			|-assign var=user value=$tweet->getTwitterUser()-|
			<tr id="tr_|-$tweet->getId()-|">
				<td>|-$tweet->getText()|twitterHighlight-|</td>
				<td>|-if is_object($user)-||-$user->getName()-||-/if-|</td>
				<td>|-$tweet->getCreatedat()|date_format:"%d-%m-%Y %H:%m"|change_timezone-|</td>
				<td>|-$values[$tweet->getValue()]-|</td> 
				<td>|-$relevances[$tweet->getRelevance()]-|</td>
			</tr>
			|-/foreach-|
			</tbody> 
			<tfoot>
			|-if isset($pager) && ($pager->getLastPage() gt 1)-|
			<tr> 
				<td colspan="|-if class_exists('Client')-|7|-else-|7|-/if-|">|-include file="ModelPagerInclude.tpl"-|</td> 
			</tr>
			|-/if-|
		|-/if-|
	</table>
</div>
