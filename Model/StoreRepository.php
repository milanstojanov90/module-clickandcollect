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

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\CouldNotDeleteException;
use MageClass\ClickAndCollect\Api\Data\StoreInterface;
use MageClass\ClickAndCollect\Model\ResourceModel\Store;
use MageClass\ClickAndCollect\Model\StoreFactory;

class StoreRepository implements \MageClass\ClickAndCollect\Api\StoreRepositoryInterface
{
    /**
     * @var StoreResource
     */
	protected $storeResource;

    /**
     * @var StoreFactory
     */
	protected $storeFactory;

	/**
     * @var array
     */
    private $stores = [];

	public function __construct(
		Store $storeResource,
		StoreFactory $storeFactory
	) {
		$this->storeResource = $storeResource;
		$this->storeFactory = $storeFactory;
	}

    /**
     * Save store
     * 
     * @param \MageClass\ClickAndCollect\Api\Data\StoreInterface $store
     * @return \MageClass\ClickAndCollect\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
	public function save(StoreInterface $store)
	{
        try {
            $this->storeResource->save($store);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the store: %1', $exception->getMessage()));
        }
        return $store;
	}

	/**
     * Returns store by ID 
     * 
     * @param int $storeId
     * @return \MageClass\ClickAndCollect\Api\Data\StoreInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
	public function get($storeId)
    {
        if (!isset($this->stores[$storeId])) {
        	$store = $this->storeFactory->create();
            $this->storeResource->load($store, $storeId);
            if (!$store->getStoreId()) {
                throw new NoSuchEntityException(__('Requested store doesn\'t exist'));
            }
            $this->stores[$storeId] = $store;
        }
        return $this->stores[$storeId];
    }

    /**
     * Deletes store
     * 
     * @param \MageClass\ClickAndCollect\Api\Data\StoreInterface $store
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(StoreInterface $store)
    {
    	try {
            $this->storeResource->delete($store);
            unset($this->stores[$store->getStoreId()]);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Unable to remove store %1', $store->getStoreId()));
        }
        return true;
    }

    /**
     * Deletes store by ID
     * 
     * @param int $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($storeId)
    {
        $store = $this->get($storeId);
        $this->delete($store);
        return true;
    }
}