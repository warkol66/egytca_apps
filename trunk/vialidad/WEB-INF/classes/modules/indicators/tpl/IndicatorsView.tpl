<h2>Contratos</h2>
<h1>Curva de desembolso |-if $entityObj-| - |-$entityObj->getName()-||-/if-|</h1>
|-if $message eq "graph_ok"-|
	<div class="successMessage">Se ha creado la curva de desembolso correctamente.</div>
	<p>Para cargar los datos, ingrese a Editar Importes.</p>
|-/if-|
|-if !$entity-|
  <p><input type="button" id="button_edit_xs" name="button_edit_xs" title="Editar Curvas" value="Editar Curvas" onClick="location.href='Main.php?do=indicatorsSeriesEdit&id=|-$indicator->getId()-|&disbursement=1'" />
	<input type="button" id="button_edit_xs" name="button_edit_xs" title="Editar Meses" value="Editar Meses" onClick="location.href='Main.php?do=indicatorsXsEdit&id=|-$indicator->getId()-|&disbursement=1'" />
		<input type="button" id="button_edit_ys" name="button_edit_ys" title="Editar Importes" value="Editar Importes" onClick="location.href='Main.php?do=indicatorsYsEdit&id=|-$indicator->getId()-|&disbursement=1'" />
		|-assign var=contract value=$indicator->getContract()-|
		<input type="button" id="projectsList" name="projectsList" title="Ir a Contrato" value="Ir a Contrato" onClick="location.href='Main.php?do=vialidadContractsEdit&id=|-$contract->getId()-|'" /></p>
|-else-|
		<input type="button" id="button_edit_xs" name="button_edit_xs" title="Regresar" value="Regresar" onClick="javascript:history.back(1)" />
|-/if-|

<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $indicator->getType() eq constant("IndicatorPeer::COLUMN")-|
	|-assign var=graphType value='MSColumn3D'-|
|-elseif $indicator->getType() eq constant("IndicatorPeer::LINE")-|
	|-assign var=graphType value='MSLine'-|
|-elseif $indicator->getType() eq constant("IndicatorPeer::PIE")-|
	|-assign var=graphType value='Pie3D'-|
|-elseif $indicator->getType() eq constant("IndicatorPeer::STACKEDCOLUMN")-|
	|-assign var=graphType value='StackedColumn2D'-|
|-/if-|
<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
	<div id="chartdiv" align="center"></div>
	<script type="text/javascript">
		 var chart = new FusionCharts("scripts/FusionCharts/|-$graphType-|.swf", "ChartId", "640", "420", "0", "0");
		 |-if $entity ne ''-|
		 	chart.setDataURL("Main.php%3Fdo%3DindicatorsViewXml%26id%3D|-$entityId-|%26entity%3D|-$entity-|");
		 |-else-|
		 	chart.setDataURL("Main.php%3Fdo%3DindicatorsViewXml%26id%3D|-$indicator->getId()-|");		
		 |-/if-|
		 chart.render("chartdiv");
	</script>
<p>&nbsp;</p>
<p>|-$indicator->getSource()-|</p>
<p>&nbsp;</p>
