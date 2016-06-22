<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
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
	private $roles;


	/**
	 * Returns the associated user roles
	 *
	 * @return array List of Symfony roles
	 */
	public function getRoles()
	{
		if( isset( $this->roles ) ) {
			return $this->roles;
		}

		$values = $this->getRawValues();
		return ( isset( $values['roles'] ) ? (array) $values['roles'] : array() );
	}


	/**
	 * Sets the associated user roles
	 *
	 * @param array $roles List of Symfony roles
	 */
	public function setRoles( array $roles )
	{
		$this->roles = $roles;
		$this->setModified();
	}
}
