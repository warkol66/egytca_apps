<?php /* Smarty version 2.6.26, created on 2011-05-04 14:54:49
         compiled from config_view.tpl */ ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>Configuración del Sistema</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Variables de Configuración del Sistema</td>
	</tr>
<?php if ($this->_tpl_vars['message'] == 'ok'): ?>	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			Configuración Guardada!  </td>
	</tr><?php endif; ?>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>A continuación podrá ver las variables de configuración del sistema.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<ul>
	<?php $_from = $this->_tpl_vars['config']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_modules'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_modules']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['module']):
        $this->_foreach['for_modules']['iteration']++;
?>
	<li><span class='titulo2'><?php echo $this->_tpl_vars['name']; ?>
</span></li>
	<ul>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "config_view_include.tpl", 'smarty_include_vars' => array('elements' => $this->_tpl_vars['module'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</ul>
	</li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<br />
<a href="Main.php?do=configEdit">Editar Config</a>