<?php
namespace Mytek\CheckoutCustomField\Plugin\Checkout\Block;
 
class LayoutProcessorPlugin
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']
        )) {

            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']
            ['custom_field_text'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'options' => [],
                    'id' => 'custom-field-text'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.custom_field_text',
                'label' => 'Matricule Fiscal',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [
                    'required-entry' => false
                ],
                'sortOrder' => 250,
                'id' => 'custom-field-text'
            ];
        }

         /* config: checkout/options/display_billing_address_on = payment_method */
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['payments-list']['children']
        )) {
            foreach ($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                     ['payment']['children']['payments-list']['children'] as $key => $payment) {
                  
                    $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                    ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                    ['custom_field_text'] = [
                        'component' => 'Magento_Ui/js/form/element/abstract',
                        'config' => [
                            'customScope' => 'shippingAddress.custom_attributes',
                            'customEntry' => null,
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/input',
                            'options' => [],
                            'id' => 'custom-field-text'
                        ],
                        'dataScope' => 'shippingAddress.custom_attributes.custom_field_text',
                        'label' => 'Matricule Fiscal',
                        'provider' => 'checkoutProvider',
                        'visible' => true,
                        'validation' => [
                            'required-entry' => false
                        ],
                        'sortOrder' => 250,
                        'id' => 'custom-field-text'
                    ];
            }
        }

        return $jsLayout;
    }
}