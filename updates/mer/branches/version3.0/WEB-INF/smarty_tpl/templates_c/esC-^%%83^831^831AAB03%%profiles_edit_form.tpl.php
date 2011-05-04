<?php /* Smarty version 2.6.26, created on 2011-05-04 14:50:19
         compiled from profiles_edit_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'profiles_edit_form.tpl', 53, false),)), $this); ?>
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
<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_edit_form_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?> <br />
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
	<form onSubmit='checkCat(this)' action="Main.php?do=doProfilesFormEdit&questionId=<?php echo $this->_tpl_vars['question']->getId(); ?>
&edit=1" method="POST">
	<input type="hidden" name='newSection' value='' />
	<input type="hidden" name='newSectionParentId' value='' />
	<input type="hidden" name="form" value="<?php echo $this->_tpl_vars['form']->getId(); ?>
" />
	<table width='100%' border="0" cellpadding="3" cellspacing="1" class='tablaborde0'>
			<tr>
			<th colspan='4'><a name='edit'>##218,Agregar Pregunta##</a></th>
		</tr>
			<tr>
			<td class='celldato'>##219,Sección##</td>
			<td colspan='3' class="celldato"><select name='sectionId' onChange="checkCat(this)">
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sections'],'selected' => $this->_tpl_vars['question']->getSectionId()), $this);?>

				</select>
				</td>
		</tr>
			<tr>
			<td width='20%' valign='top' class="celldato">##221,Pregunta##</td>
			<td width='70%' class="celldato"><input name='question' type='text' value='<?php echo $this->_tpl_vars['question']->getQuestion(); ?>
' size='50' class='textodato'/></td>
			<td width='5%' class="celldato">##226,Orden##</td>
			<td width='5%' class="celldato"><select name='position' >
					<?php echo smarty_function_html_options(array('output' => $this->_tpl_vars['positions'],'values' => $this->_tpl_vars['positions'],'selected' => $this->_tpl_vars['question']->getPosition()), $this);?>

				</select></td>
		</tr>
			<tr>
			<td valign='top' class="celldato">##220,Etiqueta en gráficos##</td>
			<td class="celldato"><input name='label' type='text'  class='textodato' value='' size="30"/></td>
			<td class="celldato">##227,Unidad##</td>
			<td class="celldato"><input type="text" maxlength="20" size="8" name="unit" value="<?php echo $this->_tpl_vars['question']->getUnit(); ?>
" /></td>
		</tr>
			<tr>
			<td valign='top' class="celldato">##222,Tipo de Pregunta##</td>
			<td colspan='3' class="celldato"><table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablaborde0">
					<?php $_from = $this->_tpl_vars['question']->getTypes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['typeId'] => $this->_tpl_vars['typeName']):
?>
					<?php if ($this->_tpl_vars['typeId'] != @QUESTION_TYPE_OPTIONS): ?>
					<tr>
						<td colspan="2" class="celldato"><input id='type_<?php echo $this->_tpl_vars['typeId']; ?>
' type='radio' name='questionType' value='<?php echo $this->_tpl_vars['typeId']; ?>
' <?php if ($this->_tpl_vars['question']->getType() == $this->_tpl_vars['typeId']): ?>checked='checked'<?php endif; ?> onClick='switch_vis("optionsTable","none");' />
							<label for="type_<?php echo $this->_tpl_vars['typeId']; ?>
"><?php if ($this->_tpl_vars['typeName'] == 'String'): ?>##300,Texto##<?php elseif ($this->_tpl_vars['typeName'] == 'Text'): ?>##300,Texto largo##<?php elseif ($this->_tpl_vars['typeName'] == 'Money'): ?>##300,Moneda##<?php elseif ($this->_tpl_vars['typeName'] == 'Date'): ?>##300,Fecha##<?php elseif ($this->_tpl_vars['typeName'] == 'Number'): ?>##300,Número##<?php elseif ($this->_tpl_vars['typeName'] == 'Boolean'): ?>##300,Cierto o falso##<?php endif; ?></label>
						</td>
					</tr>
					<?php else: ?> 
					<tr>
						<td width="20%" valign='top' class="celldato"><input type='radio' name='questionType' value='3' <?php if ($this->_tpl_vars['question']->getType() == $this->_tpl_vars['typeId']): ?>checked='checked'<?php endif; ?> OnClick='switch_vis("optionsTable","block");' />##229,Opciones##</td>
						<td width="80%" class="celldato"><div id="optionsTable" style='display:<?php if ($this->_tpl_vars['question']->getType() == $this->_tpl_vars['typeId']): ?>block<?php else: ?>none<?php endif; ?>;'>
							<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablaborde0">
								<tr>
									<th>##223,Selec. Inicial##</th>
									<th align='left'>##224,Valor##</th>
									<th align='left'>##225,Descripción##</th>
								</tr>
								<?php $_from = $this->_tpl_vars['question']->getOptions(10); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tempId'] => $this->_tpl_vars['option']):
?>
								<tr>
									<td class="celldato"><input type="radio" name="default" value="<?php echo $this->_tpl_vars['tempId']; ?>
" <?php if ($this->_tpl_vars['option']->getDefaultOpc() == 1): ?>checked='checked'<?php endif; ?> /> </td>
									<td width='0%' class="celldato"><input type='text' name='opc[<?php echo $this->_tpl_vars['tempId']; ?>
]' size='3' value='<?php echo $this->_tpl_vars['option']->getValue(); ?>
'/></td>
									<td class="celldato"><input name='rta[<?php echo $this->_tpl_vars['tempId']; ?>
]' type='text'  class='textodato' value='<?php echo $this->_tpl_vars['option']->getText(); ?>
' size="30" />
									</td>
								</tr>
								<?php endforeach; endif; unset($_from); ?>
						</table></div></td>
					</tr>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</table></td>
		</tr>
			<tr>
			<td colspan='4' class='cellboton'><input type='submit' name='n_preg' value='##228,Guardar pregunta##'  class='boton' /></td>
		</tr>
		</table>
</form>