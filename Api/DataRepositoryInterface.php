<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */
 
namespace Aks\Customers\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DataRepositoryInterface
{

    public function save(\Aks\Customers\Api\Data\DataInterface $data);
   
    
    public function getById($id);


    //public function getList(\Aks\Customers\Api\SearchCriteriaInterface $searchCriteria);
    
    
    public function delete(\Aks\Customers\Api\Data\DataInterface $data);

    
    public function deleteById($id);
}
