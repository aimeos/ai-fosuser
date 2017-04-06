<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 */


namespace Aimeos\MShop\Customer\Item;


class FosUserTest extends \PHPUnit_Framework_TestCase
{
	private $address;
	private $object;


	protected function setUp()
	{
		$addressValues = array(
			'customer.address.parentid' => 'referenceid',
			'customer.address.position' => 1,
		);

		$this->address = new \Aimeos\MShop\Common\Item\Address\Standard( 'common.address.', $addressValues );

		$values = array(
			'customer.id' => 541,
			'customer.siteid' => 123,
			'customer.label' => 'unitObject',
			'customer.code' => '12345ABCDEF',
			'customer.birthday' => '2010-01-01',
			'customer.status' => 1,
			'customer.password' => 'testpwd',
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
			'salt' => 'test',
		);

		$this->object = new \Aimeos\MShop\Customer\Item\FosUser( $this->address, $values );
	}

	protected function tearDown()
	{
		unset( $this->object );
	}

	public function testGetPassword()
	{
		$this->assertEquals( 'testpwd', $this->object->getPassword() );
	}

	public function testSetPassword()
	{
		$this->object->setPassword( 'new' );
		$this->assertTrue( $this->object->isModified() );
		$this->assertEquals( 'new', $this->object->getPassword() );
	}

	public function testSetPasswordGenerated()
	{
		$helper = new \Aimeos\MShop\Common\Item\Helper\Password\Standard( array( 'format' => '%1$s{%2$s}' ) );
		$object = new \Aimeos\MShop\Customer\Item\FosUser( $this->address, [], [], [], null, $helper );

		$object->setPassword( 'newpwd' );
		$this->assertEquals( sha1( 'newpwd{' . $object->getSalt() . '}' ), $object->getPassword() );
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

	public function testGetSalt()
	{
		$this->assertEquals( 'test', $this->object->getSalt() );
	}

	public function testGetSaltGenerated()
	{
		$object = new \Aimeos\MShop\Customer\Item\FosUser( $this->address, [] );
		$this->assertEquals( 'mshop', $object->getSalt() );
	}

	public function testSetSalt()
	{
		$this->object->setSalt( 'new' );
		$this->assertTrue( $this->object->isModified() );
		$this->assertEquals( 'new', $this->object->getSalt() );
	}

	public function testIsModified()
	{
		$this->assertFalse( $this->object->isModified() );
	}
}
