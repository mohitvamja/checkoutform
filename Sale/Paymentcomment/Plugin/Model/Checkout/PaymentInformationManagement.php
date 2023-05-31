<?php
namespace Sale\Paymentcomment\Plugin\Model\Checkout;

/**
 * Class PaymentInformationManagement
 * @package Sale\Paymentcomment\Plugin\Model\Checkout
 */
class PaymentInformationManagement
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $filterManager;

    /**
     * PaymentInformationManagement constructor.
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */
    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->filterManager = $filterManager;
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\PaymentInformationManagement $subject
     * @param $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     */
    public function beforeSavePaymentInformation(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $commentsExtensionAttributes = $paymentMethod->getExtensionAttributes();
        if ($commentsExtensionAttributes->getPaycomment() || $commentsExtensionAttributes->getPaycommenttextarea() || $commentsExtensionAttributes->getYesno() ) {
            $commentspayment = trim($commentsExtensionAttributes->getPaycomment());
            $commentstextarea = trim($commentsExtensionAttributes->getPaycommenttextarea());
            $commentsyesno = trim($commentsExtensionAttributes->getYesno());
        } else {
            $commentspayment = '';
            $commentstextarea = '';
            $commentsyesno ='';
        }
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setPaycomment($commentspayment);
        $quote->setPaycommenttextarea($commentstextarea);
        $quote->setYesno($commentsyesno);
    }
}
