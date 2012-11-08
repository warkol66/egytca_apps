|-if !$disbursement-|<h2>Indicadores</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Valores</h1>
<p>A contunuación encontrará los valores que componen el indicador. Ingrese los valores en las casillas correspondientes y haga click en "Aceptar" para guardar los cambios.</p>
<p><strong>Indicador:</strong> |-$indicator->getName()-|</p>
<p><strong>Tipo de Indicador:</strong> |-$indicator->getIndicatorTypeTranslated()-|</p>|-else-|
<h2>Proyectos</h2>
<h1>Curva de desembolso</h1>
<p>A contunuación encontrará los importes que configuran la curva de desembolsos. Ingrese o modifique los valores en las casillas correspondientes y haga click en "Aceptar" para guardar los cambios.</p>
|-/if-|
<form method="post">
<fieldset>
<legend>Valores</legend>
|-if $indicator->getType() eq constant('IndicatorPeer::PIE')-|
|-assign value=$indicator->getSeries() var=series-|
<table border="0" cellspacing="5">
<tr>
	|-assign value=$series.0 var=serie-|
	<th>|-$serie->getName()|escape-|</th>
</tr>
|-assign value=$indicator->getXs() var=xValues-|
|-foreach from=$xValues item=xValue name=for_xValues-|
<tr>
	|-assign value=$xValue->getYs() var=yValues-|
	<td><p><label>|-$xValue->getName()|escape-|</label>
	|-foreach from=$yValues item=yValue name=for_yValue-|
		<input name="yValue[]" type="text" id="yValue[]" value="|-$yValue->getValue()|number_format:1:",":"."-|" size="12" />
		<input name="yValue[][id]" type="hidden" id="yValue[][id]" value="|-$yValue->getId()-|" />
	|-/foreach-|
	</p></td></tr>
|-/foreach-|
</table>
|-else-|
|-assign value=$indicator->getXs() var=xValues-|
|-assign value=$indicator->getSeries() var=series-|
<table border="0" cellspacing="5">
<tr>
	<th></th>
|-foreach from=$series item=serie name=for_serie-|
	<th>|-$serie->getName()-|</th>
|-/foreach-|
</tr>
|-foreach from=$xValues item=xValue name=for_xValue-|
<tr>
	<th align="right">|-$xValue->getName()-|</th>
	|-foreach from=$series item=serie name=for_serie-|
	|-assign value=$serie->getYForX($xValue) var=yValue-|
		<td>
			<input name="yValue[|-$xValue->getId()-|][|-$serie->getId()-|]" type="text" value="|-$yValue->getValue()-|" size="12" />
		</td>
	|-/foreach-|</tr>
|-/foreach-|
|-/if-|
</table>

				<input type="hidden" name="indicatorId" id="indicatorId" value="|-$indicator->getId()-|" />
				<input type="hidden" name="do" id="do" value="indicatorsYsDoEdit" />
				<input type="hidden" name="disbursement" id="disbursement" value="|-$disbursement-|" />
				<input type="submit" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" />
				
	|-if !$disbursement-|<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsEdit&id=|-$indicator->getId()-|'" />
	|-else-|<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsView&id=|-$indicator->getId()-|'" />|-/if-|
</fieldset>
</form>
