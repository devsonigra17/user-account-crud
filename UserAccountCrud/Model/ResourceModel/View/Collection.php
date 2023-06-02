<?php
namespace Dev\UserAccountCrud\Model\ResourceModel\View;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Dev\UserAccountCrud\Model\View::class, \Dev\UserAccountCrud\Model\ResourceModel\View::class);
    }
}