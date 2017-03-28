<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
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
class FosUser
	extends \Aimeos\MShop\Customer\Item\Standard
{
	private $values;
	private $helper;


	/**
	 * Initializes the customer item object
	 *
	 * @param \Aimeos\MShop\Common\Item\Address\Iface $address Payment address item object
	 * @param array $values List of attributes that belong to the customer item
	 * @param \Aimeos\MShop\Common\Lists\Item\Iface[] $listItems List of list items
	 * @param \Aimeos\MShop\Common\Item\Iface[] $refItems List of referenced items
	 * @param \Aimeos\MShop\Common\Item\Helper\Password\Iface|null $helper Password encryption helper object
	 */
	public function __construct( \Aimeos\MShop\Common\Item\Address\Iface $address, array $values = [], array $listItems = [],
		array $refItems = [], $salt = '', \Aimeos\MShop\Common\Item\Helper\Password\Iface $helper = null, array $addresses = [] )
	{
		parent::__construct( $address, $values, $listItems, $refItems, $salt, $helper, $addresses );

		$this->values = $values;
		$this->helper = $helper;
	}



	/**
	 * Returns the password of the customer item.
	 *
	 * @return string Password string
	 */
	public function getPassword()
	{
		if( isset( $this->values['customer.password'] ) ) {
			return (string) $this->values['customer.password'];
		}

		return '';
	}


	/**
	 * Sets the password of the customer item.
	 *
	 * @param string $value Password of the customer item
	 * @return \Aimeos\MShop\Customer\Item\Iface Customer item for chaining method calls
	 */
	public function setPassword( $value )
	{
		if( $value == $this->getPassword() ) { return $this; }

		if( $this->helper !== null ) {
			$value = $this->helper->encode( $value, $this->getSalt() );
		}

		$this->values['customer.password'] = (string) $value;
		$this->setModified();

		return $this;
	}


	/**
	 * Returns the associated user roles
	 *
	 * @return array List of Symfony roles
	 */
	public function getRoles()
	{
		if( isset( $this->values['roles'] ) ) {
			return (array) $this->values['roles'];
		}

		return [];
	}


	/**
	 * Sets the associated user roles
	 *
	 * @param array $roles List of Symfony roles
	 */
	public function setRoles( array $roles )
	{
		$this->values['roles'] = $roles;
		$this->setModified();

		return $this;
	}


	/**
	 * Returns the password salt
	 *
	 * @return string Password salt
	 */
	public function getSalt()
	{
		if( isset( $this->values['salt'] ) ) {
			return $this->values['salt'];
		}

		return 'mshop';
	}


	/**
	 * Sets the password salt
	 *
	 * @param string $value Password salt
	 */
	public function setSalt( $value )
	{
		$this->values['salt'] = (string) $value;
		$this->setModified();

		return $this;
	}
}
