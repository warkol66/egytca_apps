<?php



/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateQuery extends BaseAffiliateQuery {

    /**
     * Permite agregar un filtro personalizado a la Query, que puede ser 
     * traducido al campo correspondiente.
     * 
     * @param   type $filterName
     * @param   type $filterValue
     * @return  AffiliateQuery 
     */
    public function addFilter($filterName, $filterValue) {
        
        $filterName = ucfirst($filterName);
        
        switch ($filterName) {
            case 'SearchString':
                $this->filterByName("%$filterValue%", Criteria::LIKE);
                break;

            default:
                if (in_array($filterName, AffiliatePeer::getFieldNames(BasePeer::TYPE_PHPNAME)))
                    $this->filterBy($filterName, $filterValue);
                else {
                    //Log - campo inexistente.
                }
                    
                break;
        }
        
        return $this;
    }
    
    /**
     * Agrega el limite a la consulta, si existe.
     * 
     * @param   int $limit 
     * @return  AffiliateQuery
     */
    public function limitIfExists($limit = null) {
        
        if (!empty($limit)) {
            $this->limit($limit);
        }
        
        return $this;
    }
    
} // AffiliateQuery
