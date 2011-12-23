|-if !$createForm-|
<h2>Configuración del Sistema</h2>
<h1>Administrar Preguntas</h1>
<p>En esta sección podrá administrar las preguntas del perfil del Actor. Para agregar preguntas puede hacer <a href="#edit">click aquí</a>.</p>
|-foreach from=$forms item=form-|
<fieldset class="formFieldset">
<legend>Formulario: |-$form->getName()-|</legend>
		|-include file="ProfilesFormSectionEditInclude.tpl" section=$form->getRootSection()-|
</fieldset>
|-/foreach-|

<script language="JavaScript" type="text/JavaScript">
	function checkCat(select){
		var a=new String;
		var index = select.selectedIndex;
		a=select.options[index].value.split('-',2);
		if (a[0] == 'new') {
			newName=window.prompt("##231,Nombre de la nueva sección##",'');
			select.form.newSection.value = newName;
			select.form.newSectionParentId.value = a[1];
			select.options[index] = new Option(newName,0);
			select.options[index].selected = true;
		}
	}
</script>

	<form onSubmit="checkCat(this)" action="Main.php?do=profilesFormDoEdit&questionId=|-$question->getId()-|&edit=1" method="POST">
	<input type="hidden" name="newSection" value="" />
	<input type="hidden" name="newSectionParentId" value="" />
	<input type="hidden" name="form" value="|-$form->getId()-|" />
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
			<tr>
			<th colspan="4"><a name="edit">##218,Agregar Pregunta##</a></th>
		</tr>
			<tr>
			<td>##219,Sección##</td>
			<td colspan="3"><select name="sectionId" onChange="checkCat(this)">
			|-html_options options=$sections selected=$question->getSectionId()-|
				</select>
				</td>
		</tr>
			<tr>
			<td width="20%" valign="top">##221,Pregunta##</td>
			<td width="70%"><input name="question" type="text" value="|-$question->getQuestion()-|" size="50" class="textodato"/></td>
			<td width="5%">##226,Orden##</td>
			<td width="5%"><select name="position" >
					|-html_options output=$positions values=$positions selected=$question->getPosition()-|
				</select></td>
		</tr>
			<tr>
			<td valign="top">##220,Etiqueta en gráficos##</td>
			<td><input name="label" type="text"  class="textodato" value="" size="30"/></td>
			<td>##227,Unidad##</td>
			<td><input type="text" maxlength="20" size="8" name="unit" value="|-$question->getUnit()-|" /></td>
		</tr>
			<tr>
			<td valign="top">##222,Tipo de Pregunta##</td>
			<td colspan="3"><table width="100%" border="0" cellpadding="4" cellspacing="1">
					|-foreach from=$question->getTypes() item=typeName key=typeId -|
					|- if $typeId ne $smarty.const.QUESTION_TYPE_OPTIONS -|
					<tr>
						<td><input id="type_|-$typeId-|" type="radio" name="questionType" value="|-$typeId-|" |-if $question->getType() == $typeId-|checked="checked"|-/if-| onClick='switch_vis("optionsTable","none");' />
							<label for="type_|-$typeId-|">|-if $typeName eq "String"-|##300,Texto##|-elseif $typeName eq "Text"-|##300,Texto largo##|-elseif $typeName eq "Currency"-|##300,Moneda##|-elseif $typeName eq "Date"-|##300,Fecha##|-elseif $typeName eq "Number"-|##300,Número##|-elseif $typeName eq "Boolean"-|##300,Cierto o falso##|-/if-|</label>
						</td>
					</tr>
					|-else-| 
					<tr>
						<td valign="top"><input type="radio" name="questionType" value="3" id="type_3" |-if $question->getType() eq $typeId -|checked="checked"|-/if-| OnClick='switch_vis("optionsTable","block");' />
						<label for="type_2">##229,Opciones##</label><div id="optionsTable" style="display:|-if $question->getType() eq $typeId -|block|-else-|none|-/if-|;">
							<table width="100%" border="0" cellpadding="4" cellspacing="1">
								<tr>
									<th width="10%" nowrap>##223,Selec. Inicial##</th>
									<th width="30%" nowrap>##224,Valor##</th>
									<th width="60%" nowrap>##225,Descripción##</th>
								</tr>
								|-foreach from=$question->getOptions(10) item=option key=tempId-|
								<tr>
									<td align="center">
									  <input type="radio" name="default" value="|-$tempId-|" |-if $option->getDefaultOpc() eq 1-|checked="checked"|-/if-| /> </td>
									<td align="center">
									  <input type="text" name="opc[|-$tempId-|]" size="5" value="|-$option->getValue()-|"/></td>
									<td align="center">
									  <input name="rta[|-$tempId-|]" type="text"  class="textodato" value="|-$option->getText()-|" size="30" />
									</td>
								</tr>
								|-/foreach-|
						</table></div></td>
					</tr>
					|-/if-|
					|-/foreach-|
				</table>
			</td>
		</tr>
			<tr>
			<td colspan="4"><input type="submit" name="n_preg" value="##228,Guardar pregunta##" /></td>
		</tr>
		</table>
</form>
|-else-|
<h2>Configuración del Sistema</h2>
<h1>Administrar Formularios</h1>
<p>A continuación puede agregar un formulario completando los campos del mismo. Al finalizar, haga click en "Guardar" para almacenar el formulario en el sistema.</p>
<form method="post">
<fieldset>
<legend>Datos del Formulario</legend>
<p><label for="name">Nombre</label><input type="text" name="params[name]" /></p>
<p><label for="relationship">Formulario de relaciones</label><input type="radio" value="1" name="params[relationship]" /></p>
<p>&nbsp;</p>
<input type="hidden" name="do" value="profilesFormDoEdit">
<input type="hidden" name="newForm" value="1">
<input type="submit" value="Guardar" />
<input type="button" value="Regresar" onClick="location.href='Main.php?do=profilesFormList'"
</fieldset>
</form>
|-/if-|