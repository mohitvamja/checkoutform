<?php
/**
 * @category   Test
 * @package    Test_Demo
 * @author     mohitvamja1991@gmail.com
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Test\Demo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

class Ordercsv extends Action
{
	protected $orderCollectionFactory;

	public function __construct(
        Context $context,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        parent::__construct($context);
    }
 
    public function execute()
    {
        $filepath = 'export/customerlist.csv';
        $this->directory->create('export');
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();

        $header = ['EmailID', 'CustomerName'];
        $stream->writeCsv($header);

        $now = new \DateTime();
        $collection = $this->orderCollectionFactory->create()->addFieldToSelect(array('*'))->addFieldToFilter('created_at', ['lteq' => $now->format('2023-06-01 H:i:s')])->addFieldToFilter('created_at', ['gteq' => $now->format('2023-05-01 H:i:s')]);
        // $collection->addFieldToSelect(array('*');
        // 	$collection->addFieldToFilter('created_at', ['lteq' => $now->format('2023-06-01 H:i:s')])->addFieldToFilter('created_at', ['gteq' => $now->format('2023-05-01 H:i:s')]);

        foreach ($collection as $customer) {
            $data = [];
            $data[] = $customer->getCustomerEmail();
            $data[] = $customer->getCustomerName();
            $stream->writeCsv($data);
        }
    }
}
