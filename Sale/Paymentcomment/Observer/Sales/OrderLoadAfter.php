<?php
namespace Sale\Paymentcomment\Observer\Sales;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Stdlib\DateTime\Timezone\LocalizedDateToUtcConverterInterface;

class OrderLoadAfter implements ObserverInterface
{
    public $utcConverter;
    protected $locale;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $locale,
        LocalizedDateToUtcConverterInterface $utcConverter
    ) {
        $this->utcConverter = $utcConverter;
        $this->locale = $locale;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getOrder();

        $time = $order['created_at'];
        $date = $this->locale->date($time);
        $localDate =  date_format($date,'Y-m-d H:i:s');


            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/templog.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info("preorder label"); 
            $logger->info($time);
             $logger->info($localDate);
            $logger->info(print_r($order->getData(), true));

            //die('test');
        $extensionAttributes = $order->getExtensionAttributes();
        if ($extensionAttributes === null) {
            $extensionAttributes = $this->getOrderExtensionDependency();
        }
        $attr = $order->getData('custom_attribute');
        // $extensionAttributes->setCustomAttribute($attr);
        // $order->setExtensionAttributes($extensionAttributes);
    }
    private function getOrderExtensionDependency()
    {
        $orderExtension = \Magento\Framework\App\ObjectManager::getInstance()->get(
            '\Magento\Sales\Api\Data\OrderExtension'
        );
        return $orderExtension;
    }
}
