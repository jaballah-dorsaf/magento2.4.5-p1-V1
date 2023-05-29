<?php

namespace Mytek\ErpSynchronize\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface StockSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Mytek\ErpSynchronize\Api\Data\StockInterface[]
     */
    public function getItems();

    /**
     * @param \Mytek\ErpSynchronize\Api\Data\StockInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}