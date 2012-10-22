<?php



/**
 * This class defines the structure of the 'requirements_requirement' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.requirements.classes.map
 */
class RequirementTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'requirements.classes.map.RequirementTableMap';

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
        $this->setName('requirements_requirement');
        $this->setPhpName('Requirement');
        $this->setClassname('Requirement');
        $this->setPackage('requirements.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
        $this->getColumn('NAME', false)->setPrimaryString(true);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('OUTPUT', 'Output', 'LONGVARCHAR', false, null, null);
        $this->addColumn('INPUT', 'Input', 'LONGVARCHAR', false, null, null);
        $this->addColumn('PROCESS', 'Process', 'LONGVARCHAR', false, null, null);
        $this->addColumn('OTHER', 'Other', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ESTIMATEDDELIVERY', 'Estimateddelivery', 'TIMESTAMP', false, null, null);
        $this->addColumn('REALDELIVERY', 'Realdelivery', 'TIMESTAMP', false, null, null);
        $this->addColumn('DELIVERED', 'Delivered', 'BOOLEAN', false, 1, false);
        $this->addForeignKey('DEVELOPMENTID', 'Developmentid', 'INTEGER', 'requirements_development', 'ID', false, null, null);
        $this->addForeignKey('CLIENTID', 'Clientid', 'INTEGER', 'affiliates_affiliate', 'ID', false, null, null);
        $this->addColumn('ESTIMATEDHOURS', 'Estimatedhours', 'FLOAT', false, null, null);
        $this->addColumn('ESTIMATEDCOST', 'Estimatedcost', 'FLOAT', false, null, null);
        $this->addColumn('REALHOURS', 'Realhours', 'FLOAT', false, null, null);
        $this->addColumn('REALCOST', 'Realcost', 'FLOAT', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Development', 'Development', RelationMap::MANY_TO_ONE, array('developmentId' => 'id', ), 'CASCADE', null);
        $this->addRelation('Affiliate', 'Affiliate', RelationMap::MANY_TO_ONE, array('clientId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

} // RequirementTableMap
