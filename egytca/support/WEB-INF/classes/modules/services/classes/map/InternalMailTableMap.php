<?php



/**
 * This class defines the structure of the 'services_internalMail' table.
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
class InternalMailTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'services.classes.map.InternalMailTableMap';

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
        $this->setName('services_internalMail');
        $this->setPhpName('InternalMail');
        $this->setClassname('InternalMail');
        $this->setPackage('services.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('SUBJECT', 'Subject', 'VARCHAR', false, 255, null);
        $this->addColumn('BODY', 'Body', 'LONGVARCHAR', false, null, null);
        $this->addColumn('RECIPIENTID', 'Recipientid', 'INTEGER', false, null, null);
        $this->addColumn('RECIPIENTTYPE', 'Recipienttype', 'VARCHAR', false, 50, null);
        $this->addColumn('READON', 'Readon', 'TIMESTAMP', false, null, null);
        $this->addColumn('FROMID', 'Fromid', 'INTEGER', false, null, null);
        $this->addColumn('FROMTYPE', 'Fromtype', 'VARCHAR', false, 50, null);
        $this->addColumn('TO', 'To', 'BLOB', false, null, null);
        $this->addForeignKey('REPLYID', 'Replyid', 'INTEGER', 'services_internalMail', 'ID', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('InternalMailRelatedByReplyid', 'InternalMail', RelationMap::MANY_TO_ONE, array('replyId' => 'id', ), null, null);
        $this->addRelation('InternalMailRelatedById', 'InternalMail', RelationMap::ONE_TO_MANY, array('id' => 'replyId', ), null, null, 'InternalMailsRelatedById');
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
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_updated_at' => 'false', ),
            'soft_delete' => array('deleted_column' => 'deleted_at', ),
        );
    } // getBehaviors()

} // InternalMailTableMap
