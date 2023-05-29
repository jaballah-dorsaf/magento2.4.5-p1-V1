<?php

namespace Mytek\ErpSynchronize\Model\ResourceModel\Warehouse;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'REF_ARTICLE';
    protected $_eventPrefix = 'mytek_erp_warehouse_collection';
    protected $_eventObject = 'warehouse_collection';

    protected function _construct()
    {
        $this->_init('Mytek\ErpSynchronize\Model\Warehouse', 'Mytek\ErpSynchronize\Model\ResourceModel\Warehouse');
    }
}