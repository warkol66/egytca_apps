	<tr>
		<th colspan="5" class="thFillTitle">|-$extraName-|</th>
	</tr>
	|-foreach from=$extras item=extra-|
		|-include
			file="VialidadInvoicesExtraTableRowInclude.tpl"
			extra=$extra
		-|
	|-/foreach-|
