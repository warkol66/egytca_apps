<?php /* Smarty version 2.6.26, created on 2011-05-04 14:41:46
         compiled from categories_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'categories_list.tpl', 32, false),)), $this); ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<?php if ($this->_tpl_vars['message'] == 'notdeleted'): ?>
	<tr>
		<td><div align='center' class='textoerror'>##140,No se pudo eliminar la categoría porque posee datos asociados##.</div></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class='fondotitulo'>##139,Editar categorías##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##141,A  continuación podrá editar la lista de categorías disponibles. Podrá  Agregar, Modificar o Eliminar categorías de la lista de categorías  disponibles. Sólo podrá eliminar las categorías que no tengan ningún  dato asignado o ningún gráfico asociado.##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?php if (count($this->_tpl_vars['categories']) > 0): ?>
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='0'>
	<tr>
		<th>##142,Categorías Disponibles##</th>
	</tr>
	<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['for_categories']['iteration']++;
?>
	<tr>
		<td class='celldato'><span class='titulo2'><?php echo $this->_tpl_vars['category']->getName(); ?>
</span></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>
<br />
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='0'>
	<tr>
		<th>##143,Agregar Nueva Categoría##</th>
	</tr>
	<tr>
		<td class='cellboton'><form method='post' action="Main.php">
				<input type="text" name="name" value='' size="50" class='textodato' />
				<input type="hidden" name="do" value="categoriesDoEdit" />
				<input type="hidden" name="catid" value='<?php echo '<?='; ?>
$catid<?php echo '?>'; ?>
' />
				<input type='submit' name="ncat" value="##143,Agregar Nueva Categoría##" class='boton' />
			</form></td>
	</tr>
</table>
<br />
<?php if (count($this->_tpl_vars['categories']) > 0): ?>
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='0'>
	<tr>
		<th>##144,Modificar o Eliminar Categoría##</th>
	</tr>
	<tr>
		<td class='cellboton'><form method='get' action="Main.php" style="display:inline;">
				<select name='id' onchange="javascript:document.getElementById('select_modificar_categoria').value=this.value">
          <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['for_categories']['iteration']++;
?>
					<option value='<?php echo $this->_tpl_vars['category']->getId(); ?>
'><?php echo $this->_tpl_vars['category']->getName(); ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
				</select>
				&nbsp;&nbsp;
				<input type='submit' name="mcat" value="##145,Modificar##" class='boton' />
				<input type="hidden" name="do" value="categoriesEdit" />
			</form>
			<form method='post' action="Main.php" style="display:inline;">
				&nbsp;&nbsp;
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['categories'][0]->getId(); ?>
" id="select_modificar_categoria" />
				<input type='submit' name="dcat" value="##115,Eliminar##" class='boton' onclick="return confirm('##255,Esta opción elimina permanentemente esta Categoría. ¿Está seguro que desea eliminarla?##');" />
				<input type="hidden" name="do" value="categoriesDoDelete" />
			</form></td>
	</tr>
</table>
<?php endif; ?>