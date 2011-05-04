<?php /* Smarty version 2.6.26, created on 2011-05-04 13:32:41
         compiled from profiles_include_select_form.tpl */ ?>
<form method="get" action="Main.php" style="display:inline;" >
	<input type="hidden" name="do" value="<?php echo $this->_tpl_vars['do']; ?>
" />
	<?php if ($this->_tpl_vars['relation'] == 1): ?>
	<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor1']->getId(); ?>
" />
	<input type="hidden" name="actor2" value="<?php echo $this->_tpl_vars['actor2']->getId(); ?>
" />
	<?php else: ?>
	<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor']->getId(); ?>
" />
	<?php endif; ?>
	<select name="form" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" >
		<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['formItem']):
?>
		<option value="<?php echo $this->_tpl_vars['formItem']->getId(); ?>
"><?php echo $this->_tpl_vars['formItem']->getName(); ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		<option value="" selected="selected">Seleccione otro formulario</option>
	</select>
</form>