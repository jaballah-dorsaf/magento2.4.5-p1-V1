<?php
namespace Mytek\ErpSynchronize\Api;

use \Mytek\ErpSynchronize\Api\Data\WarehouseInterface;

use \Magento\Framework\Api\SearchCriteriaInterface;

interface WarehouseRepositoryInterface
{
    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\WarehouseInterface $wharehouse
     * @return \Mytek\ErpSynchronize\Api\Data\WarehouseInterface
     */
    public function save(WarehouseInterface $wharehouse);


    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\WarehouseInterface[] $warehouseItems
     * @return bool
     */
    public function save_multi(array $warehouseItems);    


    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\WarehouseInterface $wharehouse
     * @return \Mytek\ErpSynchronize\Api\Data\WarehouseInterface
     */
    public function delete(WarehouseInterface $wharehouse);

    /**
     * @api
     * @param \Mytek\ErpSynchronize\Api\Data\WarehouseInterface $id
     * @return void
     */
    public function deleteById($id);

    /**
     * @api
     * @param int $id
     * @return \Mytek\ErpSynchronize\Api\Data\WarehouseInterface
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