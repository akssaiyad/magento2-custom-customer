<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Api\Data;

interface DataInterface
{

    const CUSTOMER_ID   = 'customer_id';
    const NAME          = 'name';
    const DOB           = 'dob';

    
    /**
     * Get customers_id
     * @return void
     */
    public function getCustomersId();

    
    /**
     * Set customers_id
     * @param string $customers_id
     * @return \Aks\Customers\Api\Data\DataInterface
     */
    public function setCustomersId($customers_id);

    /**
     * Get name
     * @return void
     */
    public function getName();

    
    /**
     * Set name
     * @param string $name
     * @return \Aks\Customers\Api\Data\DataInterface
     */
    public function setName($name);

    
    /**
     * Get dob
     * @return string|null
     */
    public function getDob();

   
    /**
     * Set dob
     * @param string $dob
     * @return \Aks\Customers\Api\Data\DataInterface
     */
    public function setDob($dob);
    
}
