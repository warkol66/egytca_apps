<?php



/**
 * This class defines the structure of the 'modules_entity' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.modules.classes.map
 */
class ModuleEntityTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'modules.classes.map.ModuleEntityTableMap';

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
        $this->setName('modules_entity');
        $this->setPhpName('ModuleEntity');
        $this->setClassname('ModuleEntity');
        $this->setPackage('modules.classes');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignKey('MODULENAME', 'Modulename', 'VARCHAR', 'modules_module', 'NAME', true, 50, null);
        $this->addPrimaryKey('NAME', 'Name', 'VARCHAR', true, 50, null);
        $this->addColumn('PHPNAME', 'Phpname', 'VARCHAR', false, 50, null);
        $this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('SOFTDELETE', 'Softdelete', 'BOOLEAN', false, 1, null);
        $this->addColumn('RELATION', 'Relation', 'BOOLEAN', false, 1, null);
        $this->addColumn('SAVELOG', 'Savelog', 'BOOLEAN', false, 1, null);
        $this->addColumn('NESTEDSET', 'Nestedset', 'BOOLEAN', false, 1, null);
        $this->addForeignKey('SCOPEFIELDUNIQUENAME', 'Scopefielduniquename', 'VARCHAR', 'modules_entityField', 'UNIQUENAME', false, 100, null);
        $this->addColumn('BEHAVIORS', 'Behaviors', 'BLOB', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Module', 'Module', RelationMap::MANY_TO_ONE, array('moduleName' => 'name', ), null, null);
        $this->addRelation('ModuleEntityFieldRelatedByScopefielduniquename', 'ModuleEntityField', RelationMap::MANY_TO_ONE, array('scopeFieldUniqueName' => 'uniqueName', ), null, null);
        $this->addRelation('ModuleEntityFieldRelatedByEntityname', 'ModuleEntityField', RelationMap::ONE_TO_MANY, array('name' => 'entityName', ), 'CASCADE', null, 'ModuleEntityFieldsRelatedByEntityname');
        $this->addRelation('ModuleEntityFieldRelatedByForeignkeytable', 'ModuleEntityField', RelationMap::ONE_TO_MANY, array('name' => 'foreignKeyTable', ), 'SET NULL', null, 'ModuleEntityFieldsRelatedByForeignkeytable');
        $this->addRelation('AlertSubscription', 'AlertSubscription', RelationMap::ONE_TO_MANY, array('name' => 'entityName', ), 'CASCADE', null, 'AlertSubscriptions');
        $this->addRelation('ScheduleSubscription', 'ScheduleSubscription', RelationMap::ONE_TO_MANY, array('name' => 'entityName', ), 'CASCADE', null, 'ScheduleSubscriptions');
    } // buildRelations()

} // ModuleEntityTableMap
