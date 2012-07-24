<?php

class AffiliatesListAction extends BaseAction {

  /**
   * Contenedor de variables que parametrizan la accion.
   * @var array
   */
  private $parameterHolder;
    
	function AffiliatesListAction() {
		$this->parameterHolder = array(
            'module'     => 'Affiliates',
            'listAction' => 'affiliatesList',
            'classKey'   => AffiliatePeer::CLASSKEY_AFFILIATE,
            'class'       => 'Affiliate'
    );
	}

  /**
   * Acceso a una variable del contenedor de variables de la accion.
   * @param   string $name
   * @return  mixed
   */
  protected function get($name) {
    return $this->parameterHolder[$name];
  }
  
  /**
   * Modificacion de una variable del contenedor de variables de la accion.
   * @param   string $name
   * @param   string $value 
   */
  protected function set($name, $value) {
    $this->parameterHolder[$name] = $value;
  }

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
  	$smarty->assign("module",$module);

  	$smarty->assign("message",$_GET["message"]);

		if (!isset($filters["perPage"]))
			$perPage = Common::getRowsPerPage();
		else
			$perPage = $filters["perPage"];

		$pager = BaseQuery::create($this->parameterHolder['class'])->createPager($filters,$page,$perPage);
		
		$url = "Main.php?do=affiliatesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("filters", $filters);
		$smarty->assign("affiliates",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
