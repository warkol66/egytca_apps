<?php /* Smarty version 2.6.26, created on 2011-05-04 13:31:34
         compiled from profiles_fill_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'profiles_fill_form.tpl', 32, false),)), $this); ?>
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
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
<?php if ($_REQUEST['status'] == 'ok'): ?><div align="center" class="textoerror">##206,Cambios guardados##</div> <?php endif; ?>
	<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
			<tr>
				<th colspan="2">##202,Caracterización de## <?php echo $this->_tpl_vars['actor']; ?>
</th>
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

	</table>
	


<form method="POST"	name="formQuestions" action="Main.php?do=doProfilesFormFill">
	<input type="hidden" name="actor" value="<?php echo $this->_tpl_vars['actor']->getId(); ?>
" />
	<input type="hidden" name="form" value="<?php echo $this->_tpl_vars['form']->getId(); ?>
" />
	<?php if ($_REQUEST['showAll']): ?>
	<input type="hidden" name="showAll" value="1" />
	<?php endif; ?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td>
			<?php if ($this->_tpl_vars['form']->getRootSection()): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "profiles_fill_form_section.tpl", 'smarty_include_vars' => array('section' => $this->_tpl_vars['form']->getRootSection())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
				</td>
		</tr>
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
			<td class="cellboton"><input name="guardar" value="##203,Guardar datos de la sección##" class="boton" type="submit">
			</td>
		</tr>
		<tr>
			<td class="tablebottom"><img src="images/clear.gif" height="1" width="1"></td>
		</tr>
	</table>
</form>
<?php if (! $_REQUEST['showAll']): ?> <a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&showAll=1">##213,Ver todas las preguntas##</a> <?php endif; ?>