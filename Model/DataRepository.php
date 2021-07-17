<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Model;

use Aks\Customers\Api\Data\DataSearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\DataObjectHelper;
use Aks\Customers\Api\Data\DataInterfaceFactory;
use Aks\Customers\Api\DataRepositoryInterface;
use Aks\Customers\Model\ResourceModel\Data\CollectionFactory as DataCollectionFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Aks\Customers\Model\ResourceModel\Data as ResourceData;
use Magento\Framework\Api\SortOrder;
use Magento\Store\Model\StoreManagerInterface;

class DataRepository implements DataRepositoryInterface
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Aks\Customers\Model\ResourceModel\Data
     */
    private $resource;

    /**
     * @var \Aks\Customers\Model\ResourceModel\Data
     */
    private $DataFactory;

    /**
     * @var \Aks\Customers\Model\ResourceModel\Data\CollectionFactory
     */
    private $DataCollectionFactory;

    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var \Aks\Customers\Api\Data\DataInterfaceFactory
     */
    private $dataDataFactory;

    /**
     * @var \Aks\Customers\Api\Data\DataSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @param ResourceData $resource
     * @param DataFactory $dataFactory
     * @param DataInterfaceFactory $dataDataFactory
     * @param DataCollectionFactory $dataCollectionFactory
     * @param DataSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceData $resource,
        DataFactory $dataFactory,
        DataInterfaceFactory $dataDataFactory,
        DataCollectionFactory $dataCollectionFactory,
        DataSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->dataFactory = $dataFactory;
        $this->dataCollectionFactory = $dataCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataDataFactory = $dataDataFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Aks\Customers\Api\Data\DataInterface $data)
    {
        try {
            $data->getResource()->save($data);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the data: %1',
                $exception->getMessage()
            ));
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($dataId)
    {
        $data = $this->dataFactory->create();
        $data->getResource()->load($data, $dataId);
        if (!$data->getId()) {
            throw new NoSuchEntityException(__('Data with id "%1" does not exist.', $dataId));
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->dataCollectionFactory->create();
        
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setData($collection->getData());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Aks\Customers\Api\Data\DataInterface $data)
    {
        try {
            $data->getResource()->delete($data);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Data: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($dataId)
    {
        return $this->delete($this->getById($dataId));
    }
}
