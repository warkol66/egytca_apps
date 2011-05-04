<?php



/**
 * This class defines the structure of the 'MER_formSectionQuestionOption' table.
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
class QuestionOptionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.QuestionOptionTableMap';

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
		$this->setName('MER_formSectionQuestionOption');
		$this->setPhpName('QuestionOption');
		$this->setClassname('QuestionOption');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('QUESTIONID', 'Questionid', 'INTEGER' , 'MER_formSectionQuestion', 'ID', true, null, null);
		$this->addPrimaryKey('POSITION', 'Position', 'INTEGER', true, null, null);
		$this->addColumn('VALUE', 'Value', 'VARCHAR', true, 255, null);
		$this->addColumn('TEXT', 'Text', 'VARCHAR', true, 255, null);
		$this->addColumn('DEFAULTOPC', 'Defaultopc', 'BOOLEAN', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Question', 'Question', RelationMap::MANY_TO_ONE, array('questionId' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // QuestionOptionTableMap
