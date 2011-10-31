<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="titulo">##197,Caracterización de Actores##</td>
	</tr>
	<tr>
		<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="fondotitulo">##198,Edición de Perfiles##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="texto">##201,Ingrese la información de caracterización del Actor## <strong>&quot;|-$actor->getName()-|&quot;</strong>.</td>
	</tr>
	</tr>
	<td>&nbsp;</td>
	</tr>
</table>
<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tr>
		<th colspan="2">##202,Caracterización de## |-$actor->getName()-|
			<div align="right"><a href="javascript:void(null);" class="deta" onclick="window.open('Main.php?do=profilesFormView&actor=|-$actor->getId()-|&form=|-$form->getId()-|&report=1','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></th>
	</tr>
	<tr>
		<td width="10%" nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
		<td>|-assign var=formId value=$form->getId()-| <div class='titulo2' style="display: inline;">|-$form->getname($formId)-|</div>|-if $forms|@count gt 1 -| 
			<div id='formselect' class='texto_noimprimir' style="display: inline;">&nbsp;&nbsp;|-include file="profiles_include_select_form.tpl"-|</div>
			|-/if-|		 </td>
	</tr>
	<tr>
		<td valign='top' colspan='2'>
	|-if $form->getRootSection()-|
	|-include file=profiles_form_view_section.tpl section=$form->getRootSection() -|
	|-/if-|
	</td>
		</tr>
	<tr>
		<td colspan="2" class="tablebottom"><img src="index.php_files/clear.gif" height="1" width="1"></td>
	</tr>
</table>
