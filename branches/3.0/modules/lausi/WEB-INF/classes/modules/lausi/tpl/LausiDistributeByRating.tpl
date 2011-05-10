<script type="text/javascript" language="javascript" src="scripts/lausi-distribution.js" ></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/lausi-map-base.js"></script>
<script type="text/javascript" src="scripts/lausi-map-distribution.js"></script>
|-if not isset($ajax)-|
<h2>Distribución de Motivos</h2>
<h1>Distribución de Motivos por Valoración</h1>
<p>Para distribuir un motivo, seleccione el motivo, la fecha de inicio y la duración. Luego ingrese la cantidad de aficehes a publicar y la valoración de las ubicaciones.<br>
Luego haga click en "Desplegar opciones de Distribución" para obtener la propuesta del sistema.</p>
|-/if-|
|-include file=LausiThemeCreateInclude.tpl elements=$clients-|

<form method="get">
<fieldset>
	<legend>Distribuir Motivos</legend>
	<p>
		|-include file="LausiDistributeThemeFieldInclude.tpl" themeId=$themeId themes=$themes-|			
	</p>
	<p>
		<label for="publishDate">Fecha</label>
		<input name="publishDate" type="text" id="publishDate" title="publishDate" value="|-$smarty.now|date_format:"%d-%m-%Y"-|" size="12" /> 
		<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('publishDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
	</p>
	<p>	
		<label>Duración</label>
		<input name="duration" type="text" value="" size="4" /> 
		dias
	</p>
	<p>
		<label>Afiches</label>
		<input name="quantity" type="text" id="quantity" value="" size="8" />

	</p>
	<p>	
		<label>Valoración</label>
		<select name="rating" id="rating" >
			<option value="1">Premium&nbsp;&nbsp;</option>
			<option value="2">Superior&nbsp;&nbsp;</option>
			<option value="3">Destacada&nbsp;&nbsp;</option>
			<option value="4">Standart&nbsp;&nbsp;</option>
		</select>

	</p>
	<p><input type="hidden" name="mode" value="rating" /></p>
	<p><input type="hidden" name="do" value="lausiDistributeProposeX"/></p>
	<p><input type="button" value="Desplegar opciones de Distribución" onClick="javascript:lausiProposeDistribution(this.form)"> <span id="msgbox"></span></p>
</fieldset>
</form>

<div id="distributionProposal">
	
</div>

<script type="text/javascript">
	var distributionMap = new DistributionMap();
</script>