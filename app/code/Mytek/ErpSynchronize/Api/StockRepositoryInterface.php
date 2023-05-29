<?php
namespace Mytek\ErpSynchronize\Api;

use \Mytek\ErpSynchronize\Api\Data\StockInterface;

use \Magento\Framework\Api\SearchCriteriaInterface;

interface StockRepositoryInterface
{
    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\StockInterface $Stock
     * @return \Mytek\ErpSynchronize\Api\Data\StockInterface
     */
    public function save(StockInterface $Stock);


    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\StockInterface[] $stockItems
     * @return bool
     */
    public function save_multi(array $stockItems);    


    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\StockInterface $Stock
     * @return \Mytek\ErpSynchronize\Api\Data\StockInterface
     */
    public function delete(StockInterface $Stock);

    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\StockInterface $id
     * @return void
     */
    public function deleteById($id);

    /**
     * @api
     * @param string $id
     * @return \Mytek\ErpSynchronize\Api\Data\StockInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Mytek\ErpSynchronize\Api\Data\StockSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);
}