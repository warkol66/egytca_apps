<?php /* Smarty version 2.6.10, created on 2013-06-15 00:21:13
         compiled from msglist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'msglist.tpl', 12, false),)), $this); ?>
<?php $this->assign('title', 'Messages');  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<center>
	<h4><?php echo $this->_tpl_vars['langs']['t0']; ?>
</h4>
	<form name="msglist" id="msglist" action="msglist.php" method="post">
	<table border="0">
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t1']; ?>
</td>
			<td>
				<select name="roomid">
				<option value="0">[ <?php echo $this->_tpl_vars['langs']['t2']; ?>
 ]
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['rooms'],'selected' => $_REQUEST['roomid']), $this);?>

				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</td>
			<td><input type="text" name="from" value="<?php echo $_REQUEST['from']; ?>
" size="19">  <?php echo $this->_tpl_vars['langs']['t4']; ?>
 <input type="text" name="to" value="<?php echo $_REQUEST['to']; ?>
" size="19">(YYYY-MM-DD hh:mm:ss)</td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t5']; ?>
</td>
			<td><input type="text" name="days" value="<?php echo $_REQUEST['days']; ?>
" size="8"></td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t6']; ?>
</td>
			<td>
				<select name="userid">
				<option value="0">[ <?php echo $this->_tpl_vars['langs']['t7']; ?>
 ]
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['users'],'selected' => $_REQUEST['userid']), $this);?>

					</select>
				</td>
			</tr>
			<tr>
				<td align="right" width="200"><?php echo $this->_tpl_vars['langs']['t8']; ?>
</td>
				<td><input type="text" name="keyword" value="<?php echo $_REQUEST['keyword']; ?>
" size="32"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="apply" value="<?php echo $this->_tpl_vars['langs']['t14']; ?>
">
					<input type="submit" name="clear" value="<?php echo $this->_tpl_vars['langs']['t15']; ?>
">
					<input type="hidden" id="sort" name="sort" value="none">
					<!--<input type="submit" name="remove" value="<?php echo $this->_tpl_vars['langs']['t16']; ?>
">-->
				</td>
			</tr>
		</table>
	</form>

<?php if ($this->_tpl_vars['messages']): ?>

<table border="1">
	<tr>
		<th><a href="javascript:my_getbyid('sort').value = 'id'; my_getbyid('msglist').submit()">id</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'sent'; my_getbyid('msglist').submit()"><?php echo $this->_tpl_vars['langs']['t9']; ?>
</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'user'; my_getbyid('msglist').submit()"><?php echo $this->_tpl_vars['langs']['t10']; ?>
</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'toroom'; my_getbyid('msglist').submit()"><?php echo $this->_tpl_vars['langs']['t11']; ?>
</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'touser'; my_getbyid('msglist').submit()"><?php echo $this->_tpl_vars['langs']['t12']; ?>
</a></th>
		<th>txt</th>
	</tr>

<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
	<tr>
		<td><?php echo $this->_tpl_vars['message']['id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['message']['sent']; ?>
</td>
		<td>
		<a href="user.php?id=<?php echo $this->_tpl_vars['message']['user_id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['message']['user']; ?>
</a>
		</td>
		<td><a href="room.php?id=<?php echo $this->_tpl_vars['message']['toroomid']; ?>
"><?php echo $this->_tpl_vars['message']['toroom']; ?>
</a></td>
		<td>
		<a href="user.php?id=<?php echo $this->_tpl_vars['message']['touser_id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['message']['touser']; ?>
</a>
		</td>
		<td><?php echo $this->_tpl_vars['message']['txt']; ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from);  else: ?>
	<?php echo $this->_tpl_vars['langs']['t13']; ?>

<?php endif; ?>

</center>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>