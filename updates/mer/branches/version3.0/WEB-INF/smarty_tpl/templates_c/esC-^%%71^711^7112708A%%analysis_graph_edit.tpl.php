<?php /* Smarty version 2.6.26, created on 2011-05-04 14:55:12
         compiled from analysis_graph_edit.tpl */ ?>
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
				<td width="80%" class='celldato'><input type='text' name='name' size='30' value='<?php if ($this->_tpl_vars['action'] == 'edit'): ?><?php echo $this->_tpl_vars['graph']->getName(); ?>
<?php endif; ?>' maxlength='255' />
					<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
					<input type='hidden' name='id' value='<?php echo $this->_tpl_vars['graph']->getId(); ?>
' />
					<?php endif; ?> </td>
			</tr>
			<tr>
				<td class='celltitulo1'>Tipo de Gráfico</td>
				<td class='celldato'><select name='type' onchange="javascript:showOptionsGraph(this)">
						<option value="plot_bubble"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getType() == 'plot_bubble'): ?> selected="selected"<?php endif; ?>>Plot Bubble</option>
						<option value="plot"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getType() == 'plot'): ?> selected="selected"<?php endif; ?>>Plot</option>
						<option value="pie"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getType() == 'pie'): ?> selected="selected"<?php endif; ?>>Pie</option>
						<option value="infography"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getType() == 'infography'): ?> selected="selected"<?php endif; ?>>Infography</option>
					</select>
				</td>
			</tr>
		</thead>
		<tbody id="div_plot"<?php if ($this->_tpl_vars['action'] == 'edit' && ( $this->_tpl_vars['graph']->getType() == 'pie' || $this->_tpl_vars['graph']->getType() == 'infography' )): ?> style="display:none;"<?php endif; ?>
		<tr>
			<td class='celltitulo1'>Actores</td>
			<td class='celldato'><input type='radio' name='actors' value='0' <?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getActors() == 0): ?>checked='checked' <?php endif; ?>/> Todos<br />
				<input type='radio' name='actors' value='1' <?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getActors() == 1): ?>checked='checked' <?php endif; ?>/> Uno </td>
		</tr>
		<tr>
			<th colspan='2'>Eje X</th>
		</tr>
		<tr>
			<td class='celltitulo1'> Etiqueta X </td>
			<td class='celldato'><input type='text' name='labelX' value='<?php if ($this->_tpl_vars['action'] == 'edit'): ?><?php echo $this->_tpl_vars['graph']->getLabelX(); ?>
<?php endif; ?>' />
			</td>
		</tr>
		<tr>
			<td class='celltitulo1'> Tipo Valor </td>
			<td class='celldato'><select name='typeX' onchange="javascript:enableSelect(this.value,'x')">
					<option value='0'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() == 0): ?> selected="selected"<?php endif; ?>>Valor unico</option>
					<option value='4'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() == 4): ?> selected="selected"<?php endif; ?>>Usar el mayor valor</option>
					<option value='5'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() == 5): ?> selected="selected"<?php endif; ?>>Usar el menor valor</option>
					<option value='6'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() == 6): ?> selected="selected"<?php endif; ?>>Promedio</option>
					<option value='7'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() == 7): ?> selected="selected"<?php endif; ?>>Sumatoria</option>
					<option value='1'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() == 1): ?> selected="selected"<?php endif; ?>>Cociente de valores</option>
				</select>
			</td>
		</tr>
		<tr id="tr_select_simple_x"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() != 0): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_simple_x">
				<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsX0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_x"<?php if (( $this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeX() < 4 ) || $this->_tpl_vars['action'] == 'new'): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_x[]">
				<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsX4'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_doble_x"<?php if (( $this->_tpl_vars['action'] == 'edit' && ( $this->_tpl_vars['graph']->getTypeX() < 1 || $this->_tpl_vars['graph']->getTypeX() > 3 ) ) || $this->_tpl_vars['action'] == 'new'): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_doble_1_x[]">
				<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsX2'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<select multiple="multiple" name="select_multiple_doble_2_x[]">
					<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsX3'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th colspan='2'>Eje Y</th>
		</tr>
		<tr>
			<td class='celltitulo1'> Etiqueta Y </td>
			<td class='celldato'><input type='text' name='labelY' value='<?php if ($this->_tpl_vars['action'] == 'edit'): ?><?php echo $this->_tpl_vars['graph']->getLabelY(); ?>
