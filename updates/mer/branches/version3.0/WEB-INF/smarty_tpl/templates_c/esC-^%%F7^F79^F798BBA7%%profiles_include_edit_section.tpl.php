<?php /* Smarty version 2.6.26, created on 2011-05-04 14:51:08
         compiled from profiles_include_edit_section.tpl */ ?>
<form action="Main.php" method="post" id="form_section_<?php echo $this->_tpl_vars['section']->getId(); ?>
" style="display:none;">
	<input type="hidden" name="do" value="<?php echo $this->_tpl_vars['do']; ?>
" />
	<input type="hidden" name="form" value="<?php echo $this->_tpl_vars['form']->getId(); ?>
" />
	<input type="hidden" name="edit_section" value="1" />
	<input type="hidden" name="sectionId" value="<?php echo $this->_tpl_vars['section']->getId(); ?>
" />
	<input type="text" name="newTitle" value="<?php echo $this->_tpl_vars['section']->getTitle(); ?>
" />
	<input type="button" value="##500,Cancelar##" onclick="this.parentNode.style.display = 'none'" class="boton" />
	<input type="submit" value="##97,Guardar##" class="boton" />
</form>