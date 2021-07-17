<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class DepartmentActions
 */
class DataActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $data) {
                $data[$this->getData('name')]['edit'] = [
                   'href' => $this->urlBuilder->getUrl(
                       'customers/data/edit',
                       ['customers_id' => $data['customers_id']]
                   ),
                   'label' => __('Edit'),
                   'hidden' => false,
               ];
                $data[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'customers/data/delete',
                        ['customers_id' => $data['customers_id']]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete Customers Data'),
                        'message' => __('Are you sure you wan\'t to delete a Custom Catalog Data?')
                    ],
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
