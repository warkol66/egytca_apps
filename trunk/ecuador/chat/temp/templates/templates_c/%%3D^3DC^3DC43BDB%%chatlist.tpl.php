<?php /* Smarty version 2.6.10, created on 2013-06-15 00:25:04
         compiled from chatlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'chatlist.tpl', 15, false),)), $this); ?>
<?php $this->assign('title', 'Chats');  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['manageUsers']): ?>
<div align="center"><br><?php echo $this->_tpl_vars['langs']['t0']; ?>
<br><?php echo $this->_tpl_vars['langs']['t19']; ?>
</div>
<?php else: ?>
<center>
	<h4><?php echo $this->_tpl_vars['langs']['t1']; ?>
</h4>
	<form name="chatlist" id="chatlist" action="chatlist.php" method="post">
	<table border="0">
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</td>
			<td>
				<select name="roomid">
				<option value="0">[ <?php echo $this->_tpl_vars['langs']['t3']; ?>
 ]
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['rooms'],'selected' => $_REQUEST['roomid']), $this);?>

				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t4']; ?>
</td>
			<td><input type="text" name="from" value="<?php echo $_REQUEST['from']; ?>
" size="19">  <?php echo $this->_tpl_vars['langs']['t5']; ?>
 <input type="text" name="to" value="<?php echo $_REQUEST['to']; ?>
" size="19">(YYYY-MM-DD hh:mm:ss)</td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t6']; ?>
</td>
			<td><input type="text" name="days" value="<?php echo $_REQUEST['days']; ?>
" size="8"></td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t7']; ?>
</td>
			<td>
				<select name="initiatorid">
				<option value="0">[ <?php echo $this->_tpl_vars['langs']['t8']; ?>
 ]
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['initiators'],'selected' => $_REQUEST['initiatorid']), $this);?>

				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t9']; ?>
</td>
			<td>
				<select name="moderatorid">
				<option value="0">[ <?php echo $this->_tpl_vars['langs']['t8']; ?>
 ]
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['moderators'],'selected' => $_REQUEST['moderatorid']), $this);?>

				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['langs']['t26']; ?>
</td>
			<td><input type="text" name="msg2show" value="<?php echo $_REQUEST['msg2show']; ?>
" size="8"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="apply" value="<?php echo $this->_tpl_vars['langs']['t19']; ?>
">
				<input type="submit" name="clear" value="<?php echo $this->_tpl_vars['langs']['t20']; ?>
">
				<input type="hidden" id="sort" name="sort" value="none">
				<!--<input type="submit" name="remove" value="<?php echo $this->_tpl_vars['langs']['t21']; ?>
">-->
			</td>
		</tr>
	</table>
</form>

<?php if ($this->_tpl_vars['chats']): ?>
<table border="1">
	<tr>
		<th><a href="javascript:my_getbyid('sort').value = 'roomname'; my_getbyid('chatlist').submit()"> <?php echo $this->_tpl_vars['langs']['t10']; ?>
 </a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'initiatorlogin'; my_getbyid('chatlist').submit()"><?php echo $this->_tpl_vars['langs']['t11']; ?>
</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'moderatorlogin'; my_getbyid('chatlist').submit()"><?php echo $this->_tpl_vars['langs']['t12']; ?>
</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'start'; my_getbyid('chatlist').submit()"><?php echo $this->_tpl_vars['langs']['t13']; ?>
</a></th>
		<th><a href="javascript:my_getbyid('sort').value = 'end'; my_getbyid('chatlist').submit()"><?php echo $this->_tpl_vars['langs']['t14']; ?>
</a></th>
		<th><?php echo $this->_tpl_vars['langs']['t15']; ?>
</th>
	</tr>
<?php $_from = $this->_tpl_vars['chats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['chat']):
?>
	<tr>
		<td valign="top"><a href="roomlist.php?id=<?php echo $this->_tpl_vars['chat']['roomid']; ?>
"><?php echo $this->_tpl_vars['chat']['roomname']; ?>
</a></td>
		<td valign="top"><a href="usrlist.php?id=<?php echo $this->_tpl_vars['chat']['initiatorid']; ?>
"><?php echo $this->_tpl_vars['chat']['initiatorlogin']; ?>
</a></td>
		<td valign="top">
	<?php if ($this->_tpl_vars['chat']['moderatorid']): ?>
		<a href="usrlist.php?id=<?php echo $this->_tpl_vars['chat']['moderatorid']; ?>
"><?php echo $this->_tpl_vars['chat']['moderatorlogin']; ?>
</a>
	<?php else: ?>
		[<?php echo $this->_tpl_vars['langs']['t16']; ?>
]
	<?php endif; ?>
		</td>
		<td valign="top">
			<a href="msglist.php?roomid=<?php echo $this->_tpl_vars['chat']['roomid']; ?>
&from=<?php echo $this->_tpl_vars['chat']['start']; ?>
&to=<?php echo $this->_tpl_vars['chat']['end']; ?>
">
			<?php echo $this->_tpl_vars['chat']['start']; ?>

			</a>
		</td>
		<td valign="top">
			<?php echo $this->_tpl_vars['chat']['end']; ?>

		</td>
		<td valign="top">
			<table border="0" CELLSPACING="0" CELLPADDING="0">
<?php $_from = $this->_tpl_vars['chat']['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
			<tr>
				<td><b><?php echo $this->_tpl_vars['message']['name']; ?>
: </b><?php echo $this->_tpl_vars['message']['txt']; ?>
</td>
			</tr>
	<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
	</table>
<?php else: ?>
	<?php echo $this->_tpl_vars['langs']['t17']; ?>

<?php endif;  if ($this->_tpl_vars['private']): ?>
<h4>Private Messages:</h4>
<table border="1">
	<tr>
		<th><?php echo $this->_tpl_vars['langs']['t22']; ?>
</th>
		<th><?php echo $this->_tpl_vars['langs']['t23']; ?>
</th>
		<th><?php echo $this->_tpl_vars['langs']['t24']; ?>
</th>
		<th><?php echo $this->_tpl_vars['langs']['t25']; ?>
</th>
	</tr>
<?php $_from = $this->_tpl_vars['private']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
	<tr>
		<td valign="top"><?php echo $this->_tpl_vars['message']['created']; ?>
</td>
		<td valign="top"><a href="usrlist.php?id=<?php echo $this->_tpl_vars['message']['login']; ?>
"><?php echo $this->_tpl_vars['message']['login']; ?>
</a></td>
		<td valign="top"><a href="usrlist.php?id=<?php echo $this->_tpl_vars['message']['touserid']; ?>
"><?php echo $this->_tpl_vars['message']['touserid']; ?>
</a></td>
		<td valign="top"><?php echo $this->_tpl_vars['message']['txt']; ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
	</table>
<?php endif; ?>

</center>

<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>