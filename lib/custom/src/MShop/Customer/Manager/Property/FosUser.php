<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018
 * @package MShop
 * @subpackage Customer
 */


namespace Aimeos\MShop\Customer\Manager\Property;


/**
 * Default property manager implementation.
 *
 * @package MShop
 * @subpackage Customer
 */
class FosUser
	extends \Aimeos\MShop\Customer\Manager\Property\Standard
{
	private $searchConfig = array(
		'customer.property.id' => array(
			'code' => 'customer.property.id',
			'internalcode' => 'fospr."id"',
			'internaldeps'=>array( 'LEFT JOIN "fos_user_property" AS fospr ON ( fospr."parentid" = fos."id" )' ),
			'label' => 'Property ID',
			'type' => 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.property.parentid' => array(
			'code' => 'customer.property.parentid',
			'internalcode' => 'fospr."parentid"',
			'label' => 'Property parent ID',
			'type' => 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.property.siteid' => array(
			'code' => 'customer.property.siteid',
			'internalcode' => 'fospr."siteid"',
			'label' => 'Property site ID',
			'type' => 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.property.typeid' => array(
			'code' => 'customer.property.typeid',
			'internalcode' => 'fospr."typeid"',
			'label' => 'Property type ID',
			'type' => 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.property.value' => array(
			'code' => 'customer.property.value',
			'internalcode' => 'fospr."value"',
			'label' => 'Property value',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.property.languageid' => array(
			'code' => 'customer.property.languageid',
			'internalcode' => 'fospr."langid"',
			'label' => 'Property language ID',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.property.ctime' => array(
			'code' => 'customer.property.ctime',
			'internalcode' => 'fospr."ctime"',
			'label' => 'Property create date/time',
			'type' => 'datetime',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
			'public' => false,
		),
		'customer.property.mtime' => array(
			'code' => 'customer.property.mtime',
			'internalcode' => 'fospr."mtime"',
			'label' => 'Property modify date',
			'type' => 'datetime',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
			'public' => false,
		),
		'customer.property.editor' => array(
			'code' => 'customer.property.editor',
			'internalcode' => 'fospr."editor"',
			'label' => 'Property editor',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
			'public' => false,
		),
	);


	/**
	 * Removes old entries from the storage.
	 *
	 * @param integer[] $siteids List of IDs for sites whose entries should be deleted
	 */
	public function cleanup( array $siteids )
	{
		$path = 'mshop/customer/manager/property/submanagers';
		foreach( $this->getContext()->getConfig()->get( $path, [] ) as $domain ) {
			$this->getObject()->getSubManager( $domain )->cleanup( $siteids );
		}

		$this->cleanupBase( $siteids, 'mshop/customer/manager/property/fosuser/delete' );
	}


	/**
	 * Returns the attributes that can be used for searching.
	 *
	 * @param boolean $withsub Return also attributes of sub-managers if true
	 * @return array Returns a list of attribtes implementing \Aimeos\MW\Criteria\Attribute\Iface
	 */
	public function getSearchAttributes( $withsub = true )
	{
		$path = 'mshop/customer/manager/property/submanagers';

		return $this->getSearchAttributesBase( $this->searchConfig, $path, ['type'], $withsub );
	}


	/**
	 * Returns a new manager for customer extensions
	 *
	 * @param string $manager Name of the sub manager type in lower case
	 * @param string|null $name Name of the implementation, will be from
	 * configuration (or Default) if null
	 * @return \Aimeos\MShop\Common\Manager\Iface Manager for different extensions, e.g property types, property lists etc.
	 */
	public function getSubManager( $manager, $name = null )
	{
		return $this->getSubManagerBase( 'customer', 'property/' . $manager, ( $name === null ? 'FosUser' : $name ) );
	}


	/**
	 * Returns the config path for retrieving the configuration values.
	 *
	 * @return string Configuration path
	 */
	protected function getConfigPath()
	{
		return 'mshop/customer/manager/property/fosuser/';
	}


	/**
	 * Returns the search configuration for searching items.
	 *
	 * @return array Associative list of search keys and search definitions
	 */
	protected function getSearchConfig()
	{
		return $this->searchConfig;
	}
}
