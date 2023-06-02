<?php

namespace Dev\UserAccountCrud\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class View extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_account_crud', 'entity_id');
    }
}