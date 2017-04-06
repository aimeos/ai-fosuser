<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Migrate the database schema
 */
class FosuserAddIndexes extends \Aimeos\MW\Setup\Task\Base
{
	private $list = array(
		'idx_fosus_langid' => 'CREATE INDEX "idx_fosus_langid" ON "fos_user" ("langid")',
		'idx_fosus_enabled_ln_fn' => 'CREATE INDEX "idx_fosus_enabled_ln_fn" ON "fos_user" ("enabled", "lastname", "firstname")',
		'idx_fosus_enabled_ad1_ad2' => 'CREATE INDEX "idx_fosus_enabled_ad1_ad2" ON "fos_user" ("enabled", "address1", "address2")',
		'idx_fosus_enabled_postal_city' => 'CREATE INDEX "idx_fosus_enabled_postal_city" ON "fos_user" ("enabled", "postal", "city")',
		'idx_fosus_lastname' => 'CREATE INDEX "idx_fosus_lastname" ON "fos_user" ("lastname")',
		'idx_fosus_address1' => 'CREATE INDEX "idx_fosus_address1" ON "fos_user" ("address1")',
		'idx_fosus_postal' => 'CREATE INDEX "idx_fosus_postal" ON "fos_user" ("postal")',
		'idx_fosus_city' => 'CREATE INDEX "idx_fosus_city" ON "fos_user" ("city")',
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
