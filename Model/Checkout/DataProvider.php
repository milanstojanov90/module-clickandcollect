<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Model\Checkout;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use MageClass\ClickAndCollect\Model\ResourceModel\Store\CollectionFactory;

class DataProvider implements ConfigProviderInterface
{
    const XPATH_MAPS_API_KEY    = 'mageclass_clickandcollect/general/maps_api_key';
    const XPATH_DEFAULT_LATITUDE    = 'mageclass_clickandcollect/general/default_latitude';
    const XPATH_DEFAULT_LONGITUDE   = 'mageclass_clickandcollect/general/default_longitude';
    const XPATH_DEFAULT_ZOOM        = 'mageclass_clickandcollect/general/default_zoom';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \MageClass\ClickAndCollect\Model\ResourceModel\Store\CollectionFactory
     */
    protected $storeCollectionFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        CollectionFactory $storeCollectionFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->storeCollectionFactory = $storeCollectionFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $store = $this->getStoreId();
        $mapsApiKey = $this->scopeConfig->getValue(self::XPATH_MAPS_API_KEY, ScopeInterface::SCOPE_STORE, $store);
        $defaultLatitude = $this->scopeConfig->getValue(self::XPATH_DEFAULT_LATITUDE, ScopeInterface::SCOPE_STORE, $store);
        $defaultLongitude = $this->scopeConfig->getValue(self::XPATH_DEFAULT_LONGITUDE, ScopeInterface::SCOPE_STORE, $store);
        $defaultZoom = $this->scopeConfig->getValue(self::XPATH_DEFAULT_ZOOM, ScopeInterface::SCOPE_STORE, $store);

        $config = [
            'shipping' => [
                'select_store' => [
                    'maps_api_key'   => $mapsApiKey,
                    'lat'   => (float)$defaultLatitude,
                    'lng'   => (float)$defaultLongitude,
                    'zoom'  => (int)$defaultZoom,
                    'stores' => $this->getStores()
                ]
            ]
        ];

        return $config;
    }

    public function getStoreId()
    {
        return $this->storeManager->getStore()->getStoreId();
    }

    public function getStores()
    {
        $stores = $this->storeCollectionFactory
            ->create()
            ->addActiveFilter()
            ->toArray();
        return \Zend_Json::encode($stores);
    }
}