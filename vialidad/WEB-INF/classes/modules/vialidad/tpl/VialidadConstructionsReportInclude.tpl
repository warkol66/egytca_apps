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
/* tooltip ----- */
a.tooltip, a.tooltipWide{
	vertical-align: top;
	padding: 0 4px 0 4px;
}
a.tooltip img, a.tooltipWide img{
	border: none;
}
a.tooltip:hover,a.tooltipWide:hover {
	text-decoration:none;
} /*BG color is a must for IE6*/
a.tooltip span,a.tooltipWide span {
	background:#ffffff;
	display:none;
	padding:2px 3px;
	margin-left: 18px;
	width:150px;
	font-weight: normal !important;
	text-align: justify !important;
	z-index: 1000;
}
a.tooltip:hover span, a.tooltipWide:hover span{
	display: inline;
	position: absolute;
	margin-top: -65px;
	background: #ffffff;
	border:1px solid #FF6600;
	color: #006699;
}
a.tooltipWide span {
	width:300px;
}
.left {
text-align: left !Important;
}
/* /tooltip ------*/
</style>

<h1>Reporte de Obras</h1>
<h4>Al |-$date|date_format-|</h4>
<table style="float: left;">
	<tr>
		<th rowspan="3">Departamento Div. Política (*)</th>
		<th rowspan="3">Tipo de Ruta (*)</th>
		<th rowspan="2" colspan="2">Sección (*)</th>
		<th rowspan="3">OBRA</th>
		<th rowspan="3">Tipo de Obra / Capa de Rodadura</th>
		<th rowspan="3">L (Km)</th>
		<th rowspan="2" colspan="2">Coordenadas Geográficas del Proyecto</th>
		<th rowspan="3">Empresa Contratista (En caso de Consorcio aclarar las empresas que lo conforman y el % de participación)</th>
		<th rowspan="3">Empresa Fiscalizadora / Fiscal de Obras</th>
		<th colspan="5"></th>
		<th colspan="4">SITUACION</th>
		<th colspan="2">MONTO</th>
		<th rowspan="2" colspan="2">Certificados Procesados</th>
		<th rowspan="3">Paridad básica Gs / US$</th>
		<th rowspan="2" colspan="2">Montos</th>
		<th rowspan="3">Porcentaje de Ampliación de Contrato</th>
		<th rowspan="3">Status de la Obra</th>
		<th rowspan="3">Observación</th>
	</tr>
	<tr>
		<th rowspan="2">Fecha de firma Contrato</th>
		<th rowspan="2">Orden de Inicio</th>
		<th rowspan="2">Plazo Contractual (días)</th>
		<th rowspan="2">Plazo Vigente (días)</th>
		<th rowspan="2">Fecha de Finalización Vigente<a class="tooltip" href="#"><span class="tooltip">Fecha de firma del contrato mas periodo en dias</span><img src="images/icon_info.png"></a></th>
		<th colspan="4">En ejecución</th>
		<th>Contractual</th>
		<th>Modificado</th>
	</tr>
	<tr>
		<th>De Km</th>
		<th>A Km</th>
		<th>Inicio</th>
		<th>Fin</th>
		<th>Avance Programado Acumulado</th>
		<th>Avance Ejecutado Acumulado</th>
		<th>Avance Programado del mes</th>
		<th>Avance Ejecutado del mes</th>
		<th>GS</th>
		<th>USD</th>
		<th>Nro.</th>
		<th>Mes/Año</th>
		<th>Gs.</th>
		<th>US$</th>
	</tr>
	|-if $constructionColl->count() eq 0-|
	<tr><td height="50" colspan="30" class="left">No hay registros que concuerden con la búsqueda</td>
	</tr>
	|-else-|
	|-foreach $constructionColl as $construction-|
	|-assign var="contract" value=$construction->getContract()-|
	<tr>
		|-assign var="departments" value=$construction->getDepartments()-|
		<td>
			|-foreach $departments as $department-|
				|-if !$department@first-|, |-/if-||-$department->getName()-|
			|-/foreach-|
		</td>
		<td>|-$construction->getRouteType()-|</td>
		<td>|-$construction->getRouteStartingKm()|system_numeric_format:3-|</td>
		<td>|-$construction->getRouteEndingKm()|system_numeric_format:3-|</td>
		<td>|-$construction->getName()-|</td>
		<td>|-assign var="constructionType" value=$construction->getConstructionType()-||-if $constructionType-||-$constructionType->getName()-||-/if-|</td>
		<td>|-$construction->getLength()|system_numeric_format-|</td>
		<td>Latitud: |-$construction->getStartingLatitude()|system_numeric_format:8-|, Longitud: |-$construction->getStartingLongitude()|system_numeric_format:8-|</td>
		<td>Latitud: |-$construction->getendingLatitude()|system_numeric_format:8-|, Longitud: |-$construction->getEndingLongitude()|system_numeric_format:8-|</td>
		<td>|-assign var="contractor" value=$construction->getContractor()-||-if $contractor-||-$contractor->getName()-||-/if-|</td>
		<td>|-assign var="affiliate" value=$construction->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</td>
		<td>|-if $contract-||-$contract->getSignDate()|system_date_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getStartDate()|system_date_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getValidationLengthInDays()-||-/if-|</td>
		<td>|-if $contract-||-$contract->getValidationLengthModifiedInDays()-||-/if-|</td>
		<td>|-if $contract-||-$contract->getCalculatedEndDate()|date_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getAcummulatedProgrammedProgress($date|date_format:'%Y-%m-%d')-||-/if-|</td>
		<td>|-$construction->getAccumulatedPriceOnPeriod($period)-|</td>
		<td>|-if $contract-||-$contract->getProgrammedProgress($date|date_format:'%Y-%m-%d')-||-/if-|</td>
		<td>|-$construction->getPriceOnPeriod($period)-|</td>
		<td>|-if $contract-||-$contract->getAmmount()|system_numeric_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getAmmountModified()|system_numeric_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getCertificatesCount()|system_numeric_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getLastCertificateDate()|date_format:"m/Y"-||-/if-|</td>
		<td>|-if $contract-||-$contract->getExchangeRate()|system_numeric_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getAmountGs()|system_numeric_format-||-/if-|</td>
		<td>|-if $contract-||-$contract->getAmountUsD()|system_numeric_format-||-/if-|</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	|-/foreach-|
	|-/if-|
</table>