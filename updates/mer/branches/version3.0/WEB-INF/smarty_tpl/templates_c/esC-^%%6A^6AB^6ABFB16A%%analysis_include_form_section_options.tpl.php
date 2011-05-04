<?php /* Smarty version 2.6.26, created on 2011-05-04 14:55:50
         compiled from analysis_include_form_section_options.tpl */ ?>
<optgroup label="<?php echo $this->_tpl_vars['section']->getTitle(); ?>
">

	<?php $_from = $this->_tpl_vars['section']->getQuestionsOrder(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['question']):
?>
	<option value="<?php echo $this->_tpl_vars['question']->getId(); ?>
"<?php if (in_array ( $this->_tpl_vars['question']->getId() , $this->_tpl_vars['questions'] )): ?> selected="selected"<?php endif; ?>>
		<?php echo $this->_tpl_vars['question']->getQuestion(); ?>

	</option>
	<?php endforeach; endif; unset($_from); ?>
	<?php $_from = $this->_tpl_vars['section']->getChildSections(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childSection']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "analysis_include_form_section_options.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['childSection'],'questions' => $this->_tpl_vars['questions'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>

</optgroup>
