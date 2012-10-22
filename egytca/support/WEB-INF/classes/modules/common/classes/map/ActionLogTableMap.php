<?php



/**
 * This class defines the structure of the 'actionLogs_log' table.
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
class ActionLogTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'common.classes.map.ActionLogTableMap';

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
        $this->setName('actionLogs_log');
        $this->setPhpName('ActionLog');
        $this->setClassname('ActionLog');
        $this->setPackage('common.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('USEROBJECTTYPE', 'Userobjecttype', 'VARCHAR', true, 50, null);
        $this->addColumn('USEROBJECTID', 'Userobjectid', 'INTEGER', true, null, null);
        $this->addColumn('DATETIME', 'Datetime', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('ACTION', 'Action', 'VARCHAR', 'security_action', 'ACTION', true, 100, null);
        $this->addColumn('MESSAGE', 'Message', 'VARCHAR', false, 255, null);
        $this->addColumn('FORWARD', 'Forward', 'VARCHAR', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SecurityAction', 'SecurityAction', RelationMap::MANY_TO_ONE, array('action' => 'action', ), null, null);
    } // buildRelations()

} // ActionLogTableMap
