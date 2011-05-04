<?php /* Smarty version 2.6.26, created on 2011-05-04 14:28:44
         compiled from analysis_include_select_category.tpl */ ?>
<form method='get' name='sel'>
	<table class='tablaborde' cellspacing='1' cellpadding='0' border='0' width='100%'>
		<tr>
			<td class='celltitulo' width='35%' nowrap><div class='titulo2'>##103,Seleccione una categoría##</div></td>
			<td class='celldato'><select name="category" onChange="document.sel.submit();">
					<option value="0">##103,Seleccione una categoría##</option>
								<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['for_categories']['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['category']->getId(); ?>
"><?php echo $this->_tpl_vars['category']->getName(); ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
				</select>
				<input type="hidden" name="do" value="<?php echo $this->_tpl_vars['do']; ?>
" />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##120,Continuar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='history.go(-1)' value='##104,Regresar##'  class='boton' />
			</td>
		</tr>
	</table>
</form>