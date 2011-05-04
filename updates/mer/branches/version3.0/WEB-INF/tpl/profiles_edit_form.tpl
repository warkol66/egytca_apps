<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" alt=" " width='1' height='3' /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'><span class="mda_nombremodulo">##216,Administrar Preguntas##</span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'><span class="comentariostd">##230,En esta sección podrá administrar las preguntas del perfil del Actor. Para agregar preguntas puede hacer## <a href="#edit">##93,click aquí##</a>.</span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
|-foreach from=$forms item=form -|
		|-include file=profiles_edit_form_section.tpl section=$form->getRootSection() -|
	|-/foreach-| <br />
	<script>
	function checkCat(select){
		var a=new String;
//		alert(nue.cat.options[nue.cat.selectedIndex].value);
		var index = select.selectedIndex;
		a=select.options[index].value.split('-',2);
		if (a[0] == 'new'){
			newName=window.prompt("##231,Nombre de la nueva sección##",'');
			select.form.newSection.value = newName;
			select.form.newSectionParentId.value = a[1];
			select.options[index] = new Option(newName,0);
			select.options[index].selected = true;
		}
	}
</script>
	<form onSubmit='checkCat(this)' action="Main.php?do=doProfilesFormEdit&questionId=|-$question->getId()-|&edit=1" method="POST">
	<input type="hidden" name='newSection' value='' />
	<input type="hidden" name='newSectionParentId' value='' />
	<input type="hidden" name="form" value="|-$form->getId()-|" />
	<table width='100%' border="0" cellpadding="3" cellspacing="1" class='tablaborde0'>
			<tr>
			<th colspan='4'><a name='edit'>##218,Agregar Pregunta##</a></th>
		</tr>
			<tr>
			<td class='celldato'>##219,Sección##</td>
			<td colspan='3' class="celldato"><select name='sectionId' onChange="checkCat(this)">
			|-html_options options=$sections selected=$question->getSectionId()-|
				</select>
				</td>
		</tr>
			<tr>
			<td width='20%' valign='top' class="celldato">##221,Pregunta##</td>
			<td width='70%' class="celldato"><input name='question' type='text' value='|-$question->getQuestion()-|' size='50' class='textodato'/></td>
			<td width='5%' class="celldato">##226,Orden##</td>
			<td width='5%' class="celldato"><select name='position' >
					|-html_options output=$positions values=$positions selected=$question->getPosition()-|
				</select></td>
		</tr>
			<tr>
			<td valign='top' class="celldato">##220,Etiqueta en gráficos##</td>
			<td class="celldato"><input name='label' type='text'  class='textodato' value='' size="30"/></td>
			<td class="celldato">##227,Unidad##</td>
			<td class="celldato"><input type="text" maxlength="20" size="8" name="unit" value="|-$question->getUnit()-|" /></td>
		</tr>
			<tr>
			<td valign='top' class="celldato">##222,Tipo de Pregunta##</td>
			<td colspan='3' class="celldato"><table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablaborde0">
					|-foreach from=$question->getTypes() item=typeName key=typeId -|
					|- if $typeId ne $smarty.const.QUESTION_TYPE_OPTIONS -|
					<tr>
						<td colspan="2" class="celldato"><input id='type_|-$typeId-|' type='radio' name='questionType' value='|-$typeId-|' |-if $question->getType() == $typeId-|checked='checked'|-/if-| onClick='switch_vis("optionsTable","none");' />
							<label for="type_|-$typeId-|">|-if $typeName eq "String"-|##300,Texto##|-elseif $typeName eq "Text"-|##300,Texto largo##|-elseif $typeName eq "Money"-|##300,Moneda##|-elseif $typeName eq "Date"-|##300,Fecha##|-elseif $typeName eq "Number"-|##300,Número##|-elseif $typeName eq "Boolean"-|##300,Cierto o falso##|-/if-|</label>
						</td>
					</tr>
					|-else-| 
					<tr>
						<td width="20%" valign='top' class="celldato"><input type='radio' name='questionType' value='3' |-if $question->getType() eq $typeId -|checked='checked'|-/if-| OnClick='switch_vis("optionsTable","block");' />##229,Opciones##</td>
						<td width="80%" class="celldato"><div id="optionsTable" style='display:|-if $question->getType() eq $typeId -|block|-else-|none|-/if-|;'>
							<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablaborde0">
								<tr>
									<th>##223,Selec. Inicial##</th>
									<th align='left'>##224,Valor##</th>
									<th align='left'>##225,Descripción##</th>
								</tr>
								|-foreach from=$question->getOptions(10) item=option key=tempId-|
								<tr>
									<td class="celldato"><input type="radio" name="default" value="|-$tempId-|" |-if $option->getDefaultOpc() eq 1-|checked='checked'|-/if-| /> </td>
									<td width='0%' class="celldato"><input type='text' name='opc[|-$tempId-|]' size='3' value='|-$option->getValue()-|'/></td>
									<td class="celldato"><input name='rta[|-$tempId-|]' type='text'  class='textodato' value='|-$option->getText()-|' size="30" />
									</td>
								</tr>
								|-/foreach-|
						</table></div></td>
					</tr>
					|-/if-|
					|-/foreach-|
				</table></td>
		</tr>
			<tr>
			<td colspan='4' class='cellboton'><input type='submit' name='n_preg' value='##228,Guardar pregunta##'  class='boton' /></td>
		</tr>
		</table>
</form>
