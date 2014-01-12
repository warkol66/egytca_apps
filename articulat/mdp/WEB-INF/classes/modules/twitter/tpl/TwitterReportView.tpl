<div id="tweetsList">
	<h4>Tweets</h4>
	<table id="tabla-tweets" class='tableTdBorders' border="1" cellpadding='5' cellspacing='0'> 
		<thead>
			<tr class="thFillTitle">
					<th width="50%">Texto</th> 
					<th width="15%">Usuario</th>
					<th width="12%">Ubicación</th> 
					|-if ConfigModule::get("twitter","useGender")-|<th width="9%">Género</th>|-/if-| 
					<th width="4%">Fecha</th> 
					<th width="5%">Valoración</th> 
					<th width="5%">Relevancia</th> 
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
				<td>|-if is_object($user)-||-$user->getLocation()-||-/if-|</td>
				|-if ConfigModule::get("twitter","useGender")-|<td>|-if is_object($user)-||-if $user->getGender() eq "male"-|Masculino|-elseif $user->getGender() eq "female"-|Femenino|-/if-||-/if-|</td>|-/if-|
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
		|-if !empty($tweetsAmount)-|
	<h4>Tweets por grupo de relevancia y valoración</h4>

	<table id="tabla-tweets" class='tableTdBorders' border="1" cellpadding='5' cellspacing='0'> 
		<thead>
			<tr class="thFillTitle">
					<th>Grupo</th> 
					<th>Frecuencia</th> 
			</tr>
		|-foreach from=$tweetsAmount item=group-|
			<tr>
				<td>|-$group['name']-|</td><td>|-$group['value']-|</td>
			</tr>
		|-/foreach-|
		</table>
		|-else-|
		vacio
		|-/if-|

