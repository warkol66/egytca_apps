<?php /* Smarty version 2.6.26, created on 2011-05-04 14:49:31
         compiled from groups_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'groups_list.tpl', 74, false),)), $this); ?>
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
		<td class='fondotitulo'>##178,Administración de Grupos de Usuarios##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##179,A continuación podrá editar la lista de grupos de usuarios, permitiendo, al editar el grupo, modificar las categorías que pueden acceder los usuarios miembros del grupo.##</td>
	</tr>
	<tr>
		<td class='texto'>&nbsp;</td>
	</tr>
	<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?>
	<tr>
		<td class='texto'>##180,Realice los cambios en el grupo de usuarios y haga click en "Aceptar" para guardar las modificaciones. ##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<?php endif; ?>
</table>
<?php if ($this->_tpl_vars['message'] == 'deleted'): ?>
<div align='center' class='textoerror'>##181,Grupo de Usuarios eliminado##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'errorUpdate'): ?>
<div align='center' class='textoerror'>##182,Ha ocurrido un error al intentar guardar la información del grupo de usuarios##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'saved'): ?>
<div align='center' class='textoerror'>##183,Grupo de Usuarios guardado##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'blankName'): ?>
<div align='center' class='textoerror'>##184,El Grupo de Usuarios debe tener un Nombre##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'notAddedToGroup'): ?>
<div align='center' class='textoerror'>##185,Ha ocurrido un error al intentar agregar la categoría al grupo##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'notRemovedFromGroup'): ?>
<div align='center' class='textoerror'>##186,Ha ocurrido un error al intentar eliminar la categoría del grupo##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?>
<form method='post' action='Main.php?do=groupsDoEdit'>
	<input type='hidden' name='id' value='<?php echo $this->_tpl_vars['currentGroup']->getId(); ?>
' />
	<table class='tablaborde' cellpadding='5' cellspacing='1'>
		<tr>
			<th colspan="2">##187,Editar nombre del Grupo ##</th>
		</tr>
		<tr>
			<td nowrap="nowrap" class='titulodato1'>##196,Nombre del Grupo##</td>
			<td class='celldato'><input name='name' type='text'  class='textodato' value='<?php echo $this->_tpl_vars['currentGroup']->getName(); ?>
' size="70" /></td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type="hidden" name="accion" value="edicion" />
				<input type='submit' name='guardar' value='##97,Guardar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' class='boton'  />
			</td>
		</tr>
	</table>
</form>
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<th colspan="2" class='titulodato1'>##188,El grupo## <?php echo $this->_tpl_vars['currentGroup']->getName(); ?>
 ##189,tiene acceso a las siguientes categorías:##</th>
	</tr>
	<?php if (count($this->_tpl_vars['currentGroupCategories']) == 0): ?>
	<tr>
		<td class='celldato'colspan="2"><div class='titulo2'>##190,El grupo todavía no posee acceso a ninguna categoría.##</div></th>
	</tr>
	<?php else: ?>
	<tr>
		<th width="90%">##191,Categorías##</th>
		<th width="10%" nowrap="nowrap">&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['currentGroupCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_group_category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_group_category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['groupCategory']):
        $this->_foreach['for_group_category']['iteration']++;
?>
	<?php $this->assign('category', $this->_tpl_vars['groupCategory']->getCategory()); ?>
	<tr>
		<td class='celldato'><div class='titulo2'><?php echo $this->_tpl_vars['category']->getName(); ?>
</div></td>
		<td class='cellopciones' nowrap> [ <a href="Main.php?do=groupsDoRemoveCategoryFromGroup&category=<?php echo $this->_tpl_vars['category']->getId(); ?>
&group=<?php echo $this->_tpl_vars['currentGroup']->getId(); ?>
" class='elim' onclick="return confirm('##257,Esta opción remueve el acceso del grupo a la categoría. ¿Está seguro que desea eliminarlo?##');">##192,Eliminar acceso##</a> ] </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<tr>
		<td class='celldato' colspan='2'><form action='Main.php' method='post'>
				##193,Agregar categoría##&nbsp;&nbsp;
				<input type="hidden" name="do" value="groupsDoAddCategoryToGroup" />
				<select name="category">
					<option value="" selected="selected">##103,Seleccione una categoría##</option>
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
				<input type="hidden" name="group" value="<?php echo $this->_tpl_vars['currentGroup']->getId(); ?>
" />
				<input type='submit' value='##123,Agregar##' class='boton' />
			</form></td>
	</tr>
</table>
<?php endif; ?> <br />
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<th width="90%" nowrap="nowrap">##194,Grupo de Usuarios del Sistema ##</th>
		<th width="10%" nowrap="nowrap">&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_groups'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_groups']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group']):
        $this->_foreach['for_groups']['iteration']++;
?>
	<tr>
		<td class='celldato'><div class='titulo2'><?php echo $this->_tpl_vars['group']->getName(); ?>
</div></td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=groupsList&group=<?php echo $this->_tpl_vars['group']->getId(); ?>
' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=groupsDoDelete&group=<?php echo $this->_tpl_vars['group']->getId(); ?>
' class='elim' onclick="return confirm('##256,Esta opción eliminar permanentemente a este Grupo. ¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ] </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td class='celldato' colspan='2'><form action='Main.php' method='post'>
				##195,Agregar Grupo de Usuarios##&nbsp;&nbsp;
				<input type="hidden" name="do" value="groupsDoEdit" />
				<input type="text" name="name" value="" />
				<input type='submit' value='##123,Agregar##' class='boton' />
			</form></td>
	</tr>
</table>