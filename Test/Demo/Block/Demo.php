<?php
/**
 * @category   Test
 * @package    Test_Demo
 * @author     mohitvamja1991@gmail.com
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Test\Demo\Block;

/**
 * Demo content block
 */
class Demo extends \Magento\Framework\View\Element\Template
{
     protected $directoryBlock;
    protected $_isScopePrivate;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Block\Data $directoryBlock,
         array $data = []
    ) {
        parent::__construct($context,$data);
        $this->_isScopePrivate = true;
         $this->directoryBlock = $directoryBlock;
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Test Demo Module'));
        
        return parent::_prepareLayout();
    }
    public function getCountries()
    {
     $country = $this->directoryBlock->getCountryHtmlSelect();
     return $country;
    }
    public function getRegion()
    {
     $region = $this->directoryBlock->getRegionHtmlSelect();
     return $region;
    }
     public function getCountryAction()
        {
     return $this->getUrl('demo/index/country', ['_secure' => true]);
        }
    }
