<script type="text/javascript">
		$("resultDiv").innerHTML = " ";
</script>
<table id="tabla-tweets" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
	<thead>
		<tr class="thFillTitle"> 
				<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" /></th>
				<th width="50%">Texto</th> 
				<th width="10%">Usuario</th> 
				<th width="5%">Fecha</th> 
				<th width="10%">Valoración</th> 
				<th width="5%">Relevancia</th> 
				<th width="10%">Estado</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
	</thead>
	<tbody>|-if $twitterTweetColl|@count eq 0-|
		<tr>
			 <td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">Aún no hay tweets en esta campaña</td>
		</tr>
	|-else-|
		|-foreach from=$twitterTweetColl item=tweet name=for_tweets-|
		|-assign var=user value=$tweet->getTwitterUser()-|
		<tr>
			<td align="center"><input type="checkbox" name="selected[]" value="|-$tweet->getId()-|"></td>
			<td>|-$tweet->getText()-|</td>
			<td>|-$user->getName()-|</td>
			<td>|-$tweet->getCreatedat()|date_format:"%d-%m-%Y"-|</td>
			<td>
				<form action="Main.php" method="post" id="formValueTweets|-$tweet->getId()-|">
					<select name="params[value]" id="selectTweetValue|-$tweet->getId()-|" onChange="javascript:twitterDoEditValue(this.form);">
							<option value="0" |-if ($tweet->getValue()) eq 0-|selected="selected"|-/if-|>Sin seleccionar</option>
						|-foreach from=$tweetValues key=key item=name-|
							<option value="|-$key-|" |-if ($tweet->getValue()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
						|-/foreach-|
					</select>											
					<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
					<input type="hidden" name="do" value="twitterDoEditX" id="do">
				</form>
			</td> 
			<td>
				<form action="Main.php" method="post" id="formRelevanceTweets|-$tweet->getId()-|">
					<select name="params[relevance]" id="selectTweetRelevance|-$tweet->getId()-|" onChange="javascript:twitterDoEditValue(this.form);">
							<option value="0" |-if ($tweet->getRelevance()) eq 0-|selected="selected"|-/if-|>Sin seleccionar</option>
						|-foreach from=$tweetRelevances key=key item=name-|
							<option value="|-$key-|" |-if ($tweet->getRelevance()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
						|-/foreach-|
					</select>											
					<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
					<input type="hidden" name="do" value="twitterDoEditX" id="do">
				</form>
			</td> 
			<td>
				<form action="Main.php" method="post" id="formStatusTweets|-$tweet->getId()-|">
					<select name="params[status]" id="selectTweetStatus|-$tweet->getId()-|" onChange="javascript:twitterDoEditValue(this.form);">
							<option value="0" |-if ($tweet->getStatus()) eq 0-|selected="selected"|-/if-|>Sin seleccionar</option>
						|-foreach from=$tweetStatuses key=key item=name-|
							<option value="|-$key-|" |-if ($tweet->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
						|-/foreach-|
					</select>											
					<input type="hidden" name="id" id="id" value="|-$tweet->getid()-|" />
					<input type="hidden" name="do" value="twitterDoEditX" id="do">
				</form>
			</td> 
			<td>&nbsp;</td>
		</tr>
		|-/foreach-|
		</tbody> 
		<tfoot>
		|-if $twitterTweetColl|@count neq 0-|
			<tr>
				<td colspan="8">
					<form action="Main.php" method="post" id='multipleTweetsChangeForm'>
						<p>Cambiar la valoración de los tweets seleccionados a
							<select name="values" id="selectEntryStatus">
							|-foreach from=$tweetValues key=key item=name-|
								<option value="|-$key-|">|-$name-|</option>
							|-/foreach-|
							</select>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
							<input type="hidden" name="do" value="" id="do">
							<input type="button" onClick="javascript:return false;" value="Cambiar Valoracion" title="Cambiar Valoracion" class="button">
						</p>
						<p>Cambiar la relevancia de los tweets seleccionados a
							<select name="relevances" id="selectTweetRelevance">
							|-foreach from=$tweetRelevances key=key item=name-|
								<option value="|-$key-|">|-$name-|</option>
							|-/foreach-|
							</select>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
							<input type="hidden" name="do" value="" id="do">
							<input type="button" onClick="javascript:return false;" value="Cambiar Relevancia" title="Cambiar Relevancia" class="button">
						</p>
					</form>
				</td>
			</tr>
		|-/if-|
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<tr> 
			<td colspan="|-if class_exists('Client')-|7|-else-|6|-/if-|">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
	|-/if-|
</table> 
