<?php /* Smarty version 2.6.16, created on 2010-04-23 16:35:57
         compiled from actors_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'actors_list.tpl', 24, false),)), $this); ?>
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
		<td class='fondotitulo'>##126,Editar Actores##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##127,A continuación podrá administrar los Actores ingresados en el sistema ##.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?php if (((is_array($_tmp=$this->_tpl_vars['actors'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp)) > 0): ?>
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
		<th width="60%">##101,Nombre del Actor##</th>
		<th width="35%">##102,Categoría##</th>
		<th width="5%">&nbsp;</th>
	</tr>
	<?php $_from = $this->_tpl_vars['actors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_actors_category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_actors_category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['actor']):
        $this->_foreach['for_actors_category']['iteration']++;
?>
	<tr valign="top">
		<td class='celldato'><span class='titulo2'><?php echo $this->_tpl_vars['actor']->getName(); ?>
</span></td>
		<td class='celldato'> <?php $this->assign('category', $this->_tpl_vars['actor']->getCategory()); ?>
			<?php if ($this->_tpl_vars['category'] != ""):  echo $this->_tpl_vars['category']->getName();  endif; ?> </td>
		<td class='cellopciones' nowrap>[ <a href='Main.php?do=actorsEditActorCategory&action=edit&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=actorsDoDeleteActor&action=edit&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
' class='elim' onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ]</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?> 