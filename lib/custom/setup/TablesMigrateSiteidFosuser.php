<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Updates site ID columns
 */
class TablesMigrateSiteidFosuser extends TablesMigrateSiteid
{
	private $resources = [
		'db-customer' => [
			'fosuser_list_type', 'fosuser_property_type',
			'fosuser_property', 'fosuser_list', 'fosuser_address', 'fosuser',
		],
	];


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies() : array
	{
		return ['TablesMigrateSiteid'];
	}


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies() : array
	{
		return ['TablesCreateMShop'];
	}


	/**
	 * Executes the task
	 */
	public function migrate()
	{
		$this->msg( 'Update FOS user "siteid" columns', 0, '' );

		$this->process( $this->resources );
	}
}
