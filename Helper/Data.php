<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Helper;

use \Magento\Framework\App\Helper\Context;
use MageClass\ClickAndCollect\Api\StoreRepositoryInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {
    
    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(
    	Context $context,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->storeRepository = $storeRepository;
        parent::__construct($context);
    }

    /**
     * Return store name by id
     *
     * @return string|null
     */
	public function getStoreNameById($storeId)
	{
		$store = $this->storeRepository->get($storeId);
		if($store->getId()) {
			return $store->getName();
		}
	}
}