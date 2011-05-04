<?php /* Smarty version 2.6.26, created on 2011-05-04 14:48:51
         compiled from users_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'users_list.tpl', 102, false),)), $this); ?>
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
		<td class='fondotitulo'>##151,Administración de Usuarios##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##152,A continuación podrá editar la lista de usuarios del sistema##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?php if ($this->_tpl_vars['message'] == 'deleted'): ?>
<div align='center' class='textoerror'>##153,Usuario eliminado##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'activated'): ?>
<div align='center' class='textoerror'>##154,Usuario reactivado##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'wrongPassword'): ?>
<div align='center' class='textoerror'>##155,Las contraseñas deben coincidir##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'errorUpdate'): ?>
<div align='center' class='textoerror'>##156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'saved'): ?>
<div align='center' class='textoerror'>##157,Usuario guardado##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'notAddedToGroup'): ?>
<div align='center' class='textoerror'>##158,Ha ocurrido un error al intentar agregar el usuario al grupo##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['message'] == 'notRemovedFromGroup'): ?>
<div align='center' class='textoerror'>##159,Ha ocurrido un error al intentar eliminar el usuario al grupo##</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['accion'] == 'creacion' || $this->_tpl_vars['accion'] == 'edicion'): ?>
	<?php if ($this->_tpl_vars['accion'] == 'creacion'): ?>
			##160,Ingrese  la Identificación del usuario y la contraseña para el nuevo usuario,  luego haga click en Guardar para generar el nuevo usuario.##
	<?php else: ?>
			##161,Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.##<?php endif; ?> <br />
	<br />
<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?><?php $this->assign('currentUserInfo', $this->_tpl_vars['currentUser']->getUserInfo()); ?><?php endif; ?>
<form method='post' action='Main.php?do=usersDoEdit'>
	<input type='hidden' name='id' value='<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?><?php echo $this->_tpl_vars['currentUser']->getId(); ?>
<?php endif; ?>' />
	<table class='tablaborde' cellpadding='5' cellspacing='1' width='60%'>
		<tr>
			<td nowrap="nowrap" class='titulodato1'>##162,Identificación de Usuario##</td>
			<td class='celldato'><input name='username' type='text'  class='textodato' value='<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?><?php echo $this->_tpl_vars['currentUser']->getUsername(); ?>
<?php endif; ?>' size="70" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##163,Nombre##</td>
			<td class='celldato'><input name='name' type='text'  class='textodato' value='<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?><?php echo $this->_tpl_vars['currentUserInfo']->getName(); ?>
<?php endif; ?>' size="70" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##164,Apellido##</td>
			<td class='celldato'><input name='surname' type='text'  class='textodato' value='<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?><?php echo $this->_tpl_vars['currentUserInfo']->getSurname(); ?>
<?php endif; ?>' size="70" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##165,Contraseña##</td>
			<td class='celldato'><input name='pass' type='password' class='textodato' value='' size="50" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##166,Repetir Contraseña##</td>
			<td class='celldato'><input name='pass2' type='password' class='textodato' value='' size="50" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>Nivel de Usuario</td>
			<td class='celldato'>
				<select name='levelId'>
					<option value="">Seleccionar nivel</option>
					<?php $_from = $this->_tpl_vars['levels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_levels'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_levels']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['level']):
        $this->_foreach['for_levels']['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['level']->getId(); ?>
"<?php if ($this->_tpl_vars['accion'] == 'edicion' && $this->_tpl_vars['level']->getId() == $this->_tpl_vars['currentUser']->getLevelId()): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['level']->getName(); ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'> <?php if ($this->_tpl_vars['accion'] == 'edicion'): ?>
				<input type="hidden" name="accion" value="edicion" />
				<?php endif; ?>
				<input type='submit' name='guardar' value='##97,Guardar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' class='boton'  />
			</td>
		</tr>
	</table>
</form>
<?php if ($this->_tpl_vars['accion'] == 'edicion'): ?>
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<caption>
	##167,El usuario ## <?php echo $this->_tpl_vars['currentUser']->getUsername(); ?>
 ##168,es miembro de los grupos:##
	</caption>
	<?php if (count($this->_tpl_vars['currentUserGroups']) == 0): ?>
	<tr>
		<th>##169,El usuario todavía no es miembro de ningún grupo##.</th>
	</tr>
	<?php else: ?>
	<tr>
		<th width="95%">##170,Grupo##</th>
		<th width="5%">&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['currentUserGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_user_group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_user_group']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['userGroup']):
        $this->_foreach['for_user_group']['iteration']++;
?>
	<?php $this->assign('group', $this->_tpl_vars['userGroup']->getGroup()); ?>
	<tr>
		<td class='celldato'><div class='titulo2'><?php echo $this->_tpl_vars['group']->getName(); ?>
</div></td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=usersDoRemoveFromGroup&user=<?php echo $this->_tpl_vars['currentUser']->getId(); ?>
&group=<?php echo $this->_tpl_vars['group']->getId(); ?>
' class='elim'>##115,Eliminar##</a> ] </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<tr>
		<td class='cellboton' colspan='4'>##171,Agregar al Usuario en el Grupo##:
			<form action='Main.php' method='post'>
				<input type="hidden" name="do" value="usersDoAddToGroup" />
				<select name="group">
					<option value="" selected="selected">##172,Seleccionar grupo##</option>
								<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_groups'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_groups']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group']):
        $this->_foreach['for_groups']['iteration']++;
?>
					<option value="<?php echo $this->_tpl_vars['group']->getId(); ?>
"><?php echo $this->_tpl_vars['group']->getName(); ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
				</select>
				<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['currentUser']->getId(); ?>
" />
				<input type='submit' value='##123,Agregar##' class='boton' />
			</form></td>
	</tr>
</table>
<?php endif; ?>
<?php endif; ?>
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<th>##162,Identificación de Usuario##</th>
		<th>##163,Nombre##</th>
		<th>##164,Apellido##</th>
		<th>&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_users'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_users']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['for_users']['iteration']++;
?>
	<?php $this->assign('userInfo', $this->_tpl_vars['user']->getUserInfo()); ?>
	<tr>
		<td class='celldato'><div class='titulo2'><?php echo $this->_tpl_vars['user']->getUsername(); ?>
</div></td>
		<td class='celldato'><?php echo $this->_tpl_vars['userInfo']->getName(); ?>
</td>
		<td class='celldato'><?php echo $this->_tpl_vars['userInfo']->getSurname(); ?>
</td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=usersList&user=<?php echo $this->_tpl_vars['user']->getId(); ?>
']' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=usersDoDelete&user=<?php echo $this->_tpl_vars['user']->getId(); ?>
']' class='elim'>##115,Eliminar##</a> ] </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['licensesLeft'] > 0): ?>
	<tr>
		<td class='cellboton' colspan='4'><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="usersList" />
				<input type="hidden" name="user" value="" />
				<input type='submit' value='##173,Nuevo Usuario##' class='boton' />
			</form></td>
	</tr>
	<?php else: ?>
	<tr>
		<td class='cellboton' colspan='4'><input type='submit' value='##173,Nuevo Usuario##' class='boton' onClick="return alert('Todas las licencias se encuentran en uso. Si desea dar de alta un nuevo usuario debe eliminar alguno de los existentes.');"/></td>
	</tr>
	<?php endif; ?>
</table>
<br />
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td colspan='4' class='celltitulo2'>##175,Usuarios Eliminados##&nbsp;<a href="javascript:void(null)" class='deta' onClick="alert('##174,Si quiere dar de alta a un usuario que estuvo registrado alguna vez, debe reactivarlo desde esta opción. Si lo intenta desde un usuario nuevo el sistema le informará que ese usuario ya está en uso.##')">##38,Ayuda##</a> </td>
	</tr>
	<tr>
		<th>##162,Identificación de Usuario##</th>
		<th>##163,Nombre##</th>
		<th>##164,Apellido##</th>
		<th>&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['deletedUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_deleted_users'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_deleted_users']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['for_deleted_users']['iteration']++;
?>
	<?php $this->assign('userInfo', $this->_tpl_vars['user']->getUserInfo()); ?>
	<tr>
		<td class='celldato'><div class='titulo2'> <?php echo $this->_tpl_vars['user']->getUsername(); ?>
 </div></td>
		<td class='celldato'> <?php echo $this->_tpl_vars['userInfo']->getName(); ?>
 </td>
		<td class='celldato'> <?php echo $this->_tpl_vars['userInfo']->getSurname(); ?>
 </td>
		<td class='cellopcionescen' nowrap> [ <a href='Main.php?do=usersDoActivate&user=<?php echo $this->_tpl_vars['user']->getId(); ?>
'
<?php if ($this->_tpl_vars['licensesLeft'] == 0): ?>
onClick="alert('##177,Todas las licencias se encuentran en uso. Si desea dar de alta un nuevo usuario debe eliminar alguno de los existentes.##');return false;"
<?php endif; ?>
class='edit'>##176,Reactivar##</a> ] </td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>