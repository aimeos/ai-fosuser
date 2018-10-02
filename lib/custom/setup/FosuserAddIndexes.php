<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2018
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Migrate the database schema
 */
class FosuserAddIndexes extends \Aimeos\MW\Setup\Task\Base
{
	private $list = array(
		// done by Doctrine schema update
	);


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies()
	{
		return [];
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return array List of task names
	 */
	public function getPostDependencies()
	{
		return array( 'TablesCreateFosUser' );
	}


	/**
	 * Update database schema
	 */
	public function migrate()
	{
		$this->msg( 'Adding indexes from "fos_user"', 0 ); $this->status( '' );

		$schema = $this->getSchema( 'db-customer' );

		foreach( $this->list as $idx => $stmt )
		{
			$this->msg( sprintf( 'Checking index "%1$s"', $idx ), 0 );

			if( $schema->tableExists( 'fos_user' ) === true
				&& $schema->indexExists( 'fos_user', $idx ) === false )
			{
				$this->execute( $stmt );
				$this->status( 'done' );
			}
			else
			{
				$this->status( 'OK' );
			}
		}
	}
}
