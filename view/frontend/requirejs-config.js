/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

var config = {
    map: {
       '*': {
           'mageclass/map-loader' : 'MageClass_ClickAndCollect/js/map-loader',
           'mageclass/stores-provider' : 'MageClass_ClickAndCollect/js/model/stores-provider',
           'mageclass/map' : 'MageClass_ClickAndCollect/js/view/map',
           'Magento_Checkout/js/model/shipping-save-processor/default': 'MageClass_ClickAndCollect/js/model/shipping-save-processor/default'
       }
    },
    config: {
    	mixins: {
            'Magento_Checkout/js/view/shipping': {
                'MageClass_ClickAndCollect/js/view/plugin/shipping': true
            }
        }
    }
};
