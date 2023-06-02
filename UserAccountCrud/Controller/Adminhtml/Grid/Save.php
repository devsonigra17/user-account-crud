<?php

namespace Dev\UserAccountCrud\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Dev\UserAccountCrud\Model\ViewFactory;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action
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
        $result = $this->resultJsonFactory->create();
        $data = $this->getRequest()->getParams(); 
        $id = $this->getRequest()->getParam('id');
        // echo "<pre>"; print_r($data); die("ffff");
        if(($id == true) && ($id != NULL))
        {
            $name = $data['name'];
            $gender = $data['gender'];
            if(isset($data['update_status']))
            {
                $status = $data['update_status'];
            }
            else{
                $status = 0;
            }

            $rowData = $this->viewFactory->create();
            $rowData->load($id, 'entity_id');
                $rowData->setName($name);
                $rowData->setGender($gender);
                $rowData->setStatus($status);
            if ($rowData->save()) {
                // $this->messageManager->addSuccessMessage(__('Bank details has been added.'));
                return $result->setData(['output' => 'true']);
            } else {
                // $this->messageManager->addErrorMessage(__('Something went wrong.'));
                return $result->setData(['output' => 'false']);
            }
            // $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            // $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $result;
        }
        else 
        {
            $name = $data['name'];
            $gender = $data['gender'];
            if(isset($data['status']))
            {
                $status = $data['status'];
            }
            else{
                $status = 0;
            }
            $rowData = $this->viewFactory->create();

            $rowData->setName($name);
            $rowData->setgender($gender);
            $rowData->setStatus($status);
            if ($rowData->save()) {
                $this->messageManager->addSuccessMessage(__('New Data Added Successfully...'));
            } else {
                $this->messageManager->addErrorMessage(__('Something went wrong.'));
            }
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
    }
}
