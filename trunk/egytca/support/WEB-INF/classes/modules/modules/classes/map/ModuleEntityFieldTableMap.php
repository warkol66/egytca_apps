<?php



/**
 * This class defines the structure of the 'modules_entityField' table.
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
class ModuleEntityFieldTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'modules.classes.map.ModuleEntityFieldTableMap';

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
        $this->setName('modules_entityField');
        $this->setPhpName('ModuleEntityField');
        $this->setClassname('ModuleEntityField');
        $this->setPackage('modules.classes');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('UNIQUENAME', 'Uniquename', 'VARCHAR', true, 100, null);
        $this->addForeignKey('ENTITYNAME', 'Entityname', 'VARCHAR', 'modules_entity', 'NAME', true, 50, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 50, null);
        $this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('ISREQUIRED', 'Isrequired', 'BOOLEAN', false, 1, null);
        $this->addColumn('DEFAULTVALUE', 'Defaultvalue', 'VARCHAR', false, 255, null);
        $this->addColumn('ISPRIMARYKEY', 'Isprimarykey', 'BOOLEAN', false, 1, null);
        $this->addColumn('ISAUTOINCREMENT', 'Isautoincrement', 'BOOLEAN', false, 1, null);
        $this->addColumn('ORDER', 'Order', 'INTEGER', true, null, null);
        $this->addColumn('TYPE', 'Type', 'INTEGER', true, null, null);
        $this->addColumn('UNIQUE', 'Unique', 'BOOLEAN', false, 1, null);
        $this->addColumn('SIZE', 'Size', 'INTEGER', false, null, null);
        $this->addColumn('AGGREGATEEXPRESSION', 'Aggregateexpression', 'VARCHAR', false, 255, null);
        $this->addColumn('LABEL', 'Label', 'VARCHAR', false, 255, null);
        $this->addColumn('FORMFIELDTYPE', 'Formfieldtype', 'INTEGER', false, null, null);
        $this->addColumn('FORMFIELDSIZE', 'Formfieldsize', 'INTEGER', false, null, null);
        $this->addColumn('FORMFIELDLINES', 'Formfieldlines', 'INTEGER', false, null, null);
        $this->addColumn('FORMFIELDUSECALENDAR', 'Formfieldusecalendar', 'VARCHAR', false, null, null);
        $this->addForeignKey('FOREIGNKEYTABLE', 'Foreignkeytable', 'VARCHAR', 'modules_entity', 'NAME', false, 50, null);
        $this->addForeignKey('FOREIGNKEYREMOTE', 'Foreignkeyremote', 'VARCHAR', 'modules_entityField', 'UNIQUENAME', false, 100, null);
        $this->addColumn('ONDELETE', 'Ondelete', 'VARCHAR', false, 30, null);
        $this->addColumn('AUTOMATIC', 'Automatic', 'BOOLEAN', false, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ModuleEntityRelatedByEntityname', 'ModuleEntity', RelationMap::MANY_TO_ONE, array('entityName' => 'name', ), 'CASCADE', null);
        $this->addRelation('ModuleEntityRelatedByForeignkeytable', 'ModuleEntity', RelationMap::MANY_TO_ONE, array('foreignKeyTable' => 'name', ), 'SET NULL', null);
        $this->addRelation('ModuleEntityFieldRelatedByForeignkeyremote', 'ModuleEntityField', RelationMap::MANY_TO_ONE, array('foreignKeyRemote' => 'uniqueName', ), 'SET NULL', null);
        $this->addRelation('ModuleEntityRelatedByScopefielduniquename', 'ModuleEntity', RelationMap::ONE_TO_MANY, array('uniqueName' => 'scopeFieldUniqueName', ), null, null, 'ModuleEntitysRelatedByScopefielduniquename');
        $this->addRelation('ModuleEntityFieldRelatedByUniquename', 'ModuleEntityField', RelationMap::ONE_TO_MANY, array('uniqueName' => 'foreignKeyRemote', ), 'SET NULL', null, 'ModuleEntityFieldsRelatedByUniquename');
        $this->addRelation('ModuleEntityFieldValidation', 'ModuleEntityFieldValidation', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityFieldUniqueName', ), 'CASCADE', null, 'ModuleEntityFieldValidations');
        $this->addRelation('AlertSubscriptionRelatedByEntitynamefielduniquename', 'AlertSubscription', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityNameFieldUniqueName', ), 'CASCADE', null, 'AlertSubscriptionsRelatedByEntitynamefielduniquename');
        $this->addRelation('AlertSubscriptionRelatedByEntitydatefielduniquename', 'AlertSubscription', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityDateFieldUniqueName', ), 'CASCADE', null, 'AlertSubscriptionsRelatedByEntitydatefielduniquename');
        $this->addRelation('AlertSubscriptionRelatedByEntitybooleanfielduniquename', 'AlertSubscription', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityBooleanFieldUniqueName', ), 'CASCADE', null, 'AlertSubscriptionsRelatedByEntitybooleanfielduniquename');
        $this->addRelation('ScheduleSubscriptionRelatedByEntitynamefielduniquename', 'ScheduleSubscription', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityNameFieldUniqueName', ), 'CASCADE', null, 'ScheduleSubscriptionsRelatedByEntitynamefielduniquename');
        $this->addRelation('ScheduleSubscriptionRelatedByEntitydatefielduniquename', 'ScheduleSubscription', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityDateFieldUniqueName', ), 'CASCADE', null, 'ScheduleSubscriptionsRelatedByEntitydatefielduniquename');
        $this->addRelation('ScheduleSubscriptionRelatedByEntitybooleanfielduniquename', 'ScheduleSubscription', RelationMap::ONE_TO_MANY, array('uniqueName' => 'entityBooleanFieldUniqueName', ), 'CASCADE', null, 'ScheduleSubscriptionsRelatedByEntitybooleanfielduniquename');
    } // buildRelations()

} // ModuleEntityFieldTableMap
