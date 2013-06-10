<h2>Configuración</h2>
<h1>Detalle de Checksum de Tablas del Sistema</h1>
<p>A continuación se muestra la lista de tablas que contiene el sistema con su "checksum" respectivo. Se totalizan los checksum de las tablas que consienen información que puede ser comparada (Se indican las tablas que contienen información que recopila información que no afecta la integridad de los datos por lo que no se incluye en el total final).</p>
|-if $noTables-|
	<div class="failureMessage">No se pudo obtener el listado de tablas de la base de datos.</div>
|-else-|
<table border="0" class="tableTdBorders">
      <tr class="thFillTitle">
        <th>Tabla</th>
        <th>Checksum</th>
        <th>Se incluye en total</th>
      </tr>
		|-assign var=TotalChecksum value=0-|
		|-foreach from=$results item=result-|
  <tr>
    <td>|-$result.Table-|</td>
    <td align="right">|-$result.Checksum|number_format-|</td>
    <td align="center">|-if stristr($result.Table, 'actionLogs_log') || stristr($result.Table, 'propel_migration')-|NO|-else-|SI|-if $result.Checksum gt 0-||-math equation="x+y" x=$TotalChecksum y=$result.Checksum assign=TotalChecksum-||-/if-||-/if-|</td>
  </tr>
		|-/foreach-|
      <tr class="thFillTitle">
        <td></td>
        <th align="right">|-$TotalChecksum|number_format-|</th>
        <td></td>
      </tr>
</table>
|-/if-|
