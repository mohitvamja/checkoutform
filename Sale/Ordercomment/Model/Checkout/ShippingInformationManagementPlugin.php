<?php

namespace Sale\Ordercomment\Model\Checkout;

/**
 * Class ShippingInformationManagementPlugin
 * @package Oye\Deliverydate\Model\Checkout
 */
class ShippingInformationManagementPlugin
{

    protected $quoteRepository;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $extAttributes = $addressInformation->getExtensionAttributes();
        $ordercomment = $extAttributes->getOrderComment();
//         $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
// $logger = new \Zend_Log();
// $logger->addWriter($writer);
// $logger->info('text message');
// $logger->info(print_r($ordercomment->getData(), true));
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setOrderComment($ordercomment);
    }
}