<?php

namespace Dev\UserAccountCrud\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Dev\UserAccountCrud\Model\ViewFactory;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Framework\App\Action\Action
{ 
    protected $resultJsonFactory;
    protected $fileFactory;
    protected $viewFactory;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        ViewFactory $viewFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager

    ) {
        $this->fileFactory = $fileFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->viewFactory = $viewFactory;
        $this->messageManager = $messageManager;
        return parent::__construct($context);
    }

    public function execute()
    {  
        try {
           $result = $this->resultJsonFactory->create();
           $data = $this->getRequest()->getParams();
           $id = $this->getRequest()->getParam('id');
           if($id){
                $rowData = $this->viewFactory->create();
                $rowData->load($id, 'entity_id');
                if ($rowData->delete()) {
                    
                    $this->messageManager->addSuccessMessage(__('Data has been deleted...'));
                    // return $result->setData(['output' => 'true']);
                } else {
                    $this->messageManager->addErrorMessage(__('Something went wrong.'));
                    // return $result->setData(['output' => 'false']);
                }
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }
        }catch (\Exception $e) {
            return $result->setData($e->getMessage());
        }
    }
}
