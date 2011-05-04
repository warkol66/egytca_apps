<?php /* Smarty version 2.6.26, created on 2011-05-04 13:32:41
         compiled from profiles_form_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'profiles_form_view.tpl', 31, false),)), $this); ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="titulo">##197,Caracterización de Actores##</td>
	</tr>
	<tr>
		<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="fondotitulo">##198,Edición de Perfiles##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="texto">##201,Ingrese la información de caracterización del Actor## <strong>&quot;<?php echo $this->_tpl_vars['actor']->getName(); ?>
&quot;</strong>.</td>
	</tr>
	</tr>
	<td>&nbsp;</td>
	</tr>
</table>
<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
	<tr>
		<th colspan="2">##202,Caracterización de## <?php echo $this->_tpl_vars['actor']->getName(); ?>

			<div align="right"><a href="javascript:void(null);" class="deta" onclick="window.open('Main.php?do=profilesFormView&actor=<?php echo $this->_tpl_vars['actor']->getId(); ?>
&form=<?php echo $this->_tpl_vars['form']->getId(); ?>
&report=1','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></th>
	</tr>
	<tr>
		<td width="10%" nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
		<td class='celldato'><?php $this->assign('formId', $this->_tpl_vars['form']->getId()); ?> <div class='titulo2' style="display: inline;"><?php echo $this->_tpl_vars['form']->getname($this->_tpl_vars['formId']); ?>
</div><?php if (count($this->_tpl_vars['forms']) > 1): ?> 
			<div id='formselect' class='noPrint' style="display: inline;">&nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_include_select_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
			<?php endif; ?>		 </td>
	</tr>
	<tr>
		<td valign='top' colspan='2' class='celldato'>
	<?php if ($this->_tpl_vars['form']->getRootSection()): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_form_view_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	</td>
		</tr>
	<tr>
		<td colspan="2" class="tablebottom"><img src="index.php_files/clear.gif" height="1" width="1"></td>
	</tr>
</table>