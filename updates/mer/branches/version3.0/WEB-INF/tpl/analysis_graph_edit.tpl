<script>
	function enableSelect(value,axis) {
		switch (value) {
			case "0": document.getElementById("tr_select_simple_"+axis).style.display = "table-row";
							document.getElementById("tr_select_multiple_doble_"+axis).style.display = "none";
							document.getElementById("tr_select_multiple_"+axis).style.display = "none";
							break;
			case "1": document.getElementById("tr_select_simple_"+axis).style.display = "none";
							document.getElementById("tr_select_multiple_doble_"+axis).style.display = "table-row";
							document.getElementById("tr_select_multiple_"+axis).style.display = "none";
							break;
			default: document.getElementById("tr_select_simple_"+axis).style.display = "none";
								document.getElementById("tr_select_multiple_doble_"+axis).style.display = "none";
								document.getElementById("tr_select_multiple_"+axis).style.display = "table-row";
		}
	}
</script>

<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1' /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Administración de Gráficos </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>Administrar los gráficos </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<form method='post' action='Main.php?do=analysisGraphDoEdit' style="display:inline">
	<table width="100%" border="0" cellpadding='0' cellspacing='1' class='tablaborde0'>
		<thead>
			<tr>
				<th class='tituloseccion02' colspan='2'>Nuevo gráfico</th>
			</tr>
			<tr>
				<td width="20%" class='celltitulo1'>Nombre</td>
				<td width="80%" class='celldato'><input type='text' name='name' size='30' value='|-if $action eq "edit"-||-$graph->getName()-||-/if-|' maxlength='255' />
					|-if $action eq "edit"-|
					<input type='hidden' name='id' value='|-$graph->getId()-|' />
					|-/if-| </td>
			</tr>
			<tr>
				<td class='celltitulo1'>Tipo de Gráfico</td>
				<td class='celldato'><select name='type' onchange="javascript:showOptionsGraph(this)">
						<option value="plot_bubble"|-if $action eq "edit" and $graph->getType() eq "plot_bubble"-| selected="selected"|-/if-|>Plot Bubble</option>
						<option value="plot"|-if $action eq "edit" and $graph->getType() eq "plot"-| selected="selected"|-/if-|>Plot</option>
						<option value="pie"|-if $action eq "edit" and $graph->getType() eq "pie"-| selected="selected"|-/if-|>Pie</option>
						<option value="infography"|-if $action eq "edit" and $graph->getType() eq "infography"-| selected="selected"|-/if-|>Infography</option>
					</select>
				</td>
			</tr>
		</thead>
		<tbody id="div_plot"|-if $action eq "edit" and ( $graph->getType() eq "pie" or $graph->getType() eq "infography" )-| style="display:none;"|-/if-|
		<tr>
			<td class='celltitulo1'>Actores</td>
			<td class='celldato'><input type='radio' name='actors' value='0' |-if $action eq "edit" and $graph->getActors() eq 0-|checked='checked' |-/if-|/> Todos<br />
				<input type='radio' name='actors' value='1' |-if $action eq "edit" and $graph->getActors() eq 1-|checked='checked' |-/if-|/> Uno </td>
		</tr>
		<tr>
			<th colspan='2'>Eje X</th>
		</tr>
		<tr>
			<td class='celltitulo1'> Etiqueta X </td>
			<td class='celldato'><input type='text' name='labelX' value='|-if $action eq "edit"-||-$graph->getLabelX()-||-/if-|' />
			</td>
		</tr>
		<tr>
			<td class='celltitulo1'> Tipo Valor </td>
			<td class='celldato'><select name='typeX' onchange="javascript:enableSelect(this.value,'x')">
					<option value='0'|-if $action eq "edit" and $graph->getTypeX() eq 0-| selected="selected"|-/if-|>Valor unico</option>
					<option value='4'|-if $action eq "edit" and $graph->getTypeX() eq 4-| selected="selected"|-/if-|>Usar el mayor valor</option>
					<option value='5'|-if $action eq "edit" and $graph->getTypeX() eq 5-| selected="selected"|-/if-|>Usar el menor valor</option>
					<option value='6'|-if $action eq "edit" and $graph->getTypeX() eq 6-| selected="selected"|-/if-|>Promedio</option>
					<option value='7'|-if $action eq "edit" and $graph->getTypeX() eq 7-| selected="selected"|-/if-|>Sumatoria</option>
					<option value='1'|-if $action eq "edit" and $graph->getTypeX() eq 1-| selected="selected"|-/if-|>Cociente de valores</option>
				</select>
			</td>
		</tr>
		<tr id="tr_select_simple_x"|-if $action eq "edit" and $graph->getTypeX() ne 0-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_simple_x">
				|-foreach from=$forms item=form -|
					|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsX0-|
				|-/foreach-|
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_x"|-if ($action eq "edit" and $graph->getTypeX() lt 4) or $action eq "new"-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_x[]">
				|-foreach from=$forms item=form -|
					|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsX4-|
				|-/foreach-|
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_doble_x"|-if ($action eq "edit" and ($graph->getTypeX() lt 1 or $graph->getTypeX() gt 3) ) or $action eq "new"-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_doble_1_x[]">
				|-foreach from=$forms item=form -|
						|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsX2-|
				|-/foreach-|
				</select>
				<select multiple="multiple" name="select_multiple_doble_2_x[]">
					|-foreach from=$forms item=form -|
						|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsX3-|
					|-/foreach-|
				</select>
			</td>
		</tr>
		<tr>
			<th colspan='2'>Eje Y</th>
		</tr>
		<tr>
			<td class='celltitulo1'> Etiqueta Y </td>
			<td class='celldato'><input type='text' name='labelY' value='|-if $action eq "edit"-||-$graph->getLabelY()-||-/if-|' />
			</td>
		</tr>
		<tr>
			<td class='celltitulo1'> Tipo Valor </td>
			<td class='celldato'><select name='typeY' onchange="javascript:enableSelect(this.value,'y')">
					<option value='0'|-if $action eq "edit" and $graph->getTypeY() eq 0-| selected="selected"|-/if-|>Valor unico</option>
					<option value='4'|-if $action eq "edit" and $graph->getTypeY() eq 4-| selected="selected"|-/if-|>Usar el mayor valor</option>
					<option value='5'|-if $action eq "edit" and $graph->getTypeY() eq 5-| selected="selected"|-/if-|>Usar el menor valor</option>
					<option value='6'|-if $action eq "edit" and $graph->getTypeY() eq 6-| selected="selected"|-/if-|>Promedio</option>
					<option value='7'|-if $action eq "edit" and $graph->getTypeY() eq 7-| selected="selected"|-/if-|>Sumatoria</option>
					<option value='1'|-if $action eq "edit" and $graph->getTypeY() eq 1-| selected="selected"|-/if-|>Cociente de valores</option>
				</select>
			</td>
		</tr>
		<tr id="tr_select_simple_y"|-if $action eq "edit" and $graph->getTypeY() ne 0-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_simple_y">
					
						|-foreach from=$forms item=form -|
							|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsY0-|
						|-/foreach-|
					
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_y"|-if ($action eq "edit" and $graph->getTypeY() lt 4) or $action eq "new"-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_y[]">
					
						|-foreach from=$forms item=form -|
							|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsY4-|
						|-/foreach-|
						
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_doble_y"|-if ($action eq "edit" and ($graph->getTypeY() lt 1 or $graph->getTypeY() gt 3) ) or $action eq "new"-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_multiple_doble_1_y[]" multiple="multiple">
					
						|-foreach from=$forms item=form -|
							|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsY2-|
						|-/foreach-|
						
				</select>
				<select name="select_multiple_doble_2_y[]" multiple="multiple">
					
						|-foreach from=$forms item=form -|
							|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsY3-|
						|-/foreach-|
						
				</select>
			</td>
		</tr>
		</tbody>
		<tbody id="div_plot_bubble"|-if $action eq "edit" and ( $graph->getType() eq "pie" or $graph->getType() eq "infography" or $graph->getType() eq "plot")-| style="display:none;"|-/if-|
		<tr>
			<th colspan='2'>Eje Z</th>
		</tr>
		<tr>
			<td class='celltitulo1'> Etiqueta Z </td>
			<td class='celldato'><input type='text' name='labelZ' value='|-if $action eq "edit"-||-$graph->getLabelZ()-||-/if-|' />
			</td>
		</tr>
		<tr>
			<td class='celltitulo1'> Tipo Valor </td>
			<td class='celldato'><select name='typeZ' onchange="javascript:enableSelect(this.value,'z')">
					<option value='0'|-if $action eq "edit" and $graph->getTypeZ() eq 0-| selected="selected"|-/if-|>Valor unico</option>
					<option value='4'|-if $action eq "edit" and $graph->getTypeZ() eq 4-| selected="selected"|-/if-|>Usar el mayor valor</option>
					<option value='5'|-if $action eq "edit" and $graph->getTypeZ() eq 5-| selected="selected"|-/if-|>Usar el menor valor</option>
					<option value='6'|-if $action eq "edit" and $graph->getTypeZ() eq 6-| selected="selected"|-/if-|>Promedio</option>
					<option value='7'|-if $action eq "edit" and $graph->getTypeZ() eq 7-| selected="selected"|-/if-|>Sumatoria</option>
					<option value='1'|-if $action eq "edit" and $graph->getTypeZ() eq 1-| selected="selected"|-/if-|>Cociente de valores</option>
				</select>
			</td>
		</tr>
		<tr id="tr_select_simple_z"|-if $action eq "edit" and $graph->getTypeZ() ne 0-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_simple_z">
					|-foreach from=$forms item=form -|
						|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsZ0-|
					|-/foreach-|
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_z"|-if ($action eq "edit" and $graph->getTypeZ() lt 4) or $action eq "new"-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_z[]">
				|-foreach from=$forms item=form -|
					|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsZ4-|
				|-/foreach-|
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_doble_z"|-if ($action eq "edit" and ($graph->getTypeZ() lt 1 or $graph->getTypeZ() gt 3) ) or $action eq "new"-| style="display:none"|-/if-|>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_doble_1_z[]">
				|-foreach from=$forms item=form -|
					|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsZ2-|
				|-/foreach-|
				</select>
				<select multiple="multiple" name="select_multiple_doble_2_z[]">
					|-foreach from=$forms item=form -|
						|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsZ3-|
					|-/foreach-|
				</select>
			</td>
		</tr>
		</tbody>
		<tbody id="div_select_questions"|-if $action eq "edit" and ( $graph->getType() eq "pie" or $graph->getType() eq "infography" )-| style="display:block;"|-else-| style="display:none;"|-/if-|>
		<tr>
			<td class='celltitulo1'>Preguntas</td>
			<td class='celldato'><select name="select_questions[]" size="12" multiple="multiple">
				|-foreach from=$forms item=form -|
					|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection() questions=$questionsX10-|
				|-/foreach-|
				</select>
			</td>
		</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan='2' class='cellboton'><input type='submit' name='guardar' value='Guardar'  class='boton' /></td>
			</tr>
		</tfoot>
	</table>
</form>
