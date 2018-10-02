<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014-2018
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds customer list test data.
 */
class CustomerListAddFosUserTestData
	extends \Aimeos\MW\Setup\Task\CustomerListAddTestData
{
	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function getPreDependencies()
	{
		return array( 'TablesCreateFosUser', 'CustomerAddFosUserTestData', 'LocaleAddTestData', 'TextAddTestData' );
	}


	/**
	 * Adds attribute test data.
	 */
	public function migrate()
	{
		\Aimeos\MW\Common\Base::checkClass( '\\Aimeos\\MShop\\Context\\Item\\Iface', $this->additional );

		$this->msg( 'Adding customer-list Fos user bundle test data', 0 );
		$this->additional->setEditor( 'ai-fosuser:unittest' );

		$ds = DIRECTORY_SEPARATOR;
		$path = dirname( __FILE__ ) . $ds . 'data' . $ds . 'customer-list.php';

		if( ( $testdata = include( $path ) ) === false ){
			throw new \Aimeos\MShop\Exception( sprintf( 'No file "%1$s" found for customer list domain', $path ) );
		}

		$refKeys = [];
		foreach( $testdata['customer/lists'] as $dataset ) {
			$refKeys[ $dataset['domain'] ][] = $dataset['refid'];
		}

		$refIds = [];
		$refIds['text'] = $this->getTextData( $refKeys['text'] );
		$this->addCustomerListData( $testdata, $refIds, 'FosUser' );

		$this->status( 'done' );
	}
}
