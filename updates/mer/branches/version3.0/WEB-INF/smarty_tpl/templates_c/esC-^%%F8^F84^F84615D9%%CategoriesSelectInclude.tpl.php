<?php /* Smarty version 2.6.26, created on 2011-05-04 14:31:43
         compiled from CategoriesSelectInclude.tpl */ ?>
<form action='Main.php' method='get'>
	<table class='tableTdBorders' cellspacing='0' cellpadding='0' border='0' width='100%'>
		<tr>
			<td nowrap="nowrap" width="35%" class="tdTitle2"><div class="textTitle2">##103,Seleccione una categoría##</div></td>
			<td width="65%"><select name="cat" onchange="if (this.options[this.selectedIndex].value) this.form.submit()">
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
			<td class='tdButton' colspan='2'><input type='submit' value='##150,Mostrar lista de Actores##' class='boton' />
			</td>
		</tr>
	</table>
</form>