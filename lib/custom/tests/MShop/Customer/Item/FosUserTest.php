<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */


namespace Aimeos\MShop\Customer\Item;


/**
 * Test class for \Aimeos\MShop\Customer\Item\FosUser.
 */
class FosUserTest extends \PHPUnit_Framework_TestCase
{
	private $object;


	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 */
	protected function setUp()
	{
		$addressValues = array(
			'customer.address.parentid' => 'referenceid',
			'customer.address.position' => 1,
		);

		$address = new \Aimeos\MShop\Common\Item\Address\Standard( 'common.address.', $addressValues );

		$values = array(
			'customer.id' => 541,
			'customer.siteid' => 123,
			'customer.label' => 'unitObject',
			'customer.code' => '12345ABCDEF',
			'customer.birthday' => '2010-01-01',
			'customer.status' => 1,
			'customer.password' => '',
			'customer.vdate' => null,
			'customer.company' => 'unitCompany',
			'customer.vatid' => 'DE999999999',
			'customer.salutation' => \Aimeos\MShop\Common\Item\Address\Base::SALUTATION_MR,
			'customer.title' => 'Dr.',
			'customer.firstname' => 'firstunit',
			'customer.lastname' => 'lastunit',
			'customer.address1' => 'unit str.',
			'customer.address2' => ' 166',
			'customer.address3' => '4.OG',
			'customer.postal' => '22769',
			'customer.city' => 'Hamburg',
			'customer.state' => 'Hamburg',
			'customer.countryid' => 'de',
			'customer.languageid' => 'de',
			'customer.telephone' => '05554433221',
			'customer.email' => 'unit.test@example.com',
			'customer.telefax' => '05554433222',
			'customer.website' => 'www.example.com',
			'customer.mtime'=> '2010-01-05 00:00:05',
			'customer.ctime'=> '2010-01-01 00:00:00',
			'customer.editor' => 'unitTestUser',
			'roles' => array( 'ROLE_ADMIN' ),
		);

		$this->object = new \Aimeos\MShop\Customer\Item\FosUser( $address, $values, array(), array(), 'mshop', null );
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 */
	protected function tearDown()
	{
		unset( $this->object );
	}

	public function testGetRoles()
	{
		$this->assertEquals( array( 'ROLE_ADMIN' ), $this->object->getRoles() );
	}

	public function testSetRoles()
	{
		$this->object->setRoles( array( 'ROLE_USER' ) );
		$this->assertTrue( $this->object->isModified() );
		$this->assertEquals( array( 'ROLE_USER' ), $this->object->getRoles() );
	}

	public function testIsModified()
	{
		$this->assertFalse( $this->object->isModified() );
	}
}
