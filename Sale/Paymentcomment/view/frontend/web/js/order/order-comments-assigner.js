define([
    'jquery'
], function ($) {
    'use strict';


    /** Override default place order action and add comment to request */
    return function (paymentData) {

        if (paymentData['extension_attributes'] === undefined) {
            paymentData['extension_attributes'] = {};
        }

        paymentData['extension_attributes']['paycomment'] = jQuery('[name="paycomment"]').val();
        paymentData['extension_attributes']['paycommenttextarea'] = jQuery('[name="paycommenttextarea"]').val();
        paymentData['extension_attributes']['yesno'] = jQuery('[name="yesno"]').val();
    };
});