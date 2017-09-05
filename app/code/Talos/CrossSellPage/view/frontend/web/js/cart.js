/*jshint browser:true, jquery:true*/
/*global confirm:true*/
define([
    "jquery",
    'mage/storage',
    "jquery/ui"
], function($, storage){
    "use strict";

    $.widget('talos.cart', {
        /**
         * Options common to all instances of this widget.
         * @type {Object}
         */
        options: {
            productId : 0
        },

        /**
         * Bind event handlers for adding and deleting addresses.
         * @private
         */
        _create: function() {
            var options         = this.options;
            var self = this;
            $('#click-here').click(function (e) {
                e.preventDefault();
                self._updateCart();
            });
            $('.cross-sell-option').click(function (e) {
                var optionId = $(this).attr('parent-id');
                var selectionId = $(this).attr('value');
                self._updateOptions(optionId, selectionId);
            });
        },

        /**
         * Update cart
         * @private
         */
        _updateCart: function() {
            storage.post(
                'crosssellpage/ajax/updateCart'
            ).done(function (response) {
               console.log(response);
            }).fail(function () {
                console.log('error');
            });
        },

        /**
         * Update cart
         * @private
         */
        _updateOptions: function(optionId, selectionId) {
            var self = this;
            var key = 'options[' + optionId + ']';
            $.ajax({
                url: 'ajax/updateOptions',
                data: {id : self.options.productId, [key] : selectionId},
                type: 'post',
                dataType: 'json',
                complete: function (response) {
                    if (response.status === 200) {
                        // Update cart
                    } else {
                        console.error(response.statusText);
                    }
                }
            });
        }
    });

    return $.talos.cart;
});
