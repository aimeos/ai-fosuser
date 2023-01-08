<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014-2023
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds FOS user customer test data.
 */
class CustomerAddFosUserTestData extends \Aimeos\MW\Setup\Task\CustomerAddTestData
{
	/**
	 * Returns the list of task names which this task depends on
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies() : array
	{
		return ['ProductAddTestData'];
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies() : array
	{
		return ['CustomerAddTestData'];
	}


	/**
	 * Adds customer test data
	 */
	public function migrate()
	{
		\Aimeos\MW\Common\Base::checkClass( \Aimeos\MShop\Context\Item\Iface::class, $this->additional );

		$this->msg( 'Adding FosUser customer test data', 0 );

		$dbm = $this->additional->getDatabaseManager();
		$conn = $dbm->acquire( 'db-customer' );
		$conn->create( 'DELETE FROM "fos_user" WHERE "email" LIKE \'test%@example.com\'' )->execute()->finish();
		$dbm->release( $conn, 'db-customer' );

		$this->additional->setEditor( 'ai-fosuser:lib/custom' );
		$this->process( __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'customer.php' );

		$this->status( 'done' );
	}


	/**
	 * Returns the manager for the current setup task
	 *
	 * @param string $domain Domain name of the manager
	 * @return \Aimeos\MShop\Common\Manager\Iface Manager object
	 */
	protected function getManager( $domain )
	{
		if( $domain === 'customer' ) {
			return \Aimeos\MShop\Customer\Manager\Factory::create( $this->additional, 'FosUser' );
		}

		return parent::getManager( $domain );
	}
}
