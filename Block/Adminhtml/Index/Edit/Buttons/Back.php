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

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends Generic implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
