<?php

namespace Mytek\ErpSynchronize\Model\ResourceModel;

class Warehouse extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'REF_ARTICLE';
    protected $_isPkAutoIncrement = false;



    protected function _construct()
    {
        $this->_init('mytek_erp_warehouse','REF_ARTICLE,DEPO');
    }
}