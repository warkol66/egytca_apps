<?php /* Smarty version 2.6.26, created on 2011-05-04 13:32:43
         compiled from profiles_form_view_section.tpl */ ?>
<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
	<?php if ($this->_tpl_vars['section']->doCountQuestionsForActor($this->_tpl_vars['actor']) > 0): ?>
	<tr>
	<td valign='top' colspan='2' class='celltitulo'><div class="titulo2"><?php echo $this->_tpl_vars['section']->getTitle(); ?>
</div></td>
	</tr>
	<?php endif; ?>
	<?php $this->assign('questions', $this->_tpl_vars['section']->getQuestionsForActor($this->_tpl_vars['actor'])); ?>
	<?php $_from = $this->_tpl_vars['questions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['question']):
?>
	<tr>
		<td width='70%' valign='top' class='celltitulo'><div class='titulo2'><?php echo $this->_tpl_vars['question']->getQuestion(); ?>
</div></td>
		<td width="30%" class='celldato'><?php echo $this->_tpl_vars['question']->getAnswer($this->_tpl_vars['actor']); ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['section']->getChildSections(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childSection']):
?>
	<tr>
		<td colspan='2' class='cellwhite' style='padding-left:12px;'><div id='<?php echo $this->_tpl_vars['childSection']->getId(); ?>
' style='display:block;'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_form_view_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['childSection'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
			<div id='hide<?php echo $this->_tpl_vars['childSection']->getId(); ?>
' class='texto_noimprimir'>
					<input type='submit' id='button<?php echo $this->_tpl_vars['childSection']->getId(); ?>
' value='Ocultar Sección' class='hidebutton' onClick='switch_vis("<?php echo $this->_tpl_vars['childSection']->getId(); ?>
");switch_value("button<?php echo $this->_tpl_vars['childSection']->getId(); ?>
");' />
					</div>
		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?> 
</table>