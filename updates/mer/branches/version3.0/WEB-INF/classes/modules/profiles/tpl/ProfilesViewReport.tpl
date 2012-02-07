<h2>##197,Caracterización de Actores##</h2>
<h1>##198,Edición de Perfiles##</h1>
<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tr>
		<th colspan="2">##202,Caracterización de## |-$actor->getName()-|</th>
	</tr>
	|-foreach from=$forms item=form-|
	|-if $form->getRootSection()-|
	|-include file="ProfilesFormViewSection.tpl" section=$form->getRootSection()-|
	|-/if-|
	|-/foreach-|
	</tr>
	<tr>
		<td colspan="2" class="tablebottom"><img src="images/clear.png"></td>
	</tr>
</table>
