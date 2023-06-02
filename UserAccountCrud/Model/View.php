<?php

namespace Dev\UserAccountCrud\Model;

use \Magento\Framework\Model\AbstractModel;

class View extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Dev\UserAccountCrud\Model\ResourceModel\View');
    }
}