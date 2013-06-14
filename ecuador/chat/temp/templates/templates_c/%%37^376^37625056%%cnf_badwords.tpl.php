<?php /* Smarty version 2.6.10, created on 2013-06-15 00:15:20
         compiled from cnf_badwords.tpl */ ?>

<!--error process -->

<?php if ($this->_tpl_vars['errMsg'] != ''): ?>
	<TR>
		<TD class="errorMsg" valign='middle'  align="center" colspan="4">
			<?php echo $this->_tpl_vars['errMsg']; ?>

		</TD>
	</TR>
<?php endif; ?>
<!--end error handling-->


<tr>
	<td colspan="2" align="center" nowrap>
		<?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>

	</td>
	<td colspan="3">
		<input type="text" size="15" name="Substitute" value=<?php echo $this->_tpl_vars['substitute']; ?>
>
	</td>
</tr>

<!--Add badword-->
	<tr>
		<td colspan="5">&nbsp;

		</td>
	</tr>
<?php if (! $this->_tpl_vars['isInstaller']): ?>

	<tr>
		<td align="right">
			<input type="Text" size="15" name="AddName" value="">
		</td>
		<td  align="center" size="5" >
			=>
		</td>
		<td>
			<input type="Text" size="15" name="AddValue" value="">
		</td>
		<td colspan="2">
			<input type="submit" name="Submit1" value="<?php echo $this->_tpl_vars['cnf_langs']['t4']; ?>
" onclick='javascript:document.submit();' align="left">
		</td>
	</tr>
<?php endif; ?>
	<tr>
		<td colspan="5" align="right">&nbsp;

		</td>
	</tr>

<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
	<tr>


		<td width="40%" align="right">
			<input type="Text" size="15" name="name_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['level_1']; ?>
">
			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['type']; ?>
">
			<input type="Hidden" name="field_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_foreach['fields']['iteration']; ?>
">
		</td>
		<td align="center" >
			=>
		</td>
		<td >
			<input type="Text" size="15" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
		</td>
		<td  align="left">
			<div style="white-space: nowrap;">
				<input type="Radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['disabled']): ?> checked <?php endif; ?> id="on<?php echo $this->_tpl_vars['key']; ?>
"><label for="on<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t5']; ?>
</label>
				<input type="Radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['disabled']): ?> checked <?php endif; ?> id="off<?php echo $this->_tpl_vars['key']; ?>
"><label for="off<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t6']; ?>
</label>
			</div>
		</td>
		<td>
		  <?php if (! $this->_tpl_vars['isInstaller']): ?>
			  <a href="javascript:decision('<?php echo $this->_tpl_vars['cnf_langs']['t10']; ?>
','cnf_config.php?module=badwords&method=Delete&ID=<?php echo $this->_tpl_vars['val']['id']; ?>
')"><?php echo $this->_tpl_vars['cnf_langs']['t7']; ?>
</a>
			<?php endif; ?>
		</td>

			<td align="right" width="5">
			<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
				<!--img src="info.jpg" alt="<?php echo $this->_tpl_vars['val']['comment']; ?>
" border="0" onClick="return show_info_page('<?php echo $this->_tpl_vars['val']['comment']; ?>
');"-->
				<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >
					<img src="info.jpg" alt="<?php echo $this->_tpl_vars['val']['comment']; ?>
" border="0" >
				</a>
			<?php endif; ?>
			</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>

	<tr>
		<td colspan="4">

		</td>
	</tr>