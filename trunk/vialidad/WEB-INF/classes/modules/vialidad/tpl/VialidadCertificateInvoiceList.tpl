<style type="text/css">
	table th {
		border-bottom: 2px solid #666666;
		padding: 6px;
	}
	
	table td {
		border-top: 1px solid #666666;
		padding: 6px;
	}
</style>

<table>
	<thead>
		<tr>
			<th>id</th>
			<th>certificateId</th>
			<th>certificateTotalPrice</th>
			<th>advancePaymentRecovery</th>
			<th>withholding</th>
			<th>totalPrice</th>
		</tr>
	</thead>
	<tbody>
		|-foreach $certificateInvoiceColl as $certificateInvoice-|
			<tr>
				<td>|-$certificateInvoice->getId()-|</td>
				<td>|-$certificateInvoice->getCertificateId()-|</td>
				<td>|-$certificateInvoice->getCertificate()->getTotalPrice()-|</td>
				<td>|-$certificateInvoice->getAdvancePaymentRecovery()-|</td>
				<td>|-$certificateInvoice->getWithholding()-|</td>
				<td>|-$certificateInvoice->getTotalPrice()-|</td>
			</tr>
		|-/foreach-|
	</tbody>
</table>