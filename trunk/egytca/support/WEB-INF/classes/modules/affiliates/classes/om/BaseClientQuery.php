<?php


/**
 * Skeleton subclass for representing a query for one of the subclasses of the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes.om
 */
class BaseClientQuery extends AffiliateQuery {

    /**
     * Returns a new ClientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ClientQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ClientQuery) {
            return $criteria;
        }
        $query = new ClientQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Filters the query to target only Client objects.
     */
    public function preSelect(PropelPDO $con)
    {
        $this->addUsingAlias(AffiliatePeer::CLASS_KEY, AffiliatePeer::CLASSKEY_2);
    }

    /**
     * Filters the query to target only Client objects.
     */
    public function preUpdate(&$values, PropelPDO $con, $forceIndividualSaves = false)
    {
        $this->addUsingAlias(AffiliatePeer::CLASS_KEY, AffiliatePeer::CLASSKEY_2);
    }

    /**
     * Filters the query to target only Client objects.
     */
    public function preDelete(PropelPDO $con)
    {
        $this->addUsingAlias(AffiliatePeer::CLASS_KEY, AffiliatePeer::CLASSKEY_2);
    }

    /**
     * Issue a DELETE query based on the current ModelCriteria deleting all rows in the table
     * Having the Client class.
     * This method is called by ModelCriteria::deleteAll() inside a transaction
     *
     * @param PropelPDO $con a connection object
     *
     * @return integer the number of deleted rows
     */
    public function doDeleteAll($con)
    {
        // condition on class key is already added in preDelete()
        return parent::doDelete($con);
    }

} // BaseClientQuery
