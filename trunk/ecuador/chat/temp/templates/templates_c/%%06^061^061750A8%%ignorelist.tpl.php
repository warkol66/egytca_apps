<?php /* Smarty version 2.6.10, created on 2013-06-15 00:21:27
         compiled from ignorelist.tpl */ ?>
<?php $this->assign('title', 'Ignores'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<center>
<h4><?php echo $this->_tpl_vars['langs']['t0']; ?>
</h4>

<form name="ignorelist" id="ignorelist" action="ignorelist.php" method="post">
	<input type="hidden" id="sort" name="sort" value="none">
</form>

<?php if ($this->_tpl_vars['error']): ?>
<font color="red"><?php echo $this->_tpl_vars['error']; ?>
</font><br><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['notice']): ?>
<font color="green"><?php echo $this->_tpl_vars['notice']; ?>
</font><br><br>
<?php endif; ?>

<?php if ($this->_tpl_vars['ignores']): ?>
<table border="1">
<tr>
	<th><a href="javascript:my_getbyid('sort').value = 'created'; my_getbyid('ignorelist').submit()"><?php echo $this->_tpl_vars['langs']['t1']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'user'; my_getbyid('ignorelist').submit()"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'iuser'; my_getbyid('ignorelist').submit()"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'iuserid'; my_getbyid('ignorelist').submit()"><?php echo $this->_tpl_vars['langs']['t4']; ?>
</a></th>
</tr>

<?php $_from = $this->_tpl_vars['ignores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ignore']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['ignore']['created']; ?>
</td>
	<td align=center><a href="user.php?id=<?php echo $this->_tpl_vars['ignore']['userid']; ?>
"><?php echo $this->_tpl_vars['ignore']['user']; ?>
</a></td>
	<td align=center><a href="user.php?id=<?php echo $this->_tpl_vars['ignore']['iuserid']; ?>
"><?php echo $this->_tpl_vars['ignore']['iuser']; ?>
</a></td>
	<td align=center><a href="ignorelist.php?unignoreid=<?php echo $this->_tpl_vars['ignore']['iuserid']; ?>
"><?php echo $this->_tpl_vars['ignore']['iuserid']; ?>
</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
	<?php echo $this->_tpl_vars['langs']['t5']; ?>

<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>