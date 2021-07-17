<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Controller\Adminhtml\Data;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Aks\Customers\Model\Data
     */
    private $itemsModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Aks\Customers\Model\Data
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Aks\Customers\Model\Data $itemsModel,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->itemsModel = $itemsModel;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
                if ($data) {
            $id = $this->getRequest()->getParam('customers_id');
        
            $model = $this->itemsModel->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Customers Data no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Customers Data.'));
                $this->dataPersistor->clear('customers_data');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['customers_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager
                ->addExceptionMessage($e, __('Something went wrong while saving the Customers Data please check already available data.'));
            }
        
            $this->dataPersistor->set('customers_data', $data);
            return $resultRedirect->setPath('*/*/edit',
                [
                    'customers_id' => $this->getRequest()->getParam('customers_id')
                ]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }

}
