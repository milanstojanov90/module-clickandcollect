<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Model;

use Magento\Framework\Model\AbstractModel;
use MageClass\ClickAndCollect\Api\Data\StoreInterface;

class Store extends AbstractModel implements StoreInterface
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('MageClass\ClickAndCollect\Model\ResourceModel\Store');
    }
    
    public function getAvailableStatuses()
    {
        return [
        	self::STATUS_ENABLED => __('Enabled'), 
        	self::STATUS_DISABLED => __('Disabled')
        ];
    }

    /**
     * Returns store id field
     *
     * @return int|null
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Set store id
     * 
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Returns name field
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set store name
     * 
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Returns address field
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * Set store address
     * 
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * Returns working_time field
     *
     * @return string|null
     */
    public function getWorkingTime()
    {
        return $this->getData(self::WORKING_TIME);
    }

    /**
     * Set store working time
     * 
     * @param string $workingTime
     * @return $this
     */
    public function setWorkingTime($workingTime)
    {
        return $this->setData(self::WORKING_TIME, $workingTime);
    }

    /**
     * Returns latitude field
     *
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * Set store latitude
     * 
     * @param string $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * Returns longitude field
     *
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * Set store longitude
     * 
     * @param string $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    /**
     * Returns created_at field
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created at
     * 
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->getData(self::CREATED_AT, $createdAt);
    }

    /**
     * Returns updated_at field
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set updated at
     * 
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->getData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Returns is_active field
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set is active
     * 
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
}