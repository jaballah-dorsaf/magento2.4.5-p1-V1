<?php

namespace Mytek\ErpSynchronize\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface WarehouseSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Mytek\ErpSynchronize\Api\Data\WarehouseInterface[]
     */
    public function getItems();

    /**
     * @param \Mytek\ErpSynchronize\Api\Data\WarehouseInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}