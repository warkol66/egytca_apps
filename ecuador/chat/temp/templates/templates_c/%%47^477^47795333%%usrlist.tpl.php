<?php /* Smarty version 2.6.10, created on 2013-06-15 00:21:06
         compiled from usrlist.tpl */ ?>
<?php $this->assign('title', 'Users'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['manageUsers']): ?>
	<div align="center"><br><?php echo $this->_tpl_vars['langs']['t9']; ?>
</div>
<?php elseif ($this->_tpl_vars['intCms']): ?>
	<div align="center"><br><?php echo $this->_tpl_vars['langs']['t10']; ?>
</div>
<?php else: ?>
<center>
	<form name="usrlist" id="usrlist" action="usrlist.php" method="post">
		<input type="hidden" id="sort" name="sort" value="none">
	</form>
	<h4><?php echo $this->_tpl_vars['langs']['t1']; ?>
</h4>
	<a href="user.php"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</a><br>
	<br>
<?php if ($this->_tpl_vars['users']): ?>
	<table border="1">
		<tr>
			<th><a href="javascript:my_getbyid('sort').value = 'id'; my_getbyid('usrlist').submit()"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</a></th>
			<th><a href="javascript:my_getbyid('sort').value = 'login'; my_getbyid('usrlist').submit()"><?php echo $this->_tpl_vars['langs']['t4']; ?>
</a></th>
			<th><a href="javascript:my_getbyid('sort').value = 'password'; my_getbyid('usrlist').submit()"><?php echo $this->_tpl_vars['langs']['t5']; ?>
</a></th>
			<th><a href="javascript:my_getbyid('sort').value = 'roles'; my_getbyid('usrlist').submit()"><?php echo $this->_tpl_vars['langs']['t6']; ?>
</a></th>
		</tr>
	<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
		<tr>
			<td><?php echo $this->_tpl_vars['user']['id']; ?>
</td>
			<td><a href="user.php?id=<?php echo $this->_tpl_vars['user']['id']; ?>
"><?php echo $this->_tpl_vars['user']['login']; ?>
</a></td>
			<td><?php echo $this->_tpl_vars['user']['password']; ?>
&nbsp;</td>
			<td><?php echo $this->_tpl_vars['user']['roles']; ?>
</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
	<?php echo $this->_tpl_vars['langs']['t7']; ?>

<?php endif; ?>
</center>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>