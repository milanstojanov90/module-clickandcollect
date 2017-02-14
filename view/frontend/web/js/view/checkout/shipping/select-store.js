/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

define([
    'uiComponent',
    'ko',
    'jquery',
    'mage/translate',
    'Magento_Ui/js/modal/modal',
    'Magento_Checkout/js/model/quote',
    'mageclass/map-loader',
    'mageclass/map'
], function (Component, ko, $, $t, modal, quote, MapLoader, map) {
    'use strict';

    var popUp = null;

    return Component.extend({
        defaults: {
            template: 'MageClass_ClickAndCollect/checkout/shipping/select-store'
        },
        isClickAndCollect: ko.observable(false),
        isSelectStoreVisible: ko.observable(false),
        isMapVisible: ko.observable(false),

        initialize: function () {
        	var self = this;
        	quote.shippingMethod.subscribe(function () {
            	if (quote.shippingMethod().carrier_code == 'clickandcollect') {
            		self.isClickAndCollect(true);
                    var stores = $.parseJSON(window.checkoutConfig.shipping.select_store.stores);
                    if(stores.totalRecords > 1) {
                        self.isSelectStoreVisible(true);
                    }
            	} else {
            		self.isClickAndCollect(false);
            	}
            });

            this.isMapVisible.subscribe(function (value) {
                if (value) {
                    self.getPopUp().openModal();
                } else {
                    self.getPopUp().closeModal();
                }
            });

            ko.bindingHandlers.datetimepicker = {
                init: function (element, valueAccessor, allBindingsAccessor) {
                    var $el = $(element);
                    $el.datetimepicker({
                        'showTimepicker': false,
                        'format': 'yyyy-MM-dd'
                    });
                    var writable = valueAccessor();
                    if (!ko.isObservable(writable)) {
                        var propWriters = allBindingsAccessor()._ko_property_writers;
                        if (propWriters && propWriters.datetimepicker) {
                            writable = propWriters.datetimepicker;
                        } else {
                            return;
                        }
                    }
                    writable($(element).datetimepicker("getDate"));
                },
                update: function (element, valueAccessor) {
                    var widget = $(element).data("DateTimePicker");
                    if (widget) {
                        var date = ko.utils.unwrapObservable(valueAccessor());
                        widget.date(date);
                    }
                }
            };

            $('body').on('click', '.apply-store', function() {
                $('#pickup-store').val($(this).data('id'));
                $('#selected-store-msg')
                    .show()
                    .find('span')
                    .text( $(this).data('name') );
                self.isMapVisible(false);
            });

            return this._super();
        },

        showMap: function () {
            this.isMapVisible(true);
        },

        getPopUp: function () {
            var self = this,
                buttons;

            if (!popUp) {
                MapLoader.done($.proxy(map.initMap, this)).fail(function() {
                    console.error("ERROR: Google maps library failed to load");
                });
                popUp = modal({
                	'responsive': true,
                	'innerScroll': true,
                    'buttons': [],
                    'type': 'slide',
                    'modalClass': 'mc_cac_map',
                	closed: function() {
            			self.isMapVisible(false)
            		}
                }, $('#map-canvas'));
            }
            return popUp;
        }
    });
});