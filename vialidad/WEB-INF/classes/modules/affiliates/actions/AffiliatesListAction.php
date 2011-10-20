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
            'peer'       => new AffiliatePeer(),
            'query'      => AffiliateQuery::create()
        );
	}

	function execute($mapping, $form, &$request, &$response) {

        BaseAction::execute($mapping, $form, $request, $response);

        $plugInKey = 'SMARTY_PLUGIN';
        $smarty =& $this->actionServer->getPlugIn($plugInKey);
        if($smarty == NULL) {
            echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
        }

        $module = $this->get('module');
        $smarty->assign("module",$module);

        $smarty->assign("message",$_GET["message"]);

        $filters = $_GET["filters"];
        
        $affiliatePeer = $this->getPeer($filters);
        $pager = $affiliatePeer->getAllPaginatedFiltered($_GET["page"]);
//        $pager = $this->createPager($filters, $_GET["page"]);

        $url = "Main.php?do=". $this->get('listAction');
        foreach ($filters as $key => $value)
            $url .= "&filters[$key]=$value";

        $smarty->assign("filters", $filters);
        $smarty->assign("url", $url);
        $smarty->assign("affiliates", $pager->getResult());
        $smarty->assign("pager", $pager);

        return $mapping->findForwardConfig('success');
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
    
    /**
     * Acceso a la clase Peer, con los filtros establecidos.
     * @param   array $filters
     * @return  AffiliatePeer
     */
    protected function getPeer($filters) {
        $peer = $this->get('peer');
        
        $filters["classKey"] = $this->get('classKey');
		foreach(array_keys($peer->filterConditions) as $filterKey) {
			if (isset($filters[$filterKey])) {
				$filterMethod = $peer->filterConditions[$filterKey];
				$peer->$filterMethod($filters[$filterKey]);
			}
        }
        
        return $peer;
    }
    
    /**
     * Acceso a la clase Query, con los filtros establecidos.
     * @param   array $filters
     * @return  AffiliateQuery
     */
    protected function getQuery($filters) {
        $query = $this->get('query');
        $query = AffiliateQuery::create();
        
        $filters["classKey"] = $this->get('classKey');
		foreach($filters as $filterName => $filterValue) {
			if (isset($filterValue)) {
                $query->addFilter($filterName, $filterValue);
			}
        }
        
        return $query;
    }
    
    /**
     * Encapsulamiento de la creacion del Pager (Factory Method).
     * @param   array $filters
     * @param   int $page
     * @return  PropelPager 
     */
    protected function createPager($filters, $page = 1) {
        $perPage = Common::getRowsPerPage();
        $query = $this->getQuery($filters);
        return new PropelPager($query, "AffiliatePeer", "doSelect", $page, $perPage);
    }

}
