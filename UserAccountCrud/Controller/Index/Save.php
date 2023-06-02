<?php

namespace Dev\UserAccountCrud\Controller\Index;

use Magento\Framework\Message\ManagerInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $customFactory;
    protected $messageManager;
    protected $resultJsonFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Dev\UserAccountCrud\Model\ViewFactory $customFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        parent::__construct($context);
        $this->customFactory = $customFactory;
        $this->messageManager = $messageManager;
        $this->resultJsonFactory = $resultJsonFactory;
    }
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $data = $this->getRequest()->getParams();
        // echo "<pre>";print_r($data);exit;
        $model = $this->customFactory->create();
        $id = $data['entity_id'];        

        try {
            if($id!=NULL)
            {
                $model->addData([
                    'entity_id' => $data['entity_id'],
                    'name' => $data['name'],
                    'gender' => $data['gender'],
                    'status' => $data['status']
                ]);
            }
            if($id==null)
            {
                $model->addData([
                    'name' => $data['name'],
                    'gender' => $data['gender'],
                    'status' => $data['status']
                ]);
            }
            $saveData = $model->save();
    
            if($saveData)
            {
                if($id==null)
                {
                    return $result->setData(['output' => 'true']);
                }
                if($id!=null)
                {
                    return true;
                }

            }
        }catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('usercrud/index/index');
    }
 
}