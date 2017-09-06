var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'Talos_MyCheckout/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Talos_MyCheckout/js/view/shipping-payment-mixin': true
            }
        }
    }
}