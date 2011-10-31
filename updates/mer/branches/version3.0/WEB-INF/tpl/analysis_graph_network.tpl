<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	<tbody> 
		<tr> 
			<td class="title">Comparaci&oacute;n de Ciudades
			<div class="underlineTitle"><img src="index.php_files/clear.gif" height="3" width="1"></div><div class="titleBackground">Cuadro comparativo de perfiles de Ciudades</div></td> 
		</tr> 
	</tbody> 
</table> 
<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%"> 
	<tr> 
		<th colspan="2"><div class='textTitleTh'>Comparaci&oacute;n de Ciudades
				<div class="titulo2">(|-foreach from=$actors item=actor name=actorsLoop-||-if $smarty.foreach.actorsLoop.first-||-else-|-|-/if-||-$actor->getName()-||-/foreach-|)</div> 
				<div align="right" style="display:none;"><a href="javascript:void(null);" class="deta" onclick="window.open('|-$urlReport-|','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div> 
			</div></th> 
	</tr> 
	<tr> 
		<td width="10%" nowrap class="tdTitle2"><div class="textTitle2">Formulario:</div></td> 
		<td clas="tdTextTitle">|-if $form ne ""-||-assign var=formId value=$form->getId()-|
			<div class="noPrint" style="display: inline;">|-$form->getname($formId)-|</div> 
			|-/if-||-if $forms|@count gt 1 -|
			<div id='formselect' class='noPrint' style="display: inline;">&nbsp;&nbsp;|-include file="profiles_include_select_form_multiple.tpl"-|</div> 
			|-/if-| </td> 
	</tr> 
</table> 
|-if $form ne ""-|
<h2>Gráfico de Intercambios</h2> 
<iframe name="frame_graph" id="frame_graph" style="border: 1px solid #000099; display: block; width: 630px; height: 380px;" border="0" src="Main.php?do=analysisGraphNetworkShow|-$urlActors-|&form=|-$form->getId()-|" frameborder="0" scrolling="no"></iframe> 
<form name="form_questions" action="Main.php"> 
	<input type="hidden" name="do" value="analysisGraphNetworkShow" /> 
	<input type="hidden" name="categoryId" value="|-$categoryId-|" /> 
	<input type="hidden" name="form" value="|-$form->getId()-|" /> 
	<ul>
 		|-foreach from=$questions item=question-| <img src="images/px_vacio.gif" width="10" height="10" class="divColorLabel" style="background-color:|-$question->color-|;">|-$question->getQuestion()-| 
		<input type="checkbox" name="questions[]" value="|-$question->getId()-|" /> 
		<br /> 
		|-/foreach-|
	</ul> 
	<input type="button" value="Mostrar Intercambios" onclick="showGraphNetwork('|-$urlActors-|')" /> 
</form> 
|-/if-| 