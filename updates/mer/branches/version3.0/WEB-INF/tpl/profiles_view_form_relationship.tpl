<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tablaborde'>
	<tr>
		<th colspan='3'> <form method="GET" action="Main.php" style="display:inline">
				<input type="hidden" name="do" value="profilesFormRelView" />
				<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
				##210,Relaciones entre## |-$actor1->getName()-| ##211,y## 
				|-if $actor2->getId()-|
				|-$actor2->getName()-|
				|-else-|
				<select onchange="this.form.submit()" name='actor2'>
					|-html_options options=$actors-|
				</select>
				|-/if-|
			</form><div align="right">
			<a href="javascript:void(null);" class="deta" onclick="window.open('Main.php?do=profilesFormRelView&actor=|-$actor1->getId()-|&actor2=|-$actor2->getId()-|&form=|-$form->getId()-|&report=1','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div>			
		</th>
	</tr>
	|-if $actor2->getId()-|
	<tr>
		<td width="10%" valign='top' nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
		<td valign='top' class='celldato'>|-assign var=formId value=$form->getId()-| <div class='titulo2'>|-$form->getname($formId)-|</div>|-if $forms|@count gt 1 -| 
			<div id='formselect' class='texto_noimprimir' style="display: inline;">&nbsp;&nbsp;|-include file="profiles_include_select_form.tpl" relation=1-|</div>
			|-/if-|		 </td>
	</tr>
|-include file=profiles_view_form_relationship_section.tpl section=$form->getRootSection() -|
|-/if-|
</table>