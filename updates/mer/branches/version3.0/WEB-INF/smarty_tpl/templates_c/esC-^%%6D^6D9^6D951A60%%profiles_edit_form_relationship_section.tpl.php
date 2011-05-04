<?php /* Smarty version 2.6.26, created on 2011-05-04 14:51:08
         compiled from profiles_edit_form_relationship_section.tpl */ ?>
<?php if ($this->_tpl_vars['section']->getParentSectionId()): ?>
			(S)&nbsp;<?php echo $this->_tpl_vars['section']->getTitle(); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_include_edit_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['section'],'do' => 'doProfilesFormRelEdit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<div class='questionActions' style="display:inline">
      	[&nbsp;<a href="#" onclick="document.getElementById('form_section_<?php echo $this->_tpl_vars['section']->getId(); ?>
').style.display = 'inline'" class='deta'>##114,Editar##</a>&nbsp;]
	<form method='POST' action="Main.php?do=doProfilesFormRelEdit&delete=1&sectionId=<?php echo $this->_tpl_vars['section']->getId(); ?>
&form=<?php echo $this->_tpl_vars['form']->getId(); ?>
#edit" name='formsection<?php echo $this->_tpl_vars['section']->getId(); ?>
' style="display:inline">
					[&nbsp;<a href="javascript:document.formsection<?php echo $this->_tpl_vars['section']->getId(); ?>
.submit();" class='elim' onclick="return confirm('##214,¿Está seguro que desea eliminar esta sección y todas las preguntas asociadas?##')">##115,Eliminar##</a>&nbsp;]
				</form>
</div>
<?php endif; ?>
<ul>
	<?php $_from = $this->_tpl_vars['section']->getQuestionsOrder(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['question']):
?>
	<li> <?php echo $this->_tpl_vars['question']->getQuestion(); ?>

		<div class='questionActions' style="display:inline"> [&nbsp;<a href="Main.php?do=profilesFormRelEdit&edit=1&questionId=<?php echo $this->_tpl_vars['question']->getId(); ?>
&form=<?php echo $this->_tpl_vars['form']->getId(); ?>
#edit" class='deta'>##114,Editar##</a>&nbsp;]
			<form method='POST' action="Main.php?do=doProfilesFormRelEdit&delete=1&questionId=<?php echo $this->_tpl_vars['question']->getId(); ?>
&form=<?php echo $this->_tpl_vars['form']->getId(); ?>
#edit" name='formquestion<?php echo $this->_tpl_vars['question']->getId(); ?>
' style="display:inline">
				[&nbsp;<a href="javascript:document.formquestion<?php echo $this->_tpl_vars['question']->getId(); ?>
.submit();" class='elim' onclick="return confirm('##215,¿Está seguro que desea eliminar esta pregunta?##')">##115,Eliminar##</a>&nbsp;]
			</form>
		</div>
	</li>
	<?php endforeach; endif; unset($_from); ?>
	<?php $_from = $this->_tpl_vars['section']->getChildSections(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childSection']):
?>
	<li> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_edit_form_relationship_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['childSection'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </li>
	<?php endforeach; endif; unset($_from); ?>
</ul>