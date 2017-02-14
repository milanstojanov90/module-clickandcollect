/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

define([
    'Magento_Checkout/js/model/quote',
    'jquery'
], function (quote, $) {
    'use strict';

    return function (Component) {
        return Component.extend({
            validateShippingInformation: function () {
                if( quote.shippingMethod().carrier_code == 'clickandcollect') {
                    var stores = $.parseJSON(window.checkoutConfig.shipping.select_store.stores);
                    if ($('#pickup-date').val() == '' || (stores.totalRecords > 1 && $('#pickup-store').val() == '')) {
                        this.errorValidationMessage('Please provide when and where (if suitable) you prefer to pick your order.');
                        return false;
                    }
                }
                return this._super();
            }
        });
    }
});