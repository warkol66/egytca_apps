<?php

class ChangesCountableBehavior extends Behavior
{
	// default parameters value
	protected $parameters = array(
		'changes_column' => 'changes'
	);
	
	/**
	 * Add the create_column and update_columns to the current table
	 */
	public function modifyTable()
	{
		if(!$this->getTable()->containsColumn($this->getParameter('changes_column'))) {
			$this->getTable()->addColumn(array(
				'name' => $this->getParameter('changes_column'),
				'type' => 'INTEGER'
			));
		}
	}
	
	protected function getColumnSetter()
	{
		return 'set' . $this->getColumnForParameter('changes_column')->getPhpName();
	}
	
	protected function getColumnConstant($builder)
	{
		return $builder->getColumnConstant($this->getColumnForParameter('changes_column'));
	}
	
	/**
	 * Add code in ObjectBuilder::preUpdate
	 *
	 * @return    string The code to put at the hook
	 */
	public function preUpdate($builder)
	{
		return "if (\$this->isModified() && !\$this->isColumnModified(" . $this->getColumnConstant($builder) . ")) {
	\$this->" . $this->getColumnSetter() . "(time());
}";
	}

	public function objectMethods($builder)
	{
		return "
/**
 * Mark the current object so that the changes doesn't get updated during next save
 *
 * @return     " . $builder->getStubObjectBuilder()->getClassname() . " The current object (for fluent API support)
 */
public function keepChangesUnchanged()
{
	\$this->modifiedColumns[] = " . $this->getColumnConstant($builder) . ";
	return \$this;
}
";
	}
	
}