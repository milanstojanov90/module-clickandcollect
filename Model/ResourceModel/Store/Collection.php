<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Model\ResourceModel\Store;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'store_id';
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MageClass\ClickAndCollect\Model\Store', 'MageClass\ClickAndCollect\Model\ResourceModel\Store');
    }

    public function addActiveFilter()
    {
        $this->addFieldToFilter('is_active', 1);
        return $this;
    }
}