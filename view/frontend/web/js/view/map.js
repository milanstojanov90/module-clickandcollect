/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

define([
    'jquery'
], function ($) {
    'use strict';
    return {
        initMap: function() {
            var self = this;
            var myLatLng = {
                lat: window.checkoutConfig.shipping.select_store.lat, 
                lng: window.checkoutConfig.shipping.select_store.lng
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
              zoom: window.checkoutConfig.shipping.select_store.zoom,
              center: myLatLng
            });

            var stores = $.parseJSON(window.checkoutConfig.shipping.select_store.stores);
            var infoWindow = new google.maps.InfoWindow();

            $.each(stores, function(index, obj) {
                $.each(obj, function(key, store) {
                    var latitude = parseFloat(store.latitude),
                        longitude = parseFloat(store.longitude),
                        latLng = new google.maps.LatLng(latitude, longitude),
                        marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            title: store.name
                        });

                    (function(marker, store) {
                        google.maps.event.addListener(marker, 'click', function(e) {
                            infoWindow.setContent('<h3>'+ store.name + '</h3><br /><br /><strong>Address: </strong>' + store.address + '<br /><br />'
                                + store.working_time.replace(/(?:\r\n|\r|\n)/g, '<br />') +'<br /><br /><button data-id="'
                                + store.store_id + '" data-name="'+ store.name +'" class="apply-store">Pick Up Here!</button></div>');
                            infoWindow.open(map, marker);
                        });
                    })(marker, store);
                });
            });
        }
    }
});