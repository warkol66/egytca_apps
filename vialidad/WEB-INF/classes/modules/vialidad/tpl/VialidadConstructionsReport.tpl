<style type="text/css">
table {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table td {
	text-align: center;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}

.red {
	color: black;
	background-color: #ff6666;
}

.yellow {
	color: black;
	background-color:yellow;
}
</style>

<h1 class="yellow">FALTA ELEGIR MES</h1>
<table style="float: left;">
	<tr>
		<th rowspan="3">Departamento Div. Política (*)</th>
		<th rowspan="3">Tipo de Ruta (*)</th>
		<th rowspan="2" colspan="2">Sección (*)</th>
		<th rowspan="3">OBRA</th>
		<th rowspan="3">Tipo de Obra / Capa de Rodadura</th>
		<th rowspan="3">L (Km)</th>
		<th rowspan="2" colspan="2" class="red">Coordenadas Geográficas del Proyecto</th>
		<th rowspan="3">Empresa Contratista (En caso de Consorcio aclarar las empresas que lo conforman y el % de participación)<span class="yellow"> - cómo consigo los participantes del consorcio? no encuentro :(. Y el porcentage? existe?</span></th>
		<th rowspan="3">Empresa Fiscalizadora / Fiscal de Obras</th>
		<th colspan="5"></th>
		<th colspan="4">SITUACION</th>
		<th colspan="2">MONTO</th>
		<th rowspan="2" colspan="2">Certificados Procesados</th>
		<th rowspan="3">Paridad básica Gs / US$</th>
		<th rowspan="2" colspan="2">Convenio Modificatorio</th>
		<th rowspan="3">Porcentaje de Ampliación de Contrato</th>
		<th rowspan="3">Status de la Obra</th>
		<th rowspan="3">Observación</th>
	</tr>
	<tr>
		<th rowspan="2">Fecha de firma Contrato</th>
		<th rowspan="2">Orden de Inicio</th>
		<th rowspan="2">Plazo Contractual (días)</th>
		<th rowspan="2">Plazo Vigente (días)</th>
		<th rowspan="2">Fecha de Finalización Vigente</th>
		<th colspan="4">En ejecución</th>
		<th>Contractual</th>
		<th>Modificado</th>
	</tr>
	<tr>
		<th>De Km</th>
		<th>A Km</th>
		<th class="red">Inicio</th>
		<th class="red">Fin</th>
		<th>% Avance Programado Acumulado</th>
		<th>% Avance Ejecutado Acumulado</th>
		<th>% Avance Programado del mes</th>
		<th>% Avance Ejecutado del mes</th>
		<th>GS</th>
		<th>USD</th>
		<th>Nro.</th>
		<th>Mes/Año</th>
		<th>Cant.</th>
		<th>Situación</th>
	</tr>
	|-foreach $constructions as $construction-|
	|-assign var="contract" value=$construction->getContract()-|
	<tr>
		|-assign var="departments" value=$construction->getDepartments()-|
		<td>
			|-foreach $departments as $department-|
				|-if !$department@first-|, |-/if-||-$department->getName()-|
			|-/foreach-|
		</td>
		<td class="red">por ahora no tenemos este dato</td>
		<td class="red">por ahora no tenemos este dato</td>
		<td class="red">por ahora no tenemos este dato</td>
		<td>|-$construction->getName()-|</td>
		<td>|-assign var="constructionType" value=$construction->getConstructionType()-||-if $constructionType-||-$constructionType->getName()-||-/if-|</td>
		<td>|-$construction->getLength()|system_numeric_format-|<span class="yellow"> - Algún chequeo de la unidad?</span></td>
		<td class="red">Por ahora no está, ver si lo incluimos</td>
		<td class="red">Por ahora no está, ver si lo incluimos</td>
		<td>|-assign var="contractor" value=$construction->getContractor()-||-if $contractor-||-$contractor->getName()-||-/if-|</td>
		<td>|-assign var="affiliate" value=$construction->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</td>
		<td>|-if $contract-||-$contract->getSignDate()|system_date_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getStartDate()|system_date_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getValidationLength()-||-/if-|</td>
		<td class="red">averiguar qué es</td>
		<td class="red">calcular en función del plazo contractual y de la fecha de inicio<span class="yellow"> - calcular cómo?</span></td>
		<td class="red">se puede sacar de las curvas?<span class="yellow"> - qué es / cómo se calcula?</span></td>
		<td class="red">se puede sacar de las curvas?<span class="yellow"> - qué es / cómo se calcula?</span></td>
		<td class="red">se puede sacar de las curvas?<span class="yellow"> - qué es / cómo se calcula?</span></td>
		<td class="red">se puede sacar de las curvas?<span class="yellow"> - qué es / cómo se calcula?</span></td>
		<td class="red">De la base de contratos, lo que está en GS|-if $contract-||-$contract->getAmmount()-|<span class="yellow"> - $contract->getAmmount() (no sé si se usa) o filtrar los contractAmmounts por moneda guaraní?</span>|-/if-|</td>
		<td class="red">|-if $contract-||-$contract->getAmmountModified()-|<span class="yellow"> - $contract->getAmmountModified() (no sé si se usa) o filtrar los contractAmmounts por moneda dolar?</span>|-/if-|</td>
		<td class="red">Contar la cantidad de certificados ya presentados<span class="yellow"> - siendo que el reporte es por mes, no se toman en cuenta los certificados posteriores al mes del reporte, correcto?</span></td>
		<td class="red">Buscar la vigencia del último certificado<span class="yellow"> - siendo que el reporte es por mes, no se toman en cuenta los certificados posteriores al mes del reporte, correcto?</span></td>
		<td class="red">Está en algún lado?</td>
		<td class="red">De la base de contratos<span class="yellow"> - qué es?</span></td>
		<td class="red"></td>
		<td class="red">calcular en función de lo montos de los contratos modificatorios</td>
		<td class="red">averiguar cómo se calcula con Cristian</td>
		<td class="red">por ahora no se guarda en ningún lado</td>
	</tr>
	|-/foreach-|
</table>