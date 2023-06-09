define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';

    return function (payloadExtend) {
        return wrapper.wrap(payloadExtend, function (originPayloadExtend, payload) {
            payload = originPayloadExtend(payload);
            var shippingAddress = payload.addressInformation.shipping_address;
            if (shippingAddress.hasOwnProperty('customAttributes')) {
                shippingAddress.customAttributes.map(function(customAttribute) {
                    payload.addressInformation['extension_attributes'][customAttribute['attribute_code']] = customAttribute.value;
                })
            }
            return payload;
        });
    };
});
