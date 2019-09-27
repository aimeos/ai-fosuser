<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2018
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
	private $helper;


	/**
	 * Initializes the customer item object
	 *
	 * @param \Aimeos\MShop\Common\Item\Address\Iface $address Payment address item object
	 * @param array $values List of attributes that belong to the customer item
	 * @param \Aimeos\MShop\Common\Lists\Item\Iface[] $listItems List of list items
	 * @param \Aimeos\MShop\Common\Item\Iface[] $refItems List of referenced items
	 * @param \Aimeos\MShop\Common\Item\Address\Iface[] $addrItems List of referenced address items
	 * @param \Aimeos\MShop\Common\Item\Property\Iface[] $propItems List of property items
	 * @param \Aimeos\MShop\Common\Helper\Password\Iface|null $helper Password encryption helper object
	 * @param string|null $salt Password salt
	 */
	public function __construct( \Aimeos\MShop\Common\Item\Address\Iface $address, array $values = [],
		array $listItems = [], array $refItems = [], array $addrItems = [], array $propItems = [],
		\Aimeos\MShop\Common\Helper\Password\Iface $helper = null, $salt = null )
	{
		parent::__construct( $address, $values, $listItems, $refItems, $addrItems, $propItems, $helper, $salt );

		$this->helper = $helper;
	}


	/**
	 * Sets the password of the customer item.
	 *
	 * @param string $value Password of the customer item
	 * @return \Aimeos\MShop\Customer\Item\Iface Customer item for chaining method calls
	 */
	public function setPassword( $value )
	{
		if( (string) $value !== $this->getPassword() && $this->helper !== null ) {
			$value = $this->helper->encode( $value, $this->getSalt() );
		}

		return $this->set( 'customer.password', (string) $value );
	}


	/**
	 * Returns the associated user roles
	 *
	 * @return array List of Symfony roles
	 */
	public function getRoles()
	{
		return (array) $this->get( 'roles', [] );
	}


	/**
	 * Sets the associated user roles
	 *
	 * @param array $roles List of Symfony roles
	 */
	public function setRoles( array $roles )
	{
		return $this->set( 'roles', $roles );
	}


	/**
	 * Returns the password salt
	 *
	 * @return string Password salt
	 */
	public function getSalt()
	{
		return (string) $this->get( 'salt', '' );
	}


	/**
	 * Sets the password salt
	 *
	 * @param string $value Password salt
	 */
	public function setSalt( $value )
	{
		return $this->set( 'salt', (string) $value );
	}
}
