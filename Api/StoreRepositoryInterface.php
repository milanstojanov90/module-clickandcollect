<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Api;

interface StoreRepositoryInterface
{
    /**
     * Save store
     * 
     * @param \MageClass\ClickAndCollect\Api\Data\StoreInterface $store
     * @return \MageClass\ClickAndCollect\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\MageClass\ClickAndCollect\Api\Data\StoreInterface $store);

    /**
     * Returns store by ID 
     * 
     * @param int $storeId
     * @return \MageClass\ClickAndCollect\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($storeId);

    /**
     * Deletes store
     * 
     * @param \MageClass\ClickAndCollect\Api\Data\StoreInterface $store
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\MageClass\ClickAndCollect\Api\Data\StoreInterface $store);

    /**
     * Deletes store by ID
     * 
     * @param int $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($storeId);

}