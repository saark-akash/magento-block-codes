var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'Akash_CustomStepInCheckout/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Akash_CustomStepInCheckout/js/view/shipping-payment-mixin': true
            }
        }
    }
}
