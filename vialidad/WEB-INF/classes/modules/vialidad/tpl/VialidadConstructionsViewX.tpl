<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
</script>
  <h2>Obras</h2> 
  <h1>Administración de Obras</h1> 
  <table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Contrato</td> 
      <td>|-$construction->getContract()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Obra</td> 
      <td>|-$construction->getName()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Descripción</td> 
      <td>|-$construction->getDescription()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Contratista</td> 
      <td>|-$construction->getContractor()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Fiscalizadora</td> 
      <td>|-$construction->getVerifier()-|</td> 
    </tr> 
     <tr> 
      <td colspan="2">
				<input type="button" title="Ver gráfico de ejecución" value="Ver gráfico de ejecución" onClick="location.href='Main.php?do=vialidadCertificatesViewGraph&entityType=construction&entityId=|-$construction->getid()-|'" />
     </tr> 
   </table> 
