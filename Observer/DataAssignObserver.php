<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Observer;

use Magento\Framework\Event\ObserverInterface;

class DataAssignObserver implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $order = $observer->getOrder();
        
        $order->setPickupDate($quote->getPickupDate());
        
        if($quote->getPickupStore()) {
        	$order->setPickupStore($quote->getPickupStore());
        }
        return $this;
    }
}