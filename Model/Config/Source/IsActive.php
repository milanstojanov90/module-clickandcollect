<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{
    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $store;

    /**
     * Constructor
     *
     * @param \Magento\Cms\Model\Page $cmsPage
     */
    public function __construct(\MageClass\ClickAndCollect\Model\Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->store->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
