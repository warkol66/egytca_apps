<?php /* Smarty version 2.6.26, created on 2011-05-04 14:55:09
         compiled from analysis_graph_list.tpl */ ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Administración de Gráficos </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>Administrar los gráficos </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0" cellpadding='0' cellspacing='1' class='tablaborde0'>
	<tr>
		<th width="40%" class='tituloseccion02'>Nombre</th>
		<th width="10%" class='tituloseccion02'>Tipo</th>
		<th width="40%" class='tituloseccion02'>Actores</th>
		<th width="10%" class='tituloseccion02'>&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['graphs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_graphs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_graphs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['graph']):
        $this->_foreach['for_graphs']['iteration']++;
?>
	<tr>
		<td class='celldato'><?php echo $this->_tpl_vars['graph']->getName(); ?>
</td>
		<td class='celldato'><?php echo $this->_tpl_vars['graph']->getType(); ?>
</td>
		<td class='celldato'><?php if ($this->_tpl_vars['graph']->getActors() == 0): ?>Todos<?php else: ?>Uno<?php endif; ?></td>
		<td nowrap class='celldato'>[ <a href='Main.php?do=analysisGraphDoDelete&id=<?php echo $this->_tpl_vars['graph']->getId(); ?>
' class='elim'>Eliminar</a> ][ <a href='Main.php?do=analysisGraphEdit&id=<?php echo $this->_tpl_vars['graph']->getId(); ?>
' class='edit'>Editar</a> ][ <a href='Main.php?do=analysisGraphJudgementEdit&graph=<?php echo $this->_tpl_vars['graph']->getId(); ?>
' class='deta'>Juicios</a> ]</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<a href="Main.php?do=analysisGraphEdit">Nuevo Gráfico</a> 