<?php /* Smarty version 2.6.26, created on 2011-05-04 14:28:50
         compiled from ActorsSelectInclude.tpl */ ?>
<form method='get' name='sel'>
	<table class='tableTdBorders' cellspacing='0' cellpadding='0' border='0' width='100%'>
		<tr>
			<th colspan='2'><div class='textTitleTh'>##200,Actores Clave de## &quot;<?php echo $this->_tpl_vars['category']->getName(); ?>
&quot;</div></th>
		</tr>
		<?php $_from = $this->_tpl_vars['principalActors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_principal_actors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_principal_actors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_principal_actors']['iteration']++;
?>
		<tr>
			<td width="90%" class='tdTextTitle'><a href='Main.php?do=<?php echo $this->_tpl_vars['do']; ?>
&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
'><?php echo $this->_tpl_vars['actor']->getName(); ?>
</a></div></td>
			<td width='10%' nowrap>[ <a href='Main.php?do=<?php echo $this->_tpl_vars['do']; ?>
&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='deta'><?php if ($this->_tpl_vars['do'] == 'analysisActor'): ?>##236,Ver Análisis##<?php else: ?>Ver Estrategias<?php endif; ?></a> ]</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class='tdButton' colspan='2'><input name="button" type='button' class='boton' onclick='history.go(-1)' value='##104,Regresar##' /></td>
		</tr>
	</table>
</form>