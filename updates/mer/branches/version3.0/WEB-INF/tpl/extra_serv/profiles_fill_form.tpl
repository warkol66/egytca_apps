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
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
|-if $smarty.request.status eq 'ok' -|<div align="center" class="textoerror">##206,Cambios guardados##</div> |-/if-|
	<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
			<tr>
				<th colspan="2">##202,Caracterización de## |-$actor-|</th>
			</tr>
	<tr>
		<td width="10%" nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
		<td class='celldato'>|-assign var=formId value=$form->getId()-| <div class='titulo2' style="display: inline;">|-$form->getname($formId)-|</div>|-if $forms|@count gt 1 -| 
			<div id='formselect' class='texto_noimprimir' style="display: inline;">&nbsp;&nbsp;|-include file="profiles_include_select_form.tpl"-|</div>
			|-/if-|		 </td>
	</tr>

	</table>
	


<form method="POST"	name="formQuestions" action="Main.php?do=doProfilesFormFill">
	<input type="hidden" name="actor" value="|-$actor->getId()-|" />
	<input type="hidden" name="form" value="|-$form->getId()-|" />
	|-if $smarty.request.showAll-|
	<input type="hidden" name="showAll" value="1" />
	|-/if-|
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td>
			|-if $form->getRootSection()-|
				|-include file=profiles_fill_form_section.tpl section=$form->getRootSection() -|
			|-/if-|
				</td>
		</tr>
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
			<td class="cellboton"><input name="guardar" value="##203,Guardar datos de la sección##" class="boton" type="submit">
			</td>
		</tr>
		<tr>
			<td class="tablebottom"><img src="images/clear.gif" height="1" width="1"></td>
		</tr>
	</table>
</form>
|-if not $smarty.request.showAll-| <a href="|-$smarty.server.REQUEST_URI-|&showAll=1">##213,Ver todas las preguntas##</a> |-/if-|
