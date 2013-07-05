|-if !$report-|
|-include file="CommonAutocompleterInclude.tpl"-|

<h2>Reportes</h2>
<h1>Reporte de Obras</h1>
<p>A continuación podrá generar un reporte de las obras presentes en el sistema. Seleccione uno o más parámetros para generar un reporte de obras, el mismo abrirá en ventana nueva.
<br>
Los reportes de obra están generados en formatos compatibles con herramientas tipo office, cualqueir resultado puede ser guardado localmente y accedido por hojas de cálculo o procesadores de texto.</p>
<fieldset>
	<legend>Reportes</legend><form action='Main.php' method='get' style="display:inline;">
		<input type="hidden" name="do" value="vialidadConstructionsReport" />
					<label for="filters[searchString]">Buscar por texto</label>
					<input id="filters[searchString]" name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp; &nbsp; <label for="filters[perPage]" class="inlineLabel labelWide">Resultados por página</label> &nbsp;
					|-html_options name="filters[perPage]" id="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getMaxPerPage()-|
					<p>
						<div style="position: relative;z-index:11000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_constructions" url="Main.php?do=vialidadConstructionsAutocompleteListX" hiddenName="filters[id]" label="Obra" defaultValue=$defaultConstructionValue-|
						</div>
					</p>
					<p>
						<div style="position: relative;z-index:10000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_contracts" url="Main.php?do=vialidadContractsAutocompleteListX" hiddenName="filters[contractid]" label="Contrato" defaultValue=$defaultContractValue-|
						</div>
					</p>
			<p>
				<label for="filters[typeid]">Tipo de Obra</label>
				<select id="filters[typeid]" name="filters[typeid]" >
        		<option value="">Seleccione</option>
				|-foreach from=$types item=type name=for_type-|
        		<option value="|-$type->getId()-|">|-$type-|</option>
				|-/foreach-|
				</select>
			</p>
					<p>
				<input type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadConstructionsReport'"/>
				<input type="button" value="Generar Reporte" onclick="window.open(('Main.php?'+Form.serialize(this.form)+'&report=true'));"/>
</p>
			</form>
	</fieldset>

|-else-|
	|-include file="VialidadConstructionsReportInclude.tpl"-|
|-/if-|