<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2025
 * @package MShop
 * @subpackage Customer
 */


namespace Aimeos\MShop\Customer\Item;


/**
 * Customer DTO object for the FosUserBundle.
 *
 * @package MShop
 * @subpackage Customer
 */
class FosUser extends Standard implements Iface
{
	/**
	 * Returns the associated user roles
	 *
	 * @return array List of Symfony roles
	 */
	public function getRoles() : array
	{
		return $this->get( 'roles', [] );
	}


	/**
	 * Sets the associated user roles
	 *
	 * @param array $roles List of Symfony roles
	 * @return \Aimeos\MShop\Customer\Item\Iface Customer item for chaining method calls
	 */
	public function setRoles( array $roles ) : \Aimeos\MShop\Customer\Item\Iface
	{
		return $this->set( 'roles', $roles );
	}


	/**
	 * Returns the password salt
	 *
	 * @return string Password salt
	 * @deprecated 2025.01 Not used for password hashing anymore
	 */
	public function getSalt() : string
	{
		return $this->get( 'salt', '' );
	}


	/**
	 * Sets the password salt
	 *
	 * @param string $value Password salt
	 * @return \Aimeos\MShop\Customer\Item\Iface Customer item for chaining method calls
	 * @deprecated 2025.01 Not used for password hashing anymore
	 */
	public function setSalt( string $value ) : \Aimeos\MShop\Customer\Item\Iface
	{
		return $this->set( 'salt', $value );
	}
}
