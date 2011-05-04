<?php /* Smarty version 2.6.26, created on 2011-05-04 14:31:35
         compiled from actors_include_edit.tpl */ ?>
<form method='post' action='Main.php'>
	<input type='hidden' name='id' value='<?php echo $this->_tpl_vars['actor']->getId(); ?>
' />
	<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th class='celltitulo'><div class='titulo2'>##101,Nombre del Actor##</div></th>
			<th class='celltitulo'><div class='titulo2'>##102,Categoría##</div></th>
		</tr>
		<tr>
			<td width='70%' class='celldato'><input name='name' type='text' value='<?php echo $this->_tpl_vars['actor']->getName(); ?>
' size='75' class='textodato' /></td>
			<td width='30%' class='celldato'><select name="category">
					<option value="0">##103,Seleccione una categoría##</option>
									<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['for_categories']['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['category']->getId(); ?>
"<?php if ($this->_tpl_vars['category']->getId() == $this->_tpl_vars['actor']->getCategoryId()): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category']->getName(); ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='cellboton'><input type="hidden" name="do" value="actorsDoEditActorCategory" />
				<input type="hidden" name="action" value="<?php echo $this->_tpl_vars['include_action']; ?>
" />
				<input type='submit' value='##97,Guardar##' class='boton' />
				&nbsp;&nbsp;
				<input type='button' name='Button' value='##104,Regresar##' onClick='history.go(-1)' class='boton' />
			</td>
		</tr>
	</table>
</form>