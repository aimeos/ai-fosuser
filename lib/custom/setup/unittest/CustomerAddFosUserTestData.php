<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014-2018
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds FOS user customer test data.
 */
class CustomerAddFosUserTestData extends \Aimeos\MW\Setup\Task\CustomerAddTestData
{
	/**
	 * Adds customer test data
	 */
	public function migrate()
	{
		\Aimeos\MW\Common\Base::checkClass( \Aimeos\MShop\Context\Item\Iface::class, $this->additional );

		$this->msg( 'Adding Fos user bundle customer test data', 0 );

		$this->additional->setEditor( 'ai-fosuser:unittest' );
		$this->process( __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'customer.php' );

		$this->status( 'done' );
	}


	/**
	 * Returns the manager for the current setup task
	 *
	 * @return \Aimeos\MShop\Common\Manager\Iface Manager object
	 */
	protected function getManager()
	{
		return \Aimeos\MShop\Customer\Manager\Factory::create( $this->additional, 'FosUser' );
	}
}
