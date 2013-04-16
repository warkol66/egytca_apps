
<h2>Curvas de Desembolso</h2>
	|-if !$notValidId-|
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Curva de Avance</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| un Curva de Avance del sistema.</p>
<div id="div_indicator">
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar el Curva de Avance</div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de un Curva de Avance">
     <legend>Ingrese los datos del Curva de Avance</legend>
	<form action="Main.php" method="post">
	<p><label for="indicatorData[name]">Nombre</label>
				<input name="indicatorData[name]" type="text" class="emptyValidation" id="indicatorData[name]" title="name" value="|-if $action eq 'edit'-||-$indicator->getName()-||-/if-|" size="60" maxlength="100" />
	</p>

	<div id="graphVarialbles" style="|-if $indicator->getType() neq constant('IndicatorPeer::PIE')-|display:block|-else-|display:none|-/if-|;">
	<p><label for="indicatorData[minX]">Mínimo valor X</label>
				<input name="indicatorData[minX]" type="text" id="indicatorData[minX]" title="minX" value="|-if $action eq 'edit'-||-$indicator->getMinX()-||-/if-|" size="8" maxlength="100" />
	</p>
	<p><label for="indicatorData[maxX]">Máximo valor X</label>
				<input name="indicatorData[maxX]" type="text" id="indicatorData[maxX]" title="maxX" value="|-if $action eq 'edit'-||-$indicator->getMaxX()-||-/if-|" size="8" maxlength="100" />
	</p>
	<p><label for="indicatorData[minY]">Mínimo valor Y</label>
				<input name="indicatorData[minY]" type="text" id="indicatorData[minY]" title="minY" value="|-if $action eq 'edit'-||-$indicator->getMinY()-||-/if-|" size="8" maxlength="100" />
	</p>
	<p><label for="indicatorData[maxY]">Máximo valor Y</label>
				<input name="indicatorData[maxY]" type="text" id="indicatorData[maxY]" title="maxY" value="|-if $action eq 'edit'-||-$indicator->getMaxY()-||-/if-|" size="8" maxlength="100" />
	</p>
	</div>

	<p>			
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="indicatorsDoEdit" />
				<input type="hidden" name="contractId" id="do" value="|-$smarty.request.contractId-|" />
|-if !$show && !$showLog-|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>|-/if-|
				<br>
				|-javascript_form_validation_button value=Aceptar-|
	|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$indicator->getId()-|" />
				<input type="button" id="button_edit_series" name="button_edit_series" title="Editar Curvas" value="Editar Curvas" onClick="location.href='Main.php?do=indicatorsSeriesEdit&id=|-$indicator->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />

				<input type="button" id="button_edit_xs" name="button_edit_xs" title="Editar Meses" value="Editar Meses" onClick="location.href='Main.php?do=indicatorsXsEdit&id=|-$indicator->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />

				<input type="button" id="button_edit_ys" name="button_edit_ys" title="Editar Valores" value="Editar Valores" onClick="location.href='Main.php?do=indicatorsYsEdit&id=|-$indicator->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
	|-/if-|
	|-if !is_object($contract)-|
|-assign var=contract value=$indicator->getContract()-||-/if-|
	<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=indicatorsList&contractId=|-$contract->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'" />

	</form>
		</fieldset>
</div>
|-if $action == "edit"-|
|-/if-|
|-else-|
<div class="errorMessage">Ingresó un Identificador de Curva de Avance inexistente, regrese al listado haciendo <a href="Main.php?do=indicatorsList">click aquí</a></div>
|-/if-|
