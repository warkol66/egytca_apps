<?php /* Smarty version 2.6.10, created on 2013-06-15 00:17:01
         compiled from top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'top.tpl', 30, false),)), $this); ?>
<html>
	<head>
		<title>FlashChat Admin Panel</title>
		<meta http-equiv=Content-Type content="text/html;  charset=UTF-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top_js_and_style.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</head>

<body>
		<center>
		<form action="cnf_config.php" method="post" enctype="multipart/form-data" >

			<a href="index.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b0']['l'];  echo $this->_tpl_vars['langs_top']['t0'];  echo $this->_tpl_vars['b0']['r']; ?>
</a>
<!--<?php if ($this->_tpl_vars['fc_admin_chat_instance'] != '' && $this->_tpl_vars['IS_ADMIN'] == 1): ?>| <a href="main.php"><?php echo $this->_tpl_vars['langs_top']['t1']; ?>
</a>
            <input type="Hidden" value="<?php echo $this->_tpl_vars['module']; ?>
" name="module2">
<?php endif; ?>-->|

			<a href="cnf_config.php?<?php echo $this->_tpl_vars['rand']; ?>
&module=general"><?php echo $this->_tpl_vars['b1']['l'];  echo $this->_tpl_vars['langs_top']['t2'];  echo $this->_tpl_vars['b1']['r']; ?>
</a> |
			<a href="msglist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b2']['l'];  echo $this->_tpl_vars['langs_top']['t3'];  echo $this->_tpl_vars['b2']['r']; ?>
</a> |
			<a href="chatlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b3']['l'];  echo $this->_tpl_vars['langs_top']['t4'];  echo $this->_tpl_vars['b3']['r']; ?>
</a> |
			<a href="usrlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b4']['l'];  echo $this->_tpl_vars['langs_top']['t5'];  echo $this->_tpl_vars['b4']['r']; ?>
</a> |
			<a href="roomlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b5']['l'];  echo $this->_tpl_vars['langs_top']['t6'];  echo $this->_tpl_vars['b5']['r']; ?>
</a> |
			<a href="connlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b6']['l'];  echo $this->_tpl_vars['langs_top']['t7'];  echo $this->_tpl_vars['b6']['r']; ?>
</a> |
			<a href="banlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b7']['l'];  echo $this->_tpl_vars['langs_top']['t8'];  echo $this->_tpl_vars['b7']['r']; ?>
</a> |
			<a href="ignorelist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b8']['l'];  echo $this->_tpl_vars['langs_top']['t9'];  echo $this->_tpl_vars['b8']['r']; ?>
</a> |
			<a href="botlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b9']['l'];  echo $this->_tpl_vars['langs_top']['t10'];  echo $this->_tpl_vars['b9']['r']; ?>
</a> |
			<a href="uninstall.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b10']['l'];  echo $this->_tpl_vars['langs_top']['t11'];  echo $this->_tpl_vars['b10']['r']; ?>
</a> |
			<a href="logout.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b11']['l'];  echo $this->_tpl_vars['langs_top']['t12'];  echo $this->_tpl_vars['b11']['r']; ?>
</a>
			<p>
				<?php if ($this->_tpl_vars['fc_admin_chat_instance'] != '' && $this->_tpl_vars['IS_ADMIN'] == 1 && count($this->_tpl_vars['chat_instances']) > 1): ?>
				Load another chat instance:
  	          		<SELECT NAME=instances onchange='submit();' >
			   			<?php $_from = $this->_tpl_vars['chat_instances']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
			    			<OPTION VALUE=<?php echo $this->_tpl_vars['val']['id']; ?>
    <?php if ($this->_tpl_vars['val']['id'] == $this->_tpl_vars['instance_ID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['name']; ?>

		       			<?php endforeach; endif; unset($_from); ?>
	          		</SELECT>
	         		<input type="Hidden" value="<?php echo $this->_tpl_vars['module']; ?>
" name="module">
				<?php endif; ?></p>

        </form>
		</center>
		<hr>