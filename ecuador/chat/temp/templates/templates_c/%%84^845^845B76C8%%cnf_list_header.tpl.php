<?php /* Smarty version 2.6.10, created on 2013-06-15 00:19:13
         compiled from cnf_list_header.tpl */ ?>
<FORM action="cnf_config.php" method="post" enctype="multipart/form-data" name="cnf_form" onsubmit="javascript:sbmt();">
<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="js" value="">

<table border="0" <?php if ($this->_tpl_vars['module'] == 'msg'): ?>width="500"<?php else: ?>width="700"<?php endif; ?>>