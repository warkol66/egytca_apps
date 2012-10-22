<?php



/**
 * This class defines the structure of the 'requirements_attendant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.requirements.classes.map
 */
class AttendantTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'requirements.classes.map.AttendantTableMap';

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
        $this->setName('requirements_attendant');
        $this->setPhpName('Attendant');
        $this->setClassname('Attendant');
        $this->setPackage('requirements.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ENTITYTYPE', 'Entitytype', 'VARCHAR', true, 255, null);
        $this->addColumn('ENTITYID', 'Entityid', 'INTEGER', true, null, null);
        $this->addForeignKey('ATTENDANTID', 'Attendantid', 'INTEGER', 'resources_resource', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Resource', 'Resource', RelationMap::MANY_TO_ONE, array('attendantId' => 'id', ), null, null);
    } // buildRelations()

} // AttendantTableMap
