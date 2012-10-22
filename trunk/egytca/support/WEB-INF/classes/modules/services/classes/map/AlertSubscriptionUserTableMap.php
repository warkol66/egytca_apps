<?php



/**
 * This class defines the structure of the 'services_alertSubscriptionUser' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.services.classes.map
 */
class AlertSubscriptionUserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'services.classes.map.AlertSubscriptionUserTableMap';

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
        $this->setName('services_alertSubscriptionUser');
        $this->setPhpName('AlertSubscriptionUser');
        $this->setClassname('AlertSubscriptionUser');
        $this->setPackage('services.classes');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('ALERTSUBSCRIPTIONID', 'Alertsubscriptionid', 'INTEGER' , 'services_alertSubscription', 'ID', true, null, null);
        $this->addForeignPrimaryKey('USERID', 'Userid', 'INTEGER' , 'users_user', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('AlertSubscription', 'AlertSubscription', RelationMap::MANY_TO_ONE, array('alertSubscriptionId' => 'id', ), 'CASCADE', null);
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('userId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // AlertSubscriptionUserTableMap
