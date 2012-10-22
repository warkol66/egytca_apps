<?php



/**
 * This class defines the structure of the 'security_module' table.
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
class SecurityModuleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'security.classes.map.SecurityModuleTableMap';

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
        $this->setName('security_module');
        $this->setPhpName('SecurityModule');
        $this->setClassname('SecurityModule');
        $this->setPackage('security.classes');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('MODULE', 'Module', 'VARCHAR', true, 100, null);
        $this->addColumn('ACCESS', 'Access', 'INTEGER', false, null, null);
        $this->addColumn('ACCESSAFFILIATEUSER', 'Accessaffiliateuser', 'INTEGER', false, null, null);
        $this->addColumn('ACCESSREGISTRATIONUSER', 'Accessregistrationuser', 'INTEGER', false, null, null);
        $this->addColumn('ACCESSCLIENTUSER', 'Accessclientuser', 'INTEGER', false, null, null);
        $this->addColumn('NOCHECKLOGIN', 'Nochecklogin', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SecurityAction', 'SecurityAction', RelationMap::ONE_TO_MANY, array('module' => 'module', ), null, null, 'SecurityActions');
    } // buildRelations()

} // SecurityModuleTableMap
