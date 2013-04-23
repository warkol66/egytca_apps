<?php



/**
 * This class defines the structure of the 'calendar_event' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.calendar.classes.map
 */
class CalendarEventTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'calendar.classes.map.CalendarEventTableMap';

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
        $this->setName('calendar_event');
        $this->setPhpName('CalendarEvent');
        $this->setClassname('CalendarEvent');
        $this->setPackage('calendar.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('SUMMARY', 'Summary', 'LONGVARCHAR', false, null, null);
        $this->addColumn('BODY', 'Body', 'LONGVARCHAR', false, null, null);
        $this->addColumn('CREATIONDATE', 'Creationdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('STARTDATE', 'Startdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('ENDDATE', 'Enddate', 'TIMESTAMP', false, null, null);
        $this->addColumn('SOURCECONTACT', 'Sourcecontact', 'VARCHAR', false, 150, null);
        $this->addColumn('STATUS', 'Status', 'INTEGER', false, null, null);
        $this->addColumn('REGIONID', 'Regionid', 'INTEGER', false, null, null);
        $this->addForeignKey('CATEGORYID', 'Categoryid', 'INTEGER', 'categories_category', 'ID', false, null, null);
        $this->addForeignKey('USERID', 'Userid', 'INTEGER', 'users_user', 'ID', true, null, null);
        $this->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('userId' => 'id', ), null, null);
        $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('categoryId' => 'id', ), null, null);
        $this->addRelation('CalendarMedia', 'CalendarMedia', RelationMap::ONE_TO_MANY, array('id' => 'calendarEventId', ), null, null, 'CalendarMedias');
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
        );
    } // getBehaviors()

} // CalendarEventTableMap