<?php endif; ?>' />
			</td>
		</tr>
		<tr>
			<td class='celltitulo1'> Tipo Valor </td>
			<td class='celldato'><select name='typeY' onchange="javascript:enableSelect(this.value,'y')">
					<option value='0'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() == 0): ?> selected="selected"<?php endif; ?>>Valor unico</option>
					<option value='4'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() == 4): ?> selected="selected"<?php endif; ?>>Usar el mayor valor</option>
					<option value='5'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() == 5): ?> selected="selected"<?php endif; ?>>Usar el menor valor</option>
					<option value='6'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() == 6): ?> selected="selected"<?php endif; ?>>Promedio</option>
					<option value='7'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() == 7): ?> selected="selected"<?php endif; ?>>Sumatoria</option>
					<option value='1'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() == 1): ?> selected="selected"<?php endif; ?>>Cociente de valores</option>
				</select>
			</td>
		</tr>
		<tr id="tr_select_simple_y"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() != 0): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_simple_y">
					
						<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsY0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endforeach; endif; unset($_from); ?>
					
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_y"<?php if (( $this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeY() < 4 ) || $this->_tpl_vars['action'] == 'new'): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_y[]">
					
						<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsY4'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endforeach; endif; unset($_from); ?>
						
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_doble_y"<?php if (( $this->_tpl_vars['action'] == 'edit' && ( $this->_tpl_vars['graph']->getTypeY() < 1 || $this->_tpl_vars['graph']->getTypeY() > 3 ) ) || $this->_tpl_vars['action'] == 'new'): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_multiple_doble_1_y[]" multiple="multiple">
					
						<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsY2'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endforeach; endif; unset($_from); ?>
						
				</select>
				<select name="select_multiple_doble_2_y[]" multiple="multiple">
					
						<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsY3'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endforeach; endif; unset($_from); ?>
						
				</select>
			</td>
		</tr>
		</tbody>
		<tbody id="div_plot_bubble"<?php if ($this->_tpl_vars['action'] == 'edit' && ( $this->_tpl_vars['graph']->getType() == 'pie' || $this->_tpl_vars['graph']->getType() == 'infography' || $this->_tpl_vars['graph']->getType() == 'plot' )): ?> style="display:none;"<?php endif; ?>
		<tr>
			<th colspan='2'>Eje Z</th>
		</tr>
		<tr>
			<td class='celltitulo1'> Etiqueta Z </td>
			<td class='celldato'><input type='text' name='labelZ' value='<?php if ($this->_tpl_vars['action'] == 'edit'): ?><?php echo $this->_tpl_vars['graph']->getLabelZ(); ?>
<?php endif; ?>' />
			</td>
		</tr>
		<tr>
			<td class='celltitulo1'> Tipo Valor </td>
			<td class='celldato'><select name='typeZ' onchange="javascript:enableSelect(this.value,'z')">
					<option value='0'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() == 0): ?> selected="selected"<?php endif; ?>>Valor unico</option>
					<option value='4'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() == 4): ?> selected="selected"<?php endif; ?>>Usar el mayor valor</option>
					<option value='5'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() == 5): ?> selected="selected"<?php endif; ?>>Usar el menor valor</option>
					<option value='6'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() == 6): ?> selected="selected"<?php endif; ?>>Promedio</option>
					<option value='7'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() == 7): ?> selected="selected"<?php endif; ?>>Sumatoria</option>
					<option value='1'<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() == 1): ?> selected="selected"<?php endif; ?>>Cociente de valores</option>
				</select>
			</td>
		</tr>
		<tr id="tr_select_simple_z"<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() != 0): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select name="select_simple_z">
					<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsZ0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_z"<?php if (( $this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['graph']->getTypeZ() < 4 ) || $this->_tpl_vars['action'] == 'new'): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_z[]">
				<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsZ4'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr id="tr_select_multiple_doble_z"<?php if (( $this->_tpl_vars['action'] == 'edit' && ( $this->_tpl_vars['graph']->getTypeZ() < 1 || $this->_tpl_vars['graph']->getTypeZ() > 3 ) ) || $this->_tpl_vars['action'] == 'new'): ?> style="display:none"<?php endif; ?>>
			<td class='celltitulo1'>Valores</td>
			<td class='celldato'><select multiple="multiple" name="select_multiple_doble_1_z[]">
				<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsZ2'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<select multiple="multiple" name="select_multiple_doble_2_z[]">
					<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsZ3'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		</tbody>
		<tbody id="div_select_questions"<?php if ($this->_tpl_vars['action'] == 'edit' && ( $this->_tpl_vars['graph']->getType() == 'pie' || $this->_tpl_vars['graph']->getType() == 'infography' )): ?> style="display:block;"<?php else: ?> style="display:none;"<?php endif; ?>>
		<tr>
			<td class='celltitulo1'>Preguntas</td>
			<td class='celldato'><select name="select_questions[]" size="12" multiple="multiple">
				<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection(),'questions' => $this->_tpl_vars['questionsX10'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
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