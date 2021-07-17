<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Aks\Customers\Model\DataFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;

class Post extends Action
{
    /**
     * Show Customers page
     *
     * @return void
     */
    protected $_objectManager;
    /**
     * Show Customers page
     *
     * @return void
     */
    protected $_modelDataFactory;
    /**
     * Show Customers page
     *
     * @return void
     */
    protected $resultPageFactory;
    /**
     * Show Customers page
     *
     * @return void
     */
    protected $_sessionManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Aks\Customers\Model\Data
     * @param \Magento\Framework\View\Result\PageFactory
     * @param \Magento\Framework\Session\SessionManagerInterface
     */
    public function __construct(
        Context $context,
        DataFactory $modelDataFactory,
        PageFactory  $resultPageFactory,
        SessionManagerInterface $sessionManager,
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        parent::__construct($context);
        $this->_modelDataFactory = $modelDataFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
        $this->_objectManager = $objectManager;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect     = $this->resultRedirectFactory->create();
        $DataModel          = $this->_modelDataFactory->create();
        $data               = $this->getRequest()->getPost(); 
        if ($data) {      
            $DataModel->setData('name', $data['name']);
            $DataModel->setData('dob', $data['dob']);

            $DataModel->save();
            
            $this->messageManager->addSuccess(__('Your details have been inserted successfully.')); 
            $this->_redirect('signup');
        } else {
            $this->messageManager->addErrorMessage(__('Please check the Details'));
            $this->_redirect('signup');
        }
        
    }
}