<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tablaborde'>
	<tr>
		<th colspan='2'> <form method="GET" action="Main.php" style="display:inline">
				<input type="hidden" name="do" value="|-$smarty.request.do-|" />
				<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
				##210,Relaciones entre## |-$actor1->getName()-| ##211,y##
				<select name='actor2' onchange="this.form.submit()">
					|-html_options options=$actors selected=$actor2->getId() -|
				</select>
				<div class="reportlinkdiv"><a href="javascript:void(null);" class="deta" onclick="window.open('#','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div>
			</form></th>
	</tr>
	|-if $actor2->getId() -|
	<tr>
		<td width="10%" valign='top' nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
		<td valign='top' class='celldato'>|-assign var=formId value=$form->getId()-| <div class='titulo2'  style="display: inline;">|-$form->getname($formId)-|</div>|-if $forms|@count gt 1 -| 
			<div id='formselect' class='texto_noimprimir' style="display: inline;">&nbsp;&nbsp;|-include file="profiles_include_select_form.tpl"-|</div>
			|-/if-|		 
		</td>
	</tr>
	|-/if-|
</table>

|-if $actor2->getId() -|
<form method="POST"	name="formQuestions" action="Main.php?do=doProfilesFormRelFill">
	<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
	<input type="hidden" name="actor2" value="|-$actor2->getId()-|" />
	<input type="hidden" name="form" value="|-$form->getId()-|" />
	|-if $smarty.request.showAll-|
	<input type="hidden" name="showAll" value="1" />
	|-/if-|
	<table class="tablaborde" cellpadding="0" cellspacing="1" width="100%">
		<tr>
			<th width='60%'>Pregunta</th>
			<th width="4%">|-if $smarty.request.showAll-|Activa|-/if-|</th>
			<th width="26%">Valores</th>
			<th width="10%">Unidad</th>
		</tr>
		|-foreach from=$forms item=form -|
		|-include file=profiles_fill_form_relationship_section.tpl section=$form->getRootSection() -|
		|-/foreach-|
	</table>
	<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
|-if $smarty.request.showAll-|		
	<tr>
		<td class="celldato">&nbsp;</td>
	</tr>
	<tr>
			<td class="celldato">	
	<label for="selectAll">Seleccionar todas las preguntas</label><input type="checkbox" name="selectAll" onclick="javascript:selectAllQuestions(this.checked)" />
	</td>
		</tr>
		<tr>
			<td class="celldato">&nbsp;</td>
		</tr>|-/if-|
		<tr>
			<td class="cellboton">	<input type="submit" value="##212,Guardar cambios##" />
			</td>
		</tr>
		<tr>
			<td class="tablebottom"><img src="images/clear.gif" height="1" width="1"></td>
		</tr>
	</table>
</form>
|-if not $smarty.request.showAll-| <a href="|-$smarty.server.REQUEST_URI-|&showAll=1">##213,Ver todas las preguntas##</a> |-/if-|
|-/if-|
