<?php /* Smarty version 2.6.26, created on 2011-05-04 13:31:36
         compiled from profiles_fill_form_section.tpl */ ?>
<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
<?php if ($_REQUEST['showAll'] || $this->_tpl_vars['section']->doCountQuestionsForActor($this->_tpl_vars['actor']) > 0): ?>
	<tr>
		<td valign='top' colspan='<?php if ($_REQUEST['showAll']): ?>3<?php else: ?>2<?php endif; ?>' class='celltitulo'><div class="titulo2"><?php echo $this->_tpl_vars['section']->getTitle(); ?>
</div></td>
	</tr>
<?php endif; ?>
<?php if ($_REQUEST['showAll']): ?>
	<?php $this->assign('questions', $this->_tpl_vars['section']->getQuestionsOrder($this->_tpl_vars['actor'])); ?>
<?php else: ?>
	<?php $this->assign('questions', $this->_tpl_vars['section']->getQuestionsForActor($this->_tpl_vars['actor'])); ?>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['questions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['question']):
?>
	<tr>	
		<td width='55%' valign='top' class='celltitulo'><div class='titulo2'><label for='q_<?php echo $this->_tpl_vars['question']->getId(); ?>
'><?php echo $this->_tpl_vars['question']->getQuestion(); ?>
</label></div></td>
	<?php if ($_REQUEST['showAll']): ?>
		<td width='5%' class="celldato">
			<input type="checkbox" id="active_<?php echo $this->_tpl_vars['question']->getId(); ?>
" name="applyableQuestions[]" value="<?php echo $this->_tpl_vars['question']->getID(); ?>
" <?php if ($this->_tpl_vars['question']->appliesTo($this->_tpl_vars['actor'])): ?>checked='checked'<?php endif; ?> />
		</td>
	<?php endif; ?>
		<td width='40%' nowrap='nowrap' class='celldato'><?php echo $this->_tpl_vars['question']->toHTML($this->_tpl_vars['actor']); ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['section']->getChildSections(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childSection']):
?>
	<tr>
		<td style='padding-left:12px;' colspan='<?php if ($_REQUEST['showAll']): ?>3<?php else: ?>2<?php endif; ?>' class='cellwhite' width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_fill_form_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['childSection'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>