<?php



/**
 * This class defines the structure of the 'users_groupCategory' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.users.classes.map
 */
class GroupCategoryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'users.classes.map.GroupCategoryTableMap';

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
        $this->setName('users_groupCategory');
        $this->setPhpName('GroupCategory');
        $this->setClassname('GroupCategory');
        $this->setPackage('users.classes');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('GROUPID', 'Groupid', 'INTEGER' , 'users_group', 'ID', true, null, null);
        $this->addForeignPrimaryKey('CATEGORYID', 'Categoryid', 'INTEGER' , 'categories_category', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', 'Group', RelationMap::MANY_TO_ONE, array('groupId' => 'id', ), 'CASCADE', null);
        $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('categoryId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // GroupCategoryTableMap
