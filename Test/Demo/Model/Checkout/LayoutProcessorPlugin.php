<?php
namespace Test\Demo\Model\Checkout;


use Magento\Checkout\Block\Checkout\LayoutProcessor;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;

class LayoutProcessorPlugin
{
    protected $logger;
    protected $helper;
    protected $customerRepository;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Sale\Paymentcomment\Helper\Data $helperData,
        CustomerRepositoryInterface $customerRepository,
        CustomerSession $customerSession
    ) {
        $this->logger = $logger;
         $this->helper = $helperData;
         $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
    }

    public function afterProcess(LayoutProcessor $subject, array $jsLayout)
    {
         $value =  $this->helper->getPaycomment();
         foreach ($value as $data) {
            
             $opt[] = array(
                   'value' => $data,
                   'label' => $data
               );
           }
         if ($this->customerSession->isLoggedIn()) {
         $customerId  = $this->customerSession->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        
        $test = $customer->getCustomAttribute('landmark')->getValue();
        
        // $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
        //     ['payment']['children']['payments-list']['children']['before-place-order']['children']['paycomment'] = [
        //         'component' => 'Magento_Ui/js/form/element/select',
        //         'config' => [
        //             'customScope' => 'shippingAddress',
        //             'template' => 'ui/form/field',
        //              'elementTmpl' => 'ui/form/element/select',
        //             'id' => 'paycomment'
        //         ],
        //         'dataScope' => 'paycomment',
        //         'label' => 'paycomment Comment',
        //         //'notice' => __('paycomment'),
        //         'provider' => 'checkoutProvider',
        //         'visible' => true,
        //         'sortOrder' => 100,
        //         'id' => 'drop-down',
        //         'options' =>  $opt
        //     ];

             $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['landmark'] = [
           'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => "ui/form/element/input",
                'options' => [],
                'id' => 'landmark'
            ],
            'value' => $test,
            'dataScope' => 'shippingAddress.landmark',
            'label' => 'landmark',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'landmark'
        ];

        return $jsLayout;

        }
        else{
        	 $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['landmark'] = [
           'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => "ui/form/element/input",
                'options' => [],
                'id' => 'landmark'
            ],
           
            'dataScope' => 'shippingAddress.landmark',
            'label' => 'landmark',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'landmark'
        ];

        return $jsLayout;
        }
    }
}