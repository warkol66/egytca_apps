<?php /* Smarty version 2.6.26, created on 2011-05-04 12:17:36
         compiled from profiles_fill_form_relationship_section.tpl */ ?>
<?php if ($_REQUEST['showAll'] != '' || $this->_tpl_vars['section']->doCountQuestionsForRelationship($this->_tpl_vars['actor1'],$this->_tpl_vars['actor2']) > 0 || $this->_tpl_vars['section']->getChildSections() != ""): ?>
<!--
<script type="text/javascript">
	function setActiveQuestion(id){
		var input = document.getElementById("q_"+id);		
		var event = input.addEventListener("change",function(e){alert(document.getElementById('active_'+id));});		
	}
</script>
-->
<?php if ($_REQUEST['showAll']): ?>
		<?php $this->assign('questions', $this->_tpl_vars['section']->getQuestionsOrder($this->_tpl_vars['actor1'])); ?>
	<?php else: ?>
		<?php $this->assign('questions', $this->_tpl_vars['section']->getQuestionsForRelationship($this->_tpl_vars['actor1'],$this->_tpl_vars['actor2'])); ?>
	<?php endif; ?>
	<?php $_from = $this->_tpl_vars['questions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['question']):
?>
		<tr>
	<td width='60%' valign='top' class='celltitulo'><div class='titulo2'>
			<label for='q_<?php echo $this->_tpl_vars['question']->getId(); ?>
'><?php echo $this->_tpl_vars['question']->getQuestion(); ?>
</label>
		</div></td>
	<td width="4%" class="celldato"><?php if ($_REQUEST['showAll']): ?>
				<input type="checkbox" id="active_<?php echo $this->_tpl_vars['question']->getId(); ?>
" name="applyableQuestions[]" value="<?php echo $this->_tpl_vars['question']->getID(); ?>
" <?php if ($this->_tpl_vars['question']->appliesToRelationship($this->_tpl_vars['actor1'],$this->_tpl_vars['actor2'])): ?>checked='checked'<?php endif; ?> /><?php endif; ?></td>
	<td width="26%" class='celldato' nowrap="nowrap"><?php echo $this->_tpl_vars['question']->relationshipToHTML($this->_tpl_vars['actor1'],$this->_tpl_vars['actor2']); ?>

				<!-- <script type="text/javascript">setActiveQuestion(<?php echo $this->_tpl_vars['question']->getId(); ?>
)
				</script>
				--></td>
	<td width="10%" class='celldato' nowrap="nowrap"><?php echo $this->_tpl_vars['question']->getUnit(); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
	<?php $_from = $this->_tpl_vars['section']->getChildSections(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childSection']):
?>
	<tr>
	<td colspan="4" class="fondoffffff">
	<tr>
	<td class="fondoffffff" colspan="4">
	  <?php if ($_REQUEST['showAll'] || $this->_tpl_vars['childSection']->doCountQuestionsForRelationship($this->_tpl_vars['actor1'],$this->_tpl_vars['actor2']) > 0): ?>
		<strong>
			<div class='titulo2'><?php echo $this->_tpl_vars['childSection']->getTitle(); ?>
</div>
		</strong>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_fill_form_relationship_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['childSection'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</td>
</tr>
<?php endif; ?> 