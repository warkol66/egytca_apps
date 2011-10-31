<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody>
					<tr> 
						<td class="titulo">Comparaci&oacute;n de Ciudades</td>
					</tr>
					<tr> 
						<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1"></td>
					</tr>

					<tr> 
						<td>&nbsp;</td>
					</tr>
					<tr> 
						<td class="fondotitulo">Cuadro comparativo de perfiles de Ciudades </td>
					</tr>
					<tr> 
						<td>&nbsp;</td>
					</tr>
				</tbody></table>
				<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
					<tr> 
						<th colspan="2">Comparaci&oacute;n de Ciudades <div class="titulo2">(|-foreach from=$actors item=actor name=actorsLoop-||-if $smarty.foreach.actorsLoop.first-||-else-|-|-/if-||-$actor->getName()-||-/foreach-|)</div></td>
		
							<div align="right"><a href="javascript:void(null);" class="deta" onclick="window.open('|-$urlReport-|','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></div>
						</th>
					</tr>
					<tr>
						<td width="10%" nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
						<td>|-if $form ne ""-||-assign var=formId value=$form->getId()-| <div class='titulo2' style="display: inline;">|-$form->getname($formId)-|</div>|-/if-||-if $forms|@count gt 0 -|
							<div id='formselect' class='texto_noimprimir' style="display: inline;">&nbsp;&nbsp;|-include file="profiles_include_select_form_multiple.tpl"-|</div>
							|-/if-|		 
						</td>
					</tr>
	</table>

|-if $form ne ""-|
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td>
					|-assign var=totalActors value=$actors|@count-|
					|-math equation="( 80 / tA )" tA=$totalActors assign=cellwidth format="%.0f"-|
					|-math equation="( tA + 1 )" tA=$totalActors assign=colspan format="%.0f"-|
		|-if $form->getRootSection()-|
			|-include file=profiles_form_view_multiple_section.tpl section=$form->getRootSection() -|
		|-/if-|
	</td></tr>
				<tr><td class="tablebottom"><img src="index.php_files/clear.gif" height="1" width="1"></td></tr>
				</table>	
|-/if-|
