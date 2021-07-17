<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Model;

use Aks\Customers\Api\Data\DataInterface;

class Data extends \Magento\Framework\Model\AbstractModel implements DataInterface
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Aks\Customers\Model\ResourceModel\Data');
    }

    /**
     * Get customers_id
     * @return string
     */
    public function getCustomersId()
    {
        return $this->getData(self::CUSTOMERS_ID);
    }

    /**
     * Set customers_id
     * @param string $customers_id
     * @return \Aks\Customers\Api\Data\DataInterface
     */
    public function setCustomersId($customers_id)
    {
        return $this->setData(self::CUSTOMERS_ID, $customers_id);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Aks\Customers\Api\Data\DataInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get dob
     * @return string
     */
    public function getDob()
    {
        return $this->getData(self::DOB);
    }

    /**
     * Set dob
     * @param string $dob
     * @return \Aks\Customers\Api\Data\VENDOR_NAME
     */
    public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }
    

}