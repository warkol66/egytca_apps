<?php



/**
 * This class defines the structure of the 'MER_graphModel' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.mer.classes.map
 */
class GraphModelTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.GraphModelTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('MER_graphModel');
		$this->setPhpName('GraphModel');
		$this->setClassname('GraphModel');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addColumn('TYPE', 'Type', 'VARCHAR', false, 30, null);
		$this->addColumn('ACTORS', 'Actors', 'INTEGER', true, null, null);
		$this->addColumn('LABELX', 'Labelx', 'VARCHAR', false, 100, null);
		$this->addColumn('LABELY', 'Labely', 'VARCHAR', false, 100, null);
		$this->addColumn('LABELZ', 'Labelz', 'VARCHAR', false, 100, null);
		$this->addColumn('TYPEX', 'Typex', 'INTEGER', false, null, null);
		$this->addColumn('TYPEY', 'Typey', 'INTEGER', false, null, null);
		$this->addColumn('TYPEZ', 'Typez', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('GraphModelAxis', 'GraphModelAxis', RelationMap::ONE_TO_MANY, array('id' => 'graphId', ), 'CASCADE', null);
    $this->addRelation('GraphModelJudgement', 'GraphModelJudgement', RelationMap::ONE_TO_MANY, array('id' => 'graphId', ), 'CASCADE', null);
    $this->addRelation('GraphActor', 'GraphActor', RelationMap::ONE_TO_MANY, array('id' => 'graphId', ), 'CASCADE', null);
    $this->addRelation('GraphCategory', 'GraphCategory', RelationMap::ONE_TO_MANY, array('id' => 'graphId', ), 'CASCADE', null);
	} // buildRelations()

} // GraphModelTableMap
