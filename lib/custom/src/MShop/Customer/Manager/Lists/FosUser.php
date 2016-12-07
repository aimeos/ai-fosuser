<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 * @package MShop
 * @subpackage Customer
 */


namespace Aimeos\MShop\Customer\Manager\Lists;


/**
 * Fos user bundle implementation of the customer list class.
 *
 * @package MShop
 * @subpackage Customer
 */
class FosUser
	extends \Aimeos\MShop\Customer\Manager\Lists\Standard
	implements \Aimeos\MShop\Customer\Manager\Lists\Iface, \Aimeos\MShop\Common\Manager\Lists\Iface
{
	private $searchConfig = array(
		'customer.lists.id'=> array(
			'code'=>'customer.lists.id',
			'internalcode'=>'fosli."id"',
			'internaldeps' => array( 'LEFT JOIN "fos_user_list" AS fosli ON ( fos."id" = fosli."parentid" )' ),
			'label'=>'Customer list ID',
			'type'=> 'integer',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.lists.siteid'=> array(
			'code'=>'customer.lists.siteid',
			'internalcode'=>'fosli."siteid"',
			'label'=>'Customer list site ID',
			'type'=> 'integer',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.lists.parentid'=> array(
			'code'=>'customer.lists.parentid',
			'internalcode'=>'fosli."parentid"',
			'label'=>'Customer list parent ID',
			'type'=> 'integer',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.lists.domain'=> array(
			'code'=>'customer.lists.domain',
			'internalcode'=>'fosli."domain"',
			'label'=>'Customer list domain',
			'type'=> 'string',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.typeid' => array(
			'code'=>'customer.lists.typeid',
			'internalcode'=>'fosli."typeid"',
			'label'=>'Customer list type ID',
			'type'=> 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.lists.refid'=> array(
			'code'=>'customer.lists.refid',
			'internalcode'=>'fosli."refid"',
			'label'=>'Customer list reference ID',
			'type'=> 'string',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.datestart' => array(
			'code'=>'customer.lists.datestart',
			'internalcode'=>'fosli."start"',
			'label'=>'Customer list start date/time',
			'type'=> 'datetime',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.dateend' => array(
			'code'=>'customer.lists.dateend',
			'internalcode'=>'fosli."end"',
			'label'=>'Customer list end date/time',
			'type'=> 'datetime',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.config' => array(
			'code'=>'customer.lists.config',
			'internalcode'=>'fosli."config"',
			'label'=>'Customer list position',
			'type'=> 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.position' => array(
			'code'=>'customer.lists.position',
			'internalcode'=>'fosli."pos"',
			'label'=>'Customer list position',
			'type'=> 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
		),
		'customer.lists.status' => array(
			'code'=>'customer.lists.status',
			'internalcode'=>'fosli."status"',
			'label'=>'Customer list status',
			'type'=> 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
		),
		'customer.lists.ctime'=> array(
			'code'=>'customer.lists.ctime',
			'internalcode'=>'fosli."ctime"',
			'label'=>'Customer list create date/time',
			'type'=> 'datetime',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.mtime'=> array(
			'code'=>'customer.lists.mtime',
			'internalcode'=>'fosli."mtime"',
			'label'=>'Customer list modification date/time',
			'type'=> 'datetime',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lists.editor'=> array(
			'code'=>'customer.lists.editor',
			'internalcode'=>'fosli."editor"',
			'label'=>'Customer list editor',
			'type'=> 'string',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
	);


	/**
	 * Removes old entries from the storage.
	 *
	 * @param array $siteids List of IDs for sites whose entries should be deleted
	 */
	public function cleanup( array $siteids )
	{
		$path = 'mshop/customer/manager/lists/submanagers';
		foreach( $this->getContext()->getConfig()->get( $path, array( 'type' ) ) as $domain ) {
			$this->getSubManager( $domain )->cleanup( $siteids );
		}

		$this->cleanupBase( $siteids, 'mshop/customer/manager/lists/fosuser/delete' );
	}


	/**
	 * Returns the list attributes that can be used for searching.
	 *
	 * @param boolean $withsub Return also attributes of sub-managers if true
	 * @return array List of attribute items implementing \Aimeos\MW\Criteria\Attribute\Iface
	 */
	public function getSearchAttributes( $withsub = true )
	{
		$path = 'mshop/customer/manager/lists/submanagers';

		return $this->getSearchAttributesBase( $this->searchConfig, $path, array( 'type' ), $withsub );
	}


	/**
	 * Returns a new manager for customer extensions
	 *
	 * @param string $manager Name of the sub manager type in lower case
	 * @param string|null $name Name of the implementation, will be from configuration (or Default) if null
	 * @return mixed Manager for different extensions, e.g stock, tags, locations, etc.
	 */
	public function getSubManager( $manager, $name = null )
	{
		return $this->getSubManagerBase( 'customer', 'lists/' . $manager, ( $name === null ? 'FosUser' : $name ) );
	}


	/**
	 * Returns the config path for retrieving the configuration values.
	 *
	 * @return string Configuration path (mshop/customer/manager/lists/type/fosuser/)
	 */
	protected function getConfigPath()
	{
		return 'mshop/customer/manager/lists/fosuser/';
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
