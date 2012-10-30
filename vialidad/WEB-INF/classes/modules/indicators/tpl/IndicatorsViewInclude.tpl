|-assign value=$result var=indicator-|
|-assign value=$indicator->getXs() var=xValues-|
|-assign var=span value=$xValues|@count-|
<table>
<tr>
<th colspan="|-$span+1-|">|-$indicator->getName()-|</th>
</tr>
<tr>
<th></th>
|-foreach from=$xValues item=xValue name=for_xValue-|
	<th>|-$xValue->getName()|escape-|</th>
|-/foreach-|
</tr> 
|-assign value=$indicator->getSeries() var=series-|
|-foreach from=$series item=serie name=for_serie-|
|-assign value=$serie->getYs() var=yValues-|
	<tr>
	<td>|-$serie->getName()-|</td>
	|-foreach from=$yValues item=yValue name=for_yValue-|
		<td>|-$yValue->getValue()|number_format:2:".":""-|</td>
	|-/foreach-|
	</tr>
|-/foreach-|
</table>
