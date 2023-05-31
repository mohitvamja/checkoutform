<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sale\Paymentcomment\Ui\Component\Listing\Column;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\UrlInterface;

class Isinvoice extends Column
{
    const PRODUCT_URL_PATH_EDIT = 'sales/invoice/view';
    protected $_orderRepository;
    protected $_searchCriteria;
    protected $urlBuilder;
    protected $_storeManager;

    public function __construct(ContextInterface $context, UrlInterface $urlBuilder, \Magento\Store\Model\StoreManagerInterface $storeManager, UiComponentFactory $uiComponentFactory, OrderRepositoryInterface $orderRepository, SearchCriteriaBuilder $criteria, array $components = [], array $data = [])
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        $this->urlBuilder = $urlBuilder;
        $this->_storeManager = $storeManager; 
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        // if (isset($dataSource['data']['items'])) {
        //     foreach ($dataSource['data']['items'] as & $item) {

        //     $order  = $this->_orderRepository->get($item["entity_id"]);

        //     if($order->hasInvoices()){
        //     foreach ($order->getInvoiceCollection() as $invoice)
        //     {
        //       
        //         $invoice_id = $invoice->getIncrementId();

        //          $id = $invoice->getId(); 

                   
        //         $message = html_entity_decode('<a href="'.$this->urlBuilder->getUrl(self::PRODUCT_URL_PATH_EDIT, ['invoice_id' => $id]).'">'."Yes".'</a>');
        //             }
        //         }
        //         else{

        //             $message = 'No';
        //         }
        //         $item[$this->getData('name')] = $message;
        //     }
        // }

        if (isset($dataSource['data']['items'])) {
        foreach ($dataSource['data']['items'] as & $item) {
            
             $order  = $this->_orderRepository->get($item["entity_id"]);
            if($order->hasInvoices()){ 
            foreach ($order->getInvoiceCollection() as $invoice){
                $id = $invoice->getId(); 
                $url = $this->urlBuilder->getUrl(self::PRODUCT_URL_PATH_EDIT, ['invoice_id' => $id]);
                $item[$this->getData('name')] = [
                    'is_invoice' => [
                        'href' => $this->urlBuilder->getUrl($url),
                        'target' => '_blank',
                        'label' => __('Yes & view')
                    ]
                ];
                }
            }
            else{
                $item[$this->getData('name')] = [
                    'is_invoice' => [
                        'label' => __('No')
                    ]
                ];
            }
        }
    }

        return $dataSource;
    }
}
