<?php /* Smarty version 2.6.26, created on 2011-05-04 14:49:39
         compiled from profiles_select_form.tpl */ ?>
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
<form method="get" action="Main.php">
	<input type="hidden" name="do" value="<?php echo $this->_tpl_vars['do']; ?>
" />
	<?php if ($this->_tpl_vars['actor'] != ""): ?>
	<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor']->getId(); ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['actor1'] != ""): ?>
	<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor1']->getId(); ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['actor2'] != ""): ?>
	<input type="hidden" name="actor2" value="<?php echo $this->_tpl_vars['actor2']->getId(); ?>
" />
	<?php endif; ?>
	<table class="tablaborde" border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr>
			<td class="celltitulo2" nowrap="nowrap" width="35%">Seleccione un formulario</td>
			<td class="celldato">
				<select name="form" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" >
					<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
					<option value="<?php echo $this->_tpl_vars['form']->getId(); ?>
"><?php echo $this->_tpl_vars['form']->getName(); ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					<option value="" selected="selected">Seleccione un formulario</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="cellboton" colspan="2"><input value="##120,Continuar##" class="boton" type="submit">
				&nbsp;&nbsp;
				<input onclick="history.go(-1)" value="##104,Regresar##" class="boton" type="button"></td>
		</tr>
	</table>
</form>