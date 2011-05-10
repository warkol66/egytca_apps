<script type="text/javascript" language="javascript" src="scripts/lausi-campaigns.js" ></script>
<script type="text/javascript" language="javascript" src="scripts/lausi-distribution.js" ></script>
<h2>Motivos</h2>
<h1>Administración de Motivos</h1>
<p>Para modificar una publicación, seleccione el motivo, para ver los datos correspondiente y sus opciones de administración.
</p>

<form action="Main.php" method="get" id="campaignFinderForm">
<fieldset>
	<legend>Modificación de Publicación</legend>
	<p>
		<label>Motivo</label>
		<select name="themeId" id="themeIdSelect">
			|-foreach from=$themes item=theme name=for_themes-|
				<option value="|-$theme->getId()-|">|-$theme->getName()-| - |-$theme->getShortName()-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label>Circuito</label>		
		<select name="circuitId" id="circuitIdSelect">
				<option value="">Todos</option>
			|-foreach from=$circuits item=circuit name=for_circuit-|
				<option value="|-$circuit->getId()-|">|-$circuit->getName()-|</option>
			|-/foreach-|
		</select>		
	</p>
	<p><input type="hidden" name="mode" value="circuit" /></p>
	<p><input type="hidden" name="do" value="lausiCampaignsSearchX"/></p>
	<p><input type="button" value="Buscar Motivo" onClick="javascript:lausiCampaignsSearch(this.form)"> <span id="msgboxCampaigns"></span></p>
</fieldset>
</form>

<p>

<div id="currentCampaigns">
	
</div>


</p>
