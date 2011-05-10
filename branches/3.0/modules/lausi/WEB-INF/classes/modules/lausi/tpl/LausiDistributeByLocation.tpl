<script type="text/javascript" language="javascript" src="scripts/lausi-distribution.js" ></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/lausi-map-base.js"></script>
<script type="text/javascript" src="scripts/lausi-map-distribution.js"></script>
|-if not isset($ajax)-|
<h2>Distribución de Motivos</h2>
<h1>Distribución por Ubicación Geográfica</h1>
<p>Para distribuir un motivo, seleccione el motivo, la fecha de inicio y la duración. Luego las coordenadas de un ubicacion geografica y un distancia limite desde ese punto.<br>
Luego haga click en "Desplegar opciones de Distribución" para obtener la propuesta del sistema.</p>
|-/if-|
|-include file=LausiThemeCreateInclude.tpl elements=$clients-|

<form action="" method="get">
<fieldset>
	<legend>Distribución de Motivos</legend>
	<p>
		|-include file="LausiDistributeThemeFieldInclude.tpl" themeId=$themeId themes=$themes-|			
	</p>
	<p>
		<label for="publishDate">Fecha de Inicio </label>
		<input name="publishDate" type="text" id="publishDate" title="publishDate" value="|-$smarty.now|date_format:"%d-%m-%Y"-|" size="12" /> 
		<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('publishDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
	</p>
	<p>	
		<label>Afiches</label>
		<input name="quantity" type="text" value="" size="4" /> 
	</p>
	<p>	
		<label>Duración</label>
		<input name="duration" type="text" value="" size="4" /> días
	</p>
<!--
	<p>	
		<label>Cordenada X</label>
		<input name="byLocation[coordinateX]" type="text" value="" size="12" />
	</p>
	<p>	
		<label>Cordenada Y</label>
		<input name="byLocation[coordinateY]" type="text" value="" size="12" />
	</p>
-->
	<p>
		<label>Direccion de cliente de referencia</label>
		<select name="byLocation[clientAddressId]">
		|-foreach from=$clientAddresses item='clientAddress'-|
			<option value="|-$clientAddress->getId()-|">|-$clientAddress->getStreet()-| |-$clientAddress->getNumber()-|</option>
		|-/foreach-|
		</select>
	</p>
	<p>	
		<label>Distancia Limite</label>
		<input name="byLocation[radius]" type="text" value="" size="8" /> desde el el centro (radio) en metros.
	</p>
	<br/>
	<p><input type="hidden" name="mode" value="location" /></p>
	<p><input type="hidden" name="do" value="lausiDistributeProposeX"/></p>
	<p><input type="button" value="Desplegar opciones de Distribución" onClick="javascript:lausiProposeDistribution(this.form)"> <span id="msgbox"></span></p>
</fieldset>	
</form>

<div id="distributionProposal">
</div>
<script type="text/javascript">
	var distributionMap = new DistributionMap();
</script>
