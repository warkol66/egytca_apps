<?php /* Smarty version 2.6.26, created on 2011-05-04 14:54:49
         compiled from config_view_include.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'config_view_include.tpl', 2, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element_name'] => $this->_tpl_vars['element']):
?>
<?php if (((is_array($_tmp=$this->_tpl_vars['element'])) ? $this->_run_mod_handler('is_array', true, $_tmp) : is_array($_tmp))): ?>
<li><?php echo $this->_tpl_vars['element_name']; ?>

	<ul><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "config_view_include.tpl", 'smarty_include_vars' => array('elements' => $this->_tpl_vars['element'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></ul>
</li>
<?php else: ?>
<li><?php echo $this->_tpl_vars['element_name']; ?>
: <?php echo $this->_tpl_vars['element']; ?>
</li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>