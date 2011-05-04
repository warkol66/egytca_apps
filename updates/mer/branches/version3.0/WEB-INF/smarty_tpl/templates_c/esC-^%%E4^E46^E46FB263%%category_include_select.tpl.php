<?php /* Smarty version 2.6.26, created on 2011-05-04 14:54:22
         compiled from category_include_select.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'category_include_select.tpl', 9, false),)), $this); ?>
<form method="get" action="Main.php"> 
	<input type="hidden" name="do" value="actorSelect" /> 
	<input type="hidden" name="successAction" value="<?php echo $this->_tpl_vars['successAction']; ?>
" /> 
	<table class="tablaborde" border="0" cellpadding="3" cellspacing="1" width="100%"> 
		<tr> 
			<td class="celltitulo2" nowrap="nowrap" width="35%">##103,Seleccione una categoría##</td> 
			<td class="celldato"><input name="modulo" value="contacto" type="hidden"> 
				<select name="catID" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" > 
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categories']), $this);?>

					<option value="" selected="selected">##103,Seleccione una categoría##</option> 
				</select> </td> 
		</tr> 
		<tr> 
			<td class="cellboton" colspan="2"><input value="##120,Continuar##" class="boton" type="submit"> 
&nbsp;&nbsp; 
				<input onclick="history.go(-1)" value="##104,Regresar##" class="boton" type="button"></td> 
		</tr> 
	</table> 
</form>