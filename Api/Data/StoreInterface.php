<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Api\Data;

interface StoreInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
	/**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const STORE_ID = 'store_id';
    const NAME = 'name';
    const ADDRESS = 'address';
    const WORKING_TIME = 'working_time';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const IS_ACTIVE = 'is_active';

    /**
     * Returns store id field
     *
     * @return int|null
     */
    public function getStoreId();

    /**
     * Set store id
     * 
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * Returns name field
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set store name
     * 
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Returns address field
     *
     * @return string|null
     */
    public function getAddress();

    /**
     * Set store address
     * 
     * @param string $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * Returns working_time field
     *
     * @return string|null
     */
    public function getWorkingTime();

    /**
     * Set store working time
     * 
     * @param string $workingTime
     * @return $this
     */
    public function setWorkingTime($workingTime);

    /**
     * Returns latitude field
     *
     * @return string|null
     */
    public function getLatitude();

    /**
     * Set store latitude
     * 
     * @param string $latitude
     * @return $this
     */
    public function setLatitude($latitude);

    /**
     * Returns longitude field
     *
     * @return string|null
     */
    public function getLongitude();

    /**
     * Set store longitude
     * 
     * @param string $longitude
     * @return $this
     */
    public function setLongitude($longitude);

    /**
     * Returns created_at field
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at
     * 
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Returns updated_at field
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at
     * 
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Returns is_active field
     *
     * @return bool|null
     */
    public function getIsActive();

    /**
     * Set is active
     * 
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive);
}