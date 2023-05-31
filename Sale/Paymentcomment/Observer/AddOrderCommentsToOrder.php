<?php
namespace Sale\Paymentcomment\Observer;

/**
 * Class AddOrderCommentsToOrder
 * @package Sale\Paymentcomment\Observer
 */
class AddOrderCommentsToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        
        $order->setData('yesno', $quote->getYesno());
        $order->setData('paycomment', $quote->getPaycomment());
        $order->setData('paycommenttextarea', $quote->getPaycommenttextarea());
        

         return $this;
    }
}
