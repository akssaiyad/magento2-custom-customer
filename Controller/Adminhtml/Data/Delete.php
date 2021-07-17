<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Controller\Adminhtml\Data;

class Delete extends \Aks\Customers\Controller\Adminhtml\Data
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('customers_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Aks\Customers\Model\Data');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Customers Data.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['customers_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Customers Data to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
