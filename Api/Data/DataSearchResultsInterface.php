<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Api\Data;

interface DataSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    public function getData();
   
    public function setData(array $data);
}
