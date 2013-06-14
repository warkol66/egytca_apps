<?php /* Smarty version 2.6.10, created on 2013-06-15 00:21:03
         compiled from connlist.tpl */ ?>
<?php $this->assign('title', 'Connections');  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<center>
<h4><?php echo $this->_tpl_vars['langs']['t0']; ?>
</h4>

<form name="connlist" id="connlist" action="connlist.php" method="post">
	<input type="hidden" id="sort" name="sort" value="none">
</form>	

<?php if ($this->_tpl_vars['connections']): ?>

<table border="1">
<tr>
	
	<th><a href="javascript:my_getbyid('sort').value = 'id'; my_getbyid('connlist').submit()">id</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'updated'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t1']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'created'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'login'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'roomid'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t4']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'state'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t5']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'color'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t6']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'start'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t7']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'lang'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t8']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'ip'; my_getbyid('connlist').submit()">ip</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'tzoffset'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t9']; ?>
</a></th>
	<th><a href="javascript:my_getbyid('sort').value = 'host'; my_getbyid('connlist').submit()"><?php echo $this->_tpl_vars['langs']['t10']; ?>
</a></th>
</tr>
<?php $_from = $this->_tpl_vars['connections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['connection']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['connection']['id']; ?>
</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['updated']; ?>
</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['created']; ?>
</td>
	<td align=center>
	<?php if ($this->_tpl_vars['connection']['userid']): ?>
		<a href=user.php?id=<?php echo $this->_tpl_vars['connection']['userid']; ?>
><?php echo $this->_tpl_vars['connection']['login']; ?>
</a>
	<?php else: ?>
		-
	<?php endif; ?>
	</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['roomid']; ?>
</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['state']; ?>
</td>
	<td><?php echo $this->_tpl_vars['connection']['color']; ?>
</td>
	<td><?php echo $this->_tpl_vars['connection']['start']; ?>
</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['lang']; ?>
</td>
	<td><?php echo $this->_tpl_vars['connection']['ip']; ?>
</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['tzoffset']; ?>
</td>
	<td align=center><?php echo $this->_tpl_vars['connection']['host']; ?>
</td>
</tr>

<?php endforeach; endif; unset($_from);  else: ?>
	<?php echo $this->_tpl_vars['langs']['t11']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>