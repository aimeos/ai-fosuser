<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019-2021
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Updates key columns
 */
class CustomerMigrateListsKeyFosuser extends TablesMigrateListsKey
{
	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies() : array
	{
		return ['TablesMigrateListsKey'];
	}


	/**
	 * Executes the task
	 */
	public function migrate()
	{
		$this->msg( 'Update FOS user lists "key" columns', 0 ); $this->status( '' );

		$this->process( ['db-customer' => 'fos_user_list'] );
	}
}
