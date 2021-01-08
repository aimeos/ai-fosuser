<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018-2021
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Removes address and list records without user entry
 */
class CustomerRemoveLostUserDataFosuser extends \Aimeos\MW\Setup\Task\Base
{
	private $sql = [
		'fos_user_address' => [
			'fk_fosad_pid' => 'DELETE FROM "fos_user_address" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )'
		],
		'fos_user_list' => [
			'fk_fosli_pid' => 'DELETE FROM "fos_user_list" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )'
		],
		'fos_user_property' => [
			'fk_fospr_pid' => 'DELETE FROM "fos_user_property" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )'
		],
	];


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies() : array
	{
		return ['TablesCreateMShop'];
	}


	/**
	 * Migrate database schema
	 */
	public function migrate()
	{
		$this->msg( 'Remove left over FOS user references', 0, '' );

		$schema = $this->getSchema( 'db-customer' );

		foreach( $this->sql as $table => $map )
		{
			foreach( $map as $constraint => $sql )
			{
				$this->msg( sprintf( 'Remove records from %1$s', $table ), 1 );

				if( $schema->tableExists( 'fe_users' ) && $schema->tableExists( $table )
					&& $schema->constraintExists( $table, $constraint ) === false
				) {
					$this->execute( $sql, 'db-customer' );
					$this->status( 'done' );
				}
				else
				{
					$this->status( 'OK' );
				}
			}
		}
	}
}
