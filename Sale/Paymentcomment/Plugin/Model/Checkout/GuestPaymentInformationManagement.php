<?php
namespace Sale\Paymentcomment\Plugin\Model\Checkout;

/**
 * Class GuestPaymentInformationManagement
 * @package Sale\Paymentcomment\Plugin\Model\Checkout
 */
class GuestPaymentInformationManagement
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @var \Magento\Quote\Model\QuoteIdMaskFactory
     */

    protected $quoteIdMaskFactory;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $filterManager;

    /**
     * GuestPaymentInformationManagement constructor.
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
     */
    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->filterManager = $filterManager;
        $this->quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    /**
     * @param \Magento\Checkout\Model\GuestPaymentInformationManagement $subject
     * @param $cartId
     * @param $email
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     */
    public function beforeSavePaymentInformation(
        \Magento\Checkout\Model\GuestPaymentInformationManagement $subject,
        $cartId,
        $email,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $commentsExtensionAttributes = $paymentMethod->getExtensionAttributes();
        if ($commentsExtensionAttributes->getPaycomment()):
            $comments = trim($commentsExtensionAttributes->getPaycomment());
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/custom.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info('Your log details');
            $logger->info(print_r($comments, true));

            $orderComments = $this->filterManager->stripTags($comments);
            $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
            $quote = $this->quoteRepository->getActive($quoteIdMask->getQuoteId());
            $quote->setPaycomment($orderComments);
        endif;
        if ($commentsExtensionAttributes->getPaycommenttextarea()):
            $comments = trim($commentsExtensionAttributes->getPaycommenttextarea());
            

            $orderComments = $this->filterManager->stripTags($comments);
            $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
            $quote = $this->quoteRepository->getActive($quoteIdMask->getQuoteId());
            $quote->setPaycommenttextarea($orderComments);
        endif;
        if ($commentsExtensionAttributes->getYesno()):
            $comments = trim($commentsExtensionAttributes->getYesno());
          

            $orderComments = $this->filterManager->stripTags($comments);
            $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
            $quote = $this->quoteRepository->getActive($quoteIdMask->getQuoteId());
            $quote->setYesno($orderComments);
        endif;
    }
}
