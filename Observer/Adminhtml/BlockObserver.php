<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Observer\Adminhtml;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class BlockObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_date;
    protected $_coreTemplate;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Framework\View\Element\Template $coreTemplate
    )
    {
        $this->_date = $date;
        $this->_coreTemplate = $coreTemplate;
    }

    public function execute(EventObserver $observer)
    {
        if($observer->getElementName() == 'order_shipping_view') {
            $shippingInfoBlock = $observer->getLayout()->getBlock($observer->getElementName());
            $order = $shippingInfoBlock->getOrder();

            if($order->getShippingMethod() != 'clickandcollect_clickandcollect') {
                return $this;
            }

            $formattedDate = $this->_date->formatDate($order->getPickupDate(), \IntlDateFormatter::MEDIUM);
            $pickupInfo = $this->_coreTemplate
                ->setPickupDate($formattedDate)
                ->setPickupStore($order->getPickupStore())
                ->setTemplate('MageClass_ClickAndCollect::order/view/pickup-info.phtml')
                ->toHtml();
            $html = $observer->getTransport()->getOutput() . $pickupInfo;
            $observer->getTransport()->setOutput($html);
        }
    }
}