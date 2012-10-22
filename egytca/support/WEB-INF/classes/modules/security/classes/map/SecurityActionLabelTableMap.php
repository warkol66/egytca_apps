<?php



/**
 * This class defines the structure of the 'security_actionLabel' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.security.classes.map
 */
class SecurityActionLabelTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'security.classes.map.SecurityActionLabelTableMap';

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
        $this->setName('security_actionLabel');
        $this->setPhpName('SecurityActionLabel');
        $this->setClassname('SecurityActionLabel');
        $this->setPackage('security.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addPrimaryKey('ACTION', 'Action', 'VARCHAR', true, 100, null);
        $this->addColumn('LANGUAGE', 'Language', 'VARCHAR', false, 100, null);
        $this->addColumn('LABEL', 'Label', 'VARCHAR', false, 100, null);
        $this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // SecurityActionLabelTableMap
