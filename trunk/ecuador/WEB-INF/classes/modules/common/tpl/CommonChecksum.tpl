<h2>Configuración</h2>
<h1>Detalle de Checksum de Tablas del Sistema</h1>
<p>A continuación se muestra la lista de tablas que contiene el sistema con su "checksum" respectivo. Se totalizan los checksum de las tablas que consienen información que puede ser comparada (Se indican las tablas que contienen información que recopila información que no afecta la integridad de los datos por lo que no se incluye en el total final).</p>
|-if $noTables-|
	<div class="failureMessage">No se pudo obtener el listado de tablas de la base de datos.</div>
|-else-|
<form name="formTableExport" method="post" action="Main.php?do=commonExport">
	<input type="hidden" name="content" />
	<input type="hidden" name="fileName" />
	<input type="hidden" name="fileType" />
</form>
<table border="0" class="tableTdBorders" id="checksumTable">
	<thead>
	<tr class="thFillTitle">
		<th>Tabla</th>
		<th>Checksum</th>
		<th>Se incluye en total</th>
	</tr>|-$TotalChecksum=0-|
	</thead>
	<tbody>
	|-foreach from=$results item=result-|
  <tr>
    <td>|-$result.Table-|</td>
    <td class="right">|-$result.Checksum|number_format-|</td>
    <td class="center">|-if stristr($result.Table, 'actionLogs_log') || stristr($result.Table, 'propel_migration') || stristr($result.Table, 'users_user')-|NO|-else-|SI|-if $result.Checksum gt 0-||-math equation="x+y" x=$TotalChecksum y=$result.Checksum assign=TotalChecksum-||-/if-||-/if-|</td>
  </tr>
	|-/foreach-|
	</tbody>
	<tfoot>
  <tr class="thFillTitle">
    <td>&nbsp;</td>
    <th class="right">|-$TotalChecksum|number_format-|</th>
    <td>&nbsp;</td>
   </tr>
	</tfoot>
</table>
<p>&nbsp;</p>
<button type="button" onclick="tableExport('checksumTable', 'checksum.xls', 'xls');">Exportar</button>
<p>&nbsp;</p>
|-/if-|
<script language="JavaScript" type="text/JavaScript">
function tableExport(tableId, fileName, fileType){
    var table = document.getElementById(tableId);
    var content  = '<html><head>';
    		content += '<style type="text/css">.right{text-align:right;}.center{text-align:center;}td,th{border:1px solid blue;}';
    		content += 'th{font-weight:bold;text-align:center;}td{text-align:left;}</style></head><body>';

    var wrap = document.createElement('div');
    wrap.appendChild(table.cloneNode(true));

    		content += wrap.innerHTML;
    		content += '</tbody></table></body></html>';

    var form = document.forms["formTableExport"];
    form["fileName"].value = fileName;
    form["fileType"].value = fileType;
    form["content"].value = content;
    form.submit();
}
</script>
