<?php



/**
 * This class defines the structure of the 'users_user' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'users.classes.map.UserTableMap';

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
        $this->setName('users_user');
        $this->setPhpName('User');
        $this->setClassname('User');
        $this->setPackage('users.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 255, null);
        $this->getColumn('USERNAME', false)->setPrimaryString(true);
        $this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('PASSWORDUPDATED', 'Passwordupdated', 'DATE', false, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', false, 90, null);
        $this->addColumn('SURNAME', 'Surname', 'VARCHAR', false, 90, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, null);
        $this->addForeignKey('LEVELID', 'Levelid', 'INTEGER', 'users_level', 'ID', false, null, null);
        $this->addColumn('LASTLOGIN', 'Lastlogin', 'TIMESTAMP', false, null, null);
        $this->addColumn('TIMEZONE', 'Timezone', 'VARCHAR', false, 25, null);
        $this->addColumn('RECOVERYHASH', 'Recoveryhash', 'VARCHAR', false, 255, null);
        $this->addColumn('RECOVERYHASHCREATEDON', 'Recoveryhashcreatedon', 'TIMESTAMP', false, null, null);
        $this->addColumn('MAILADDRESS', 'Mailaddress', 'VARCHAR', false, 90, null);
        $this->addColumn('MAILADDRESSALT', 'Mailaddressalt', 'VARCHAR', false, 90, null);
        $this->addColumn('SESSION', 'Session', 'VARCHAR', false, 90, null);
        $this->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Level', 'Level', RelationMap::MANY_TO_ONE, array('levelId' => 'id', ), null, null);
        $this->addRelation('AlertSubscriptionUser', 'AlertSubscriptionUser', RelationMap::ONE_TO_MANY, array('id' => 'userId', ), 'CASCADE', null, 'AlertSubscriptionUsers');
        $this->addRelation('ScheduleSubscriptionUser', 'ScheduleSubscriptionUser', RelationMap::ONE_TO_MANY, array('id' => 'userId', ), 'CASCADE', null, 'ScheduleSubscriptionUsers');
        $this->addRelation('UserGroup', 'UserGroup', RelationMap::ONE_TO_MANY, array('id' => 'userId', ), 'CASCADE', null, 'UserGroups');
        $this->addRelation('AlertSubscription', 'AlertSubscription', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'AlertSubscriptions');
        $this->addRelation('ScheduleSubscription', 'ScheduleSubscription', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'ScheduleSubscriptions');
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
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

} // UserTableMap
