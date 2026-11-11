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
	 * Sets the item values from the given array and removes that entries from the list
	 *
	 * @param array &$list Associative list of item keys and their values
	 * @param bool True to set private properties too, false for public only
	 * @return \Aimeos\MShop\Common\Item\Iface Customer item for chaining method calls
	 */
	public function fromArray( array &$list, bool $private = false ) : \Aimeos\MShop\Common\Item\Iface
	{
		// roles and salt must only be changed by setRoles() and setSalt(), never by passed data
		unset( $list['roles'], $list['salt'] );
		return parent::fromArray( $list, $private );
	}


	/**
	 * Returns the item values as array
	 *
	 * @param bool True to return private properties, false for public only
	 * @return array Associative list of item properties and their values
	 */
	public function toArray( bool $private = false ) : array
	{
		$list = parent::toArray( $private );
		unset( $list['salt'] );

		if( !$private ) {
			unset( $list['roles'] );
		}

		return $list;
	}


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
	 * Tests if the user is a super user
	 *
	 * @return bool TRUE if the user has the Symfony "ROLE_SUPER_ADMIN" role, FALSE if not
	 */
	public function isSuper() : bool
	{
		return parent::isSuper() || in_array( 'ROLE_SUPER_ADMIN', $this->getRoles(), true );
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
