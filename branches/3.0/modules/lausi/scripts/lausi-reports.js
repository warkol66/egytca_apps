function buildReport(form) {
	form.target = '_parent';
	$('reportMode').value = 'normal';
	form.submit();
}

function printReport(form) {
	form.target = '_blank';
	$('reportMode').value = 'print';
	form.submit();
}

function exportReport(form) {
	form.target = '_parent';
	$('reportMode').value = 'xls';
	form.submit();
}