<?php

/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Block;  

class FooterLink extends \Magento\Framework\View\Element\Html\Link
{
    public function _toHtml() 
    {
        if (
            !$this->_scopeConfig->isSetFlag('customerstab/general/enable') || 
            !$this->_scopeConfig->isSetFlag('customerstab/general/footerlink')
        ) {
            return '';
        }
        return parent::_toHtml();
    }
}
