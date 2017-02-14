<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Block\Adminhtml\Index\Edit\Buttons;

use Magento\Backend\Block\Widget\Context;
use MageClass\ClickAndCollect\Api\StoreRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Generic
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;

    /**
     * @param Context $context
     * @param StoreRepositoryInterface $storeRepository
     */
    public function __construct(
        Context $context,
        StoreRepositoryInterface $storeRepository
    ) {
        $this->context = $context;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Return ID
     *
     * @return int|null
     */
    public function getId()
    {
        try {
            return $this->storeRepository->get(
                $this->context->getRequest()->getParam('store_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
