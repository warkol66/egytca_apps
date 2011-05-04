<?php /* Smarty version 2.6.26, created on 2011-05-04 14:27:38
         compiled from profiles_fill_form_relationship.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'profiles_fill_form_relationship.tpl', 8, false),array('modifier', 'count', 'profiles_fill_form_relationship.tpl', 16, false),)), $this); ?>
<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tablaborde'>
	<tr>
		<th colspan='2'> <form method="GET" action="Main.php" style="display:inline">
				<input type="hidden" name="do" value="<?php echo $_REQUEST['do']; ?>
" />
				<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor1']->getId(); ?>
" />
				##210,Relaciones entre## <?php echo $this->_tpl_vars['actor1']->getName(); ?>
 ##211,y##
				<select name='actor2' onchange="this.form.submit()">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['actors'],'selected' => $this->_tpl_vars['actor2']->getId()), $this);?>

				</select>
				<div class="reportlinkdiv"><a href="javascript:void(null);" class="deta" onclick="window.open('#','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div>
			</form></th>
	</tr>
	<?php if ($this->_tpl_vars['actor2']->getId()): ?>
	<tr>
		<td width="10%" valign='top' nowrap class='celltitulo'><div class='titulo2'>Formulario:</td>
		<td valign='top' class='celldato'><?php $this->assign('formId', $this->_tpl_vars['form']->getId()); ?> <div class='titulo2'  style="display: inline;"><?php echo $this->_tpl_vars['form']->getname($this->_tpl_vars['formId']); ?>
</div><?php if (count($this->_tpl_vars['forms']) > 1): ?> 
			<div id='formselect' class='noPrint' style="display: inline;">&nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_include_select_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
			<?php endif; ?>		 
		</td>
	</tr>
	<?php endif; ?>
</table>

<?php if ($this->_tpl_vars['actor2']->getId()): ?>
<form method="POST"	name="formQuestions" action="Main.php?do=doProfilesFormRelFill">
	<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor1']->getId(); ?>
" />
	<input type="hidden" name="actor2" value="<?php echo $this->_tpl_vars['actor2']->getId(); ?>
" />
	<input type="hidden" name="form" value="<?php echo $this->_tpl_vars['form']->getId(); ?>
" />
	<?php if ($_REQUEST['showAll']): ?>
	<input type="hidden" name="showAll" value="1" />
	<?php endif; ?>
	<table class="tablaborde" cellpadding="0" cellspacing="1" width="100%">
		<tr>
			<th width='60%'>Pregunta</th>
			<th width="4%"><?php if ($_REQUEST['showAll']): ?>Activa<?php endif; ?></th>
			<th width="26%">Valores</th>
			<th width="10%">Unidad</th>
		</tr>
		<?php $_from = $this->_tpl_vars['forms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_fill_form_relationship_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	</table>
	<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
<?php if ($_REQUEST['showAll']): ?>		
	<tr>
		<td class="celldato">&nbsp;</td>
	</tr>
	<tr>
			<td class="celldato">	
	<label for="selectAll">Seleccionar todas las preguntas</label><input type="checkbox" name="selectAll" onclick="javascript:selectAllQuestions(this.checked)" />
	</td>
		</tr>
		<tr>
			<td class="celldato">&nbsp;</td>
		</tr><?php endif; ?>
		<tr>
			<td class="cellboton">	<input type="submit" value="##212,Guardar cambios##" />
			</td>
		</tr>
		<tr>
			<td class="tablebottom"><img src="images/clear.gif" height="1" width="1"></td>
		</tr>
	</table>
</form>
<?php if (! $_REQUEST['showAll']): ?> <a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&showAll=1">##213,Ver todas las preguntas##</a> <?php endif; ?>
<?php endif; ?>