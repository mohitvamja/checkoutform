<?php

namespace Sale\Ordercomment\Model\Checkout;

/**
 * Class LayoutProcessorPlugin
 * @package Oye\Deliverydate\Model\Checkout
 */
class LayoutProcessorPlugin
{

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['order_comment'] = [
           'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => "ui/form/element/input",
                'options' => [],
                'id' => 'order-comment'
            ],
            'dataScope' => 'shippingAddress.order_comment',
            'label' => 'Order Comment',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'order-comment'
        ];
        return $jsLayout;
    }
}