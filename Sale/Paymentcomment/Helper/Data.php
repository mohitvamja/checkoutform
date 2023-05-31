<?php
namespace Sale\Paymentcomment\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
 
class Data extends AbstractHelper
{
    protected $encryptor;
 
    public function __construct(
        Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        EncryptorInterface $encryptor
    )
    {
        parent::__construct($context);
        $this->encryptor = $encryptor;
        $this->jsonHelper = $jsonHelper;
    }
 
   
    public function getPaycomment($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {

         $payemnt = $this->scopeConfig->getValue(
            'paymentcomment/general/paycomment',
            $scope
        );
        $options =  $this->jsonHelper->jsonDecode($payemnt);
         //print_r($options); die('test');
         $var = array();
         foreach ($options as $value) {
             $var[] = $value['from_qty'];

         }
         return $var;    
    }
 

}
