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

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use MageClass\ClickAndCollect\Api\StoreRepositoryInterface;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \MageClass\ClickAndCollect\Api\StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \MageClass\ClickAndCollect\StoreRepositoryInterface $storeRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->storeRepository = $storeRepository;
        parent::__construct($context);
    }

    /**
     * Initialize current Store and set it in the registry.
     *
     * @return int
     */
    protected function _initStore()
    {
        $storeId = $this->getRequest()->getParam('store_id');
        $this->coreRegistry->register('current_store', $storeId);
        return $storeId;
    }

    /**
     * Edit Store
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $storeId = $this->_initStore();

        if ($storeId) {
            $store = $this->storeRepository->get($storeId);
            if (!$store->getId()) {
                $this->messageManager->addError(__('This store does not exist.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('MageClass_ClickAndCollect::manage_stores');

        $resultPage->addBreadcrumb(
            $storeId ? __('Edit Store') : __('New Store'),
            $storeId ? __('Edit Store') : __('New Store')
        );

        if ($storeId) {
            $title =  __("Edit Store '%1'", $store->getName());
            $resultPage->getConfig()->getTitle()->prepend($title);
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Store'));
        }

        return $resultPage;
    }
}
