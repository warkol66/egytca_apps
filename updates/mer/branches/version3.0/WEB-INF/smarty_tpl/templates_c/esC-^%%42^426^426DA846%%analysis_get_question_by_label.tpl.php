<?php /* Smarty version 2.6.26, created on 2011-05-04 14:29:30
         compiled from analysis_get_question_by_label.tpl */ ?>
<h2>Actor: <?php echo $this->_tpl_vars['actor']->getName(); ?>
</h2>				

				<?php $this->assign('answer', $this->_tpl_vars['question']->getAnswer($this->_tpl_vars['actor'])); ?>
				<table width='100%' class='tablaborde' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> <?php echo $this->_tpl_vars['question']->getQuestion(); ?>
 </th>
					</tr>
					<tr>
						<td class='celldato' width='90%'><?php echo $this->_tpl_vars['answer']; ?>
</td>
					</tr>
				</table>