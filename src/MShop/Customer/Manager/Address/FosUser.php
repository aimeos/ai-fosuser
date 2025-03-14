<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2025
 * @package MShop
 * @subpackage Customer
 */


namespace Aimeos\MShop\Customer\Manager\Address;


/**
 * Fos user bundle implementation of the customer address class.
 *
 * @package MShop
 * @subpackage Customer
 */
class FosUser
	extends \Aimeos\MShop\Customer\Manager\Address\Standard
{
	/**
	 * Returns the attributes that can be used for searching.
	 *
	 * @param bool $withsub Return also attributes of sub-managers if true
	 * @return \Aimeos\Base\Criteria\Attribute\Iface[] List of search attribute items
	 */
	public function getSearchAttributes( bool $withsub = true ) : array
	{
		return array_replace( parent::getSearchAttributes( $withsub ), $this->createAttributes( [
			'customer.address.id' => [
				'label' => 'Customer address ID',
				'internalcode' => 'id',
				'internaldeps' => ['LEFT JOIN "fos_user_address" AS mcusad ON ( mcus."id" = mcusad."parentid" )'],
				'type' => 'int',
				'public' => false,
			]
		] ) );
	}


	/**
	 * Returns the name of the used table
	 *
	 * @return string Table name
	 */
	protected function table() : string
	{
		return 'fos_user_address';
	}
}
