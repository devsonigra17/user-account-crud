<?php

namespace Dev\UserAccountCrud\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        // print_r($id);exit;
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $name = "";
            try {
                $model = $this->_objectManager->create(\Dev\UserAccountCrud\Model\View::class);
                $model->load($id);
                $name = $model->getName();
                $model->delete();
                $this->messageManager->addSuccess(__('Name %1 has been deleted.',$name));
                $this->_eventManager->dispatch(
                    'adminhtml_crud_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                return $resultRedirect->setPath('usercrud/index/index');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_crud_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('usercrud/index/index', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a row to delete.'));
        // go to grid
        return $resultRedirect->setPath('usercrud/index/index');
    }
}
