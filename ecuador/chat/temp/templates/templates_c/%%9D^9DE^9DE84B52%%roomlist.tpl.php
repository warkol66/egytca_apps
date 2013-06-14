<?php /* Smarty version 2.6.10, created on 2013-06-15 00:20:34
         compiled from roomlist.tpl */ ?>
<?php $this->assign('title', 'Rooms'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!-- transfer vars from php to javascript -->
<script type="text/javascript">
var permanent = '<?php echo $this->_tpl_vars['room_permanent_post']; ?>
';
var ispublic = '<?php echo $this->_tpl_vars['room_public_post']; ?>
';
var name = '<?php echo $this->_tpl_vars['room_name_post']; ?>
';
var password = '<?php echo $this->_tpl_vars['room_password_post']; ?>
';
var selectstr = '<?php echo $this->_tpl_vars['room_order_post']; ?>
';
var optionstr = '<?php echo $this->_tpl_vars['room_option']; ?>
';
var hidden = '<?php echo $this->_tpl_vars['room_identification_post']; ?>
';
var option_count = <?php echo $this->_tpl_vars['rowcount']; ?>
;
var deleteroom = '<?php echo $this->_tpl_vars['room_delete_post']; ?>
';
var maxorder = '<?php echo $this->_tpl_vars['max_order_post']; ?>
';
</script>
<center>
	<h4><?php echo $this->_tpl_vars['langs']['t0']; ?>
</h4>
	<a href="room.php"><?php echo $this->_tpl_vars['langs']['t1']; ?>
</a><br>
	<br>
<?php if ($this->_tpl_vars['rooms']): ?>
	<form id="roomlist" action="" method="post" enctype="multipart/form-data">
		<table border="1">
			<tr>
				<th><a href="javascript:my_getbyid('sort').value = 'id'; my_getbyid('roomlist').submit()">id</a></th>
				<th><a href="javascript:my_getbyid('sort').value = 'name'; my_getbyid('roomlist').submit()"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</a></th>
				<th><a href="javascript:my_getbyid('sort').value = 'password'; my_getbyid('roomlist').submit()"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</a></th>
				<th><?php echo $this->_tpl_vars['langs']['t4']; ?>
</th>
				<th><?php echo $this->_tpl_vars['langs']['t5']; ?>
</th>
				<th><a href="javascript:my_getbyid('sort').value = 'row_nr'; my_getbyid('roomlist').submit()">#</a></th>
				<th><?php echo $this->_tpl_vars['langs']['t6']; ?>
</th>
				<th><?php echo $this->_tpl_vars['langs']['t7']; ?>
</th>
			</tr>
<?php $_from = $this->_tpl_vars['rooms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['room']):
?>
			
			<tr>
				<!-- Heater row -->
				<td align="center">
					<?php echo $this->_tpl_vars['room']['id']; ?>

				</td>

				<!-- Name row -->
				<td align="center">
					<input type="button" value="<?php echo $this->_tpl_vars['langs']['t11']; ?>
" id="bttn_<?php echo $this->_tpl_vars['room']['row_nr']; ?>
" onclick="javascript: onbttnclick('bttn_<?php echo $this->_tpl_vars['room']['row_nr']; ?>
','room_name[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]');">
					<input type="text" name="room_name[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]" value="<?php echo $this->_tpl_vars['room']['name']; ?>
" id="room_name[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]" onchange="javascript:row_change('<?php echo $this->_tpl_vars['room']['row_nr']; ?>
');" onfocus="javascript: onnamefocus('bttn_<?php echo $this->_tpl_vars['room']['row_nr']; ?>
','room_name[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]');" style="border: 0px;">
				</td>
				
				<!-- Password row -->
				<td align="center">
					<input type="button" value="<?php echo $this->_tpl_vars['langs']['t11']; ?>
" id="bttn_pass_<?php echo $this->_tpl_vars['room']['row_nr']; ?>
" onclick="javascript: onbttnclick('bttn_pass_<?php echo $this->_tpl_vars['room']['row_nr']; ?>
','room_password[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]');">
					<input type="text" name="room_password[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]" value="<?php echo $this->_tpl_vars['room']['password']; ?>
" id="room_password[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]" onchange="javascript:row_change('<?php echo $this->_tpl_vars['room']['row_nr']; ?>
');" onfocus="javascript: onnamefocus('bttn_pass_<?php echo $this->_tpl_vars['room']['row_nr']; ?>
','room_password[<?php echo $this->_tpl_vars['room']['row_nr']; ?>
]');" style="border: 0px;">
				</td>

				<!-- ispublic row -->
				<td align="center">
				<input type="checkbox" name="<?php echo $this->_tpl_vars['room']['public_id']; ?>
" id="<?php echo $this->_tpl_vars['room']['public_id']; ?>
" onchange="javascript:row_change('<?php echo $this->_tpl_vars['room']['row_nr']; ?>
');" <?php echo $this->_tpl_vars['room']['ispublic']; ?>
>
				</td>

				<!-- ispermanent row -->
				<td align="center">
				<input type="checkbox" name="<?php echo $this->_tpl_vars['room']['permanent_id']; ?>
" id="<?php echo $this->_tpl_vars['room']['permanent_id']; ?>
" onchange="javascript:perm_change('<?php echo $this->_tpl_vars['room']['row_nr']; ?>
');" <?php echo $this->_tpl_vars['room']['ispermanent']; ?>
>

				<!-- order row -->
				<td align="center">
				<?php if ($this->_tpl_vars['room']['ispermanent']): ?>
				<?php $this->assign('room_order_name', ($this->_tpl_vars['room_order_post'])."[".($this->_tpl_vars['room']['row_nr'])."]"); ?>
				<select id="<?php echo $this->_tpl_vars['room_order_name']; ?>
" name="<?php echo $this->_tpl_vars['room_order_name']; ?>
" onchange="javascript: change(<?php echo $this->_tpl_vars['room']['row_nr']; ?>
);" onfocus="javascript:focused('<?php echo $this->_tpl_vars['room']['row_nr']; ?>
');">
				
				<?php $this->assign('selected', ($this->_tpl_vars['room_option'])."[".($this->_tpl_vars['room']['row_nr'])."][".($this->_tpl_vars['room']['row_nr'])."]"); ?>
				
				<?php $_from = $this->_tpl_vars['room']['ordersel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['ordersel']):
?>
					<option id="<?php echo $this->_tpl_vars['key']; ?>
"
					<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['selected']): ?>selected<?php endif; ?>
					><?php echo $this->_tpl_vars['ordersel']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				
				</select>
				<?php else: ?>
				&nbsp;
				<?php endif; ?>
				</td>

				<!-- bumper row -->
				<td align="center">
					<a href="javascript: bump_up(<?php echo $this->_tpl_vars['room']['row_nr']; ?>
);">
						<img src="bumper.gif" border="0" alt="Bump up">
					</a>
				</td>

				<!-- delete row -->
				<td align="center">
					<input type="checkbox" name="<?php echo $this->_tpl_vars['room']['delete_id']; ?>
" id="<?php echo $this->_tpl_vars['room']['delete_id']; ?>
" onchange="javascript: row_change('<?php echo $this->_tpl_vars['room']['row_nr']; ?>
');">
				</td>

				<!-- this hidden input will show if user edited row -->
					<input type="hidden" name="<?php echo $this->_tpl_vars['room']['hidden_id']; ?>
" id="<?php echo $this->_tpl_vars['room']['hidden_id']; ?>
" value=<?php echo $this->_tpl_vars['room']['id']; ?>
 disabled >
			</tr>
<?php endforeach; endif; unset($_from); ?>
		</table>
		<br>
		<br>
		<input type="hidden" value="<?php echo $this->_tpl_vars['maxnumb']; ?>
" name="<?php echo $this->_tpl_vars['max_order_post']; ?>
">
		<input type="submit" value="<?php echo $this->_tpl_vars['langs']['t8']; ?>
" name="submited" onclick="javascript: submit_form();">
		<input type="hidden" id="sort" name="sort" value="none">
		
		<br>
		<br><?php echo $this->_tpl_vars['langs']['t9']; ?>

	</form>
<?php else: ?>
	<?php echo $this->_tpl_vars['langs']['t10']; ?>

<?php endif; ?>
</center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
