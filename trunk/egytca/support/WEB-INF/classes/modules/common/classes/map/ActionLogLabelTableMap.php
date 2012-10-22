<?php



/**
 * This class defines the structure of the 'actionLogs_label' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.common.classes.map
 */
class ActionLogLabelTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'common.classes.map.ActionLogLabelTableMap';

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
        $this->setName('actionLogs_label');
        $this->setPhpName('ActionLogLabel');
        $this->setClassname('ActionLogLabel');
        $this->setPackage('common.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addPrimaryKey('ACTION', 'Action', 'VARCHAR', true, 100, null);
        $this->addColumn('LABEL', 'Label', 'VARCHAR', true, 100, null);
        $this->addColumn('LANGUAGE', 'Language', 'VARCHAR', false, 100, null);
        $this->addColumn('FORWARD', 'Forward', 'VARCHAR', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // ActionLogLabelTableMap
