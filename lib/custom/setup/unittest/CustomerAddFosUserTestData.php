<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014-2016
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds FOS user customer test data.
 */
class CustomerAddFosUserTestData extends \Aimeos\MW\Setup\Task\CustomerAddTestData
{
	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies()
	{
		return array( 'TablesCreateFosUser' );
	}


	/**
	 * Adds attribute test data.
	 */
	public function migrate()
	{
		$iface = '\\Aimeos\\MShop\\Context\\Item\\Iface';
		if( !( $this->additional instanceof $iface ) ) {
			throw new \Aimeos\MW\Setup\Exception( sprintf( 'Additionally provided object is not of type "%1$s"', $iface ) );
		}

		$this->msg( 'Adding Fos user bundle customer test data', 0 );

		$parentIds = [];
		$ds = DIRECTORY_SEPARATOR;
		$this->additional->setEditor( 'ai-fosuser:unittest' );
		$path = __DIR__ . $ds . 'data' . $ds . 'customer.php';

		if( ( $testdata = include( $path ) ) === false ){
			throw new \Aimeos\MShop\Exception( sprintf( 'No file "%1$s" found for customer domain', $path ) );
		}


		$customerManager = \Aimeos\MShop\Customer\Manager\Factory::createManager( $this->additional, 'FosUser' );
		$customerAddressManager = $customerManager->getSubManager( 'address', 'FosUser' );

		$search = $customerManager->createSearch();
		$search->setConditions( $search->compare( '==', 'customer.code', array( 'UTC001', 'UTC002', 'UTC003' ) ) );
		$items = $customerManager->searchItems( $search );

		$this->conn->begin();

		$customerManager->deleteItems( array_keys( $items ) );
		$parentIds = $this->addCustomerData( $testdata, $customerManager, $customerAddressManager->createItem() );
		$this->addCustomerAddressData( $testdata, $customerAddressManager, $parentIds );

		$this->conn->commit();


		$this->status( 'done' );
	}
}
