<h2>Facturas</h2>
<h1>Facturas de Certificados</h1>
<table class='tableTdBorders'>
	<thead>
		<tr>
			<th>id</th>
			<th>Certificado</th>
			<th>Total Certificado</th>
			<th>Retención de Anticipo</th>
			<th>Retención</th>
			<th>Total</th>
			<th>Acumulado Total</th>
			<th>Acumulado Retención</th>
			<th>Estado</th>
		</tr>
	</thead>
	<tbody>
		|-foreach $certificateInvoiceColl as $certificateInvoice-|
			<tr>
				<td>|-$certificateInvoice->getId()-|</td>
				<td>|-$certificateInvoice->getCertificateId()-|</td>
				<td>|-$certificateInvoice->getCertificate()->getTotalPrice()|system_numeric_format-|</td>
				<td>|-$certificateInvoice->getAdvancePaymentRecovery()|system_numeric_format-|</td>
				<td>|-$certificateInvoice->getWithholding()|system_numeric_format-|</td>
				<td>|-$certificateInvoice->getTotalPrice()|system_numeric_format-|</td>
				<td>|-$certificateInvoice->getAccumulatedTotalPrice()|system_numeric_format-|</td>
				<td>|-$certificateInvoice->getAccumulatedWithholding()|system_numeric_format-|</td>
				<td>|-$certificateInvoice->getStatus()-|</td>
			</tr>
		|-/foreach-|
	</tbody>
</table>