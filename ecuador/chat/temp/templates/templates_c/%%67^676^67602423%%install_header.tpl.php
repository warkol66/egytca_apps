<?php /* Smarty version 2.6.10, created on 2013-06-15 00:15:19
         compiled from install_header.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_js_and_style.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language="javascript" src="prototype.js"></script>
<?php echo '
<SCRIPT type="text/javascript">
	var status = new Array(); 
	function showHide(id) {
		status[id] = !status[id];
		if (status[id]) {
			$(id).hide();
		}
		else {
			$(id).show();
		}
	}
</SCRIPT>
'; ?>