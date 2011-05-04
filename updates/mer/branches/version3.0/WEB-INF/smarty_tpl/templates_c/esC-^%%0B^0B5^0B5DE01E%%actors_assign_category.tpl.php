<?php /* Smarty version 2.6.26, created on 2011-05-04 14:31:42
         compiled from actors_assign_category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'actors_assign_category.tpl', 24, false),)), $this); ?>
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
	<tr>
		<td class='fondotitulo'>##110,Categorizar Actores##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##111,A continuación podrá asignar una categoría a cada uno de los Actores ingresado en el paso previo que no tengan una asignada##.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?php if (count($this->_tpl_vars['actors']) == 0): ?>
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
		<th>##112,Todos los Actores ingresados están categorizadas##.</th>
	</tr>
</table>
<?php else: ?>
<form name="form1" method="post" action="Main.php">
	<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
			<th>&nbsp;</th>
		</tr>
		<?php $_from = $this->_tpl_vars['actors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_actors']['iteration']++;
?>
		<tr valign="top">
			<td width='70%' class='celldato'><span class='titulo2'><?php echo $this->_tpl_vars['actor']->getName(); ?>
</span></td>
			<td width='20%' class='celldato'><select name="cat[<?php echo $this->_tpl_vars['actor']->getId(); ?>
]">
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
			</td>
			<td class='cellopciones' width='10%' nowrap>[ <a href='Main.php?do=actorsEditActorCategory&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='edit'>##114,Editar##</a> ]
				[ <a href='Main.php?do=actorsDoDeleteActor&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='elim' onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ]</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class='cellboton' colspan='3'><input type="hidden" name="do" value="actorsDoAssignCategoryToActors" />
				<input type='submit' name='guardar' value='##97,Guardar##' class='boton' />
				&nbsp;&nbsp;
				<input type='button' name='Button' value='##104,Regresar##' onClick='history.go(-1)' class='boton' />
			</td>
		</tr>
	</table>
</form>
<?php endif; ?> <br />
<p class='titulo'><a name='recategorizar'></a>##113,Cambiar Categorías Asignadas##</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CategoriesSelectInclude.tpl", 'smarty_include_vars' => array('do' => 'actorsAssignCategoryToActors')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['actorsCategory'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp)) > 0): ?>
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
		<th>&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['actorsCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actors_category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actors_category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_actors_category']['iteration']++;
?>
	<tr valign="top">
		<td width='70%' class='celldato'><span class='titulo2'><?php echo $this->_tpl_vars['actor']->getName(); ?>
</span></td>
		<td width='20%' class='celldato'> <?php echo $this->_tpl_vars['currentCategory']->getName(); ?>
 </td>
		<td class='cellopciones' width='10%' nowrap>[ <a href='Main.php?do=actorsEditActorCategory&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=actorsDoDeleteActor&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='elim' onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ]</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?> 