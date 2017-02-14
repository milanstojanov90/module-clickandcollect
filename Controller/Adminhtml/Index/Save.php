<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Controller\Adminhtml\Index;

use \MageClass\ClickAndCollect\Model\StoreFactory;
use \MageClass\ClickAndCollect\Api\StoreRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Reflection\DataObjectProcessor;
use MageClass\ClickAndCollect\Api\Data\StoreInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var StoreFactory
     */
    protected $storeFactory;

    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param StoreFactory $storeFactory
     * @param StoreRepositoryInterface $storeRepository
     * @param DataObjectProcessor $dataObjectProcessor
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        StoreFactory $storeFactory,
        StoreRepositoryInterface $storeRepository,
        DataObjectProcessor $dataObjectProcessor,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->storeRepository = $storeRepository;
        $this->storeFactory = $storeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataObjectHelper = $dataObjectHelper;

        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if($data) {
            $id = !empty($data['store_id']) ? $data['store_id'] : null;

            $resultRedirect = $this->resultRedirectFactory->create();
            if (isset($data)) {
                try {
                    if ($id) {
                        $store = $this->storeRepository->get((int)$id);
                    } else {
                        unset($data['store_id']);
                        $store = $this->storeFactory->create();
                    }

                    $this->dataObjectHelper->populateWithArray($store, $data, StoreInterface::class);
                    $this->storeRepository->save($store);

                    $this->messageManager->addSuccessMessage(__('You saved the store'));
                    if ($this->getRequest()->getParam('back')) {
                        return $resultRedirect->setPath('*/*/edit', ['store_id' => $store->getId(), '_current' => true]);
                    } else {
                        $resultRedirect->setPath('*/*');
                    }
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage(__('There was a problem saving the store'));
                    $resultRedirect->setPath('*/*/edit', ['store_id' => $id]);
                }

            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
