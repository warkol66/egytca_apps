<?php



/**
 * This class defines the structure of the 'affiliates_userGroup' table.
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
class AffiliateUserGroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'affiliates.classes.map.AffiliateUserGroupTableMap';

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
        $this->setName('affiliates_userGroup');
        $this->setPhpName('AffiliateUserGroup');
        $this->setClassname('AffiliateUserGroup');
        $this->setPackage('affiliates.classes');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('USERID', 'Userid', 'INTEGER' , 'affiliates_user', 'ID', true, null, null);
        $this->addForeignPrimaryKey('GROUPID', 'Groupid', 'INTEGER' , 'affiliates_group', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('AffiliateUser', 'AffiliateUser', RelationMap::MANY_TO_ONE, array('userId' => 'id', ), null, null);
        $this->addRelation('AffiliateGroup', 'AffiliateGroup', RelationMap::MANY_TO_ONE, array('groupId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // AffiliateUserGroupTableMap
