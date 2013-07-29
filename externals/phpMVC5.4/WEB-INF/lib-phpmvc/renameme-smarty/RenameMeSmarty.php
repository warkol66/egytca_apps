<?php

require_once __DIR__.'/../Smarty-3.1.14/libs/Smarty.class.php';

class RenameMeSmarty extends Smarty {

	function __construct() {

		parent::__construct();

		$this->setTemplateDir(__DIR__.'/../../tpl/');
        $this->setCompileDir(__DIR__.'/../../smarty_tpl/templates_c/');
        $this->setConfigDir(__DIR__.'/../../smarty_tpl/configs/');
        $this->setCacheDir(__DIR__.'/../../smarty_tpl/cache/');

        $this->left_delimiter = '|-';
        $this->right_delimiter = '-|';
	}
}
