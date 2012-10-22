<?php



/**
 * This class defines the structure of the 'affiliates_branch' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.affiliates.classes.map
 */
class AffiliateBranchTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'affiliates.classes.map.AffiliateBranchTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('affiliates_branch');
        $this->setPhpName('AffiliateBranch');
        $this->setClassname('AffiliateBranch');
        $this->setPackage('affiliates.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('AFFILIATEID', 'Affiliateid', 'INTEGER', 'affiliates_affiliate', 'ID', true, null, null);
        $this->addColumn('NUMBER', 'Number', 'INTEGER', true, null, null);
        $this->addColumn('CODE', 'Code', 'VARCHAR', false, 20, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
        $this->getColumn('NAME', false)->setPrimaryString(true);
        $this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 100, null);
        $this->addColumn('CONTACT', 'Contact', 'VARCHAR', false, 50, null);
        $this->addColumn('CONTACTEMAIL', 'Contactemail', 'VARCHAR', false, 100, null);
        $this->addColumn('MEMO', 'Memo', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Affiliate', 'Affiliate', RelationMap::MANY_TO_ONE, array('affiliateId' => 'id', ), null, null);
    } // buildRelations()

} // AffiliateBranchTableMap
