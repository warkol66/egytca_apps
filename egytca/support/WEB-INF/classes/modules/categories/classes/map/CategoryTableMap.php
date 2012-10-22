<?php



/**
 * This class defines the structure of the 'categories_category' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.categories.classes.map
 */
class CategoryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'categories.classes.map.CategoryTableMap';

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
        $this->setName('categories_category');
        $this->setPhpName('Category');
        $this->setClassname('Category');
        $this->setPackage('categories.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
        $this->getColumn('NAME', false)->setPrimaryString(true);
        $this->addColumn('MODULE', 'Module', 'VARCHAR', false, 255, '');
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, null);
        $this->addColumn('ISPUBLIC', 'Ispublic', 'BOOLEAN', true, 1, false);
        $this->addColumn('RESPONSIBLE', 'Responsible', 'VARCHAR', true, 255, null);
        $this->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('TREE_LEFT', 'TreeLeft', 'INTEGER', false, null, null);
        $this->addColumn('TREE_RIGHT', 'TreeRight', 'INTEGER', false, null, null);
        $this->addColumn('TREE_LEVEL', 'TreeLevel', 'INTEGER', false, null, null);
        $this->addColumn('SCOPE', 'Scope', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('GroupCategory', 'GroupCategory', RelationMap::ONE_TO_MANY, array('id' => 'categoryId', ), 'CASCADE', null, 'GroupCategorys');
        $this->addRelation('Group', 'Group', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Groups');
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
            'soft_delete' => array('deleted_column' => 'deleted_at', ),
            'nested_set' => array('left_column' => 'tree_left', 'right_column' => 'tree_right', 'level_column' => 'tree_level', 'use_scope' => 'true', 'scope_column' => 'scope', 'method_proxies' => 'false', ),
        );
    } // getBehaviors()

} // CategoryTableMap
