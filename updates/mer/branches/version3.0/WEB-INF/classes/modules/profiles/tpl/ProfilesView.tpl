<h2>##197,Caracterización de Actores##</h2>
<h1>Visualización de Perfiles</h1>
|-if !$notValidId-|
<p>A continuación se muestra la caracterización del Actor <strong>&quot;|-$actor->getName()-|&quot;</strong>.</p>
<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tr>
		<th colspan="2">##202,Caracterización de## |-$actor->getName()-| - |-$form-|
			<div align="right"><a href="javascript:void(null);" class="deta" onclick="window.open('Main.php?do=profilesView&actor=|-$actor->getId()-|&form=|-$form->getId()-|&report=1','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></th>
	</tr>
	<tr>
		<td width="10%" nowrap>Formulario:</td>
		<td>|-assign var=formId value=$form->getId()-| <div style="display: inline;">|-$form-|</div>|-if $forms|@count gt 1-| 
			<div id='formselect' class='noPrint' style="display: inline;">&nbsp;&nbsp;|-include file="ProfilesSelectFormInclude.tpl"-|</div>
			|-/if-|		 </td>
	</tr>
	<tr>
		<td valign='top' colspan='2'>
	|-if $form->getRootSection()-|
	|-include file="ProfilesFormViewSection.tpl" section=$form->getRootSection()-|
	|-/if-|
	</td>
		</tr>
</table>
|-else-|
<div class="errorMessage">El identificador del actor ingresado no es válido. Seleccione un item del listado.</div>
<input onclick="history.go(-1)" value="##104,Regresar##" type="button">
|-/if-|