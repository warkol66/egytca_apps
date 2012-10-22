<?php



/**
 * This class defines the structure of the 'modules_module' table.
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
class ModuleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'modules.classes.map.ModuleTableMap';

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
        $this->setName('modules_module');
        $this->setPhpName('Module');
        $this->setClassname('Module');
        $this->setPackage('modules.classes');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('NAME', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, false);
        $this->addColumn('ALWAYSACTIVE', 'Alwaysactive', 'BOOLEAN', true, 1, false);
        $this->addColumn('HASCATEGORIES', 'Hascategories', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ModuleDependency', 'ModuleDependency', RelationMap::ONE_TO_MANY, array('name' => 'moduleName', ), 'CASCADE', null, 'ModuleDependencys');
        $this->addRelation('ModuleLabel', 'ModuleLabel', RelationMap::ONE_TO_MANY, array('name' => 'name', ), 'CASCADE', null, 'ModuleLabels');
        $this->addRelation('ModuleEntity', 'ModuleEntity', RelationMap::ONE_TO_MANY, array('name' => 'moduleName', ), null, null, 'ModuleEntitys');
        $this->addRelation('MultilangText', 'MultilangText', RelationMap::ONE_TO_MANY, array('name' => 'moduleName', ), null, null, 'MultilangTexts');
    } // buildRelations()

} // ModuleTableMap
