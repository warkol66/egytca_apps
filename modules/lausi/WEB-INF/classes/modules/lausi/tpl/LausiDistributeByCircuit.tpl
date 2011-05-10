<script type="text/javascript" language="javascript" src="scripts/lausi-distribution.js" ></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/lausi-map-base.js"></script>
<script type="text/javascript" src="scripts/lausi-map-distribution.js"></script>
|-if not isset($ajax)-|
<h2>Distribución de Motivos</h2>
<h1>Distribución por Circuitos</h1>
<p>Para distribuir un motivo, seleccione el motivo, la fecha de inicio y la duración. Luego ingrese las cantidades a distribuir para cada circuito.<br>
Luego haga click en "Desplegar opciones de Distribución" para obtener la propuesta del sistema.</p>
|-/if-|
|-include file=LausiThemeCreateInclude.tpl elements=$clients-|

<form action="" method="get">
<fieldset>
	<legend>Distribución de Motivos</legend>
	<p>
		<label>Motivo</label>
		<select name="themeId" id="themeIdSelectDistribute" onChange="javascript:lausiUpdateDistributeCountCircuit();">
				<option value="">Seleccione un Motivo</option>
			|-foreach from=$themes item=theme name=for_themes-|
				<option value="|-$theme->getId()-|" |-if (isset($themeId)) and ($themeId eq $theme->getId()) -|selected="selected"|-/if-|>|-$theme->getName()-| - |-$theme->getShortName()-|</option>
			|-/foreach-|
		</select>
		|-include file="LausiThemeCreateButtonInclude.tpl"-|
	</p>
		|-assign var=theme value=$themes.0-|
	<p>
		<label>Afiches Distribuidos</label> <span id="themeDistributedCount"></span> <span id="msgBoxDistributeCount"></span>
	</p>
	<p>
		<label for="publishDate">Inicio</label>
		<input name="publishDate" type="text" id="publishDate" title="publishDate" value="|-$smarty.now|date_format:"%d-%m-%Y"-|" size="12" /> 
		<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('publishDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
	</p>
	<p>	
		<label>Duración</label>
		<input name="duration" type="text" value="" size="4" /> días</p>
		<p>Indique cantidades por Circuito</p>
		<ul>
		|-foreach from=$circuits item=circuit name=for_circuit-|
			<p>
				<label>|-$circuit->getName()-|</label>
				<input name="byCircuit[|-$circuit->getId()-|]" type="text" size="6" /> <span id='inputItem|-$circuit->getId()-|'></span>
			</p>
		|-/foreach-|
		</ul>
	<p><input type="hidden" name="mode" value="circuit" /></p>
	<p><input type="hidden" name="do" value="lausiDistributeProposeX"/></p>
	<p><input type="button" value="Desplegar opciones de Distribución" onClick="javascript:lausiProposeDistribution(this.form)"> <span id="msgbox"></span></p>
</fieldset>
</form>
<div id="distributionProposal">
</div>

<script type="text/javascript">
	var distributionMap = new DistributionMap();
</script>
<script type="text/javascript">
	lausiUpdateDistributeCountCircuit();
</script>
