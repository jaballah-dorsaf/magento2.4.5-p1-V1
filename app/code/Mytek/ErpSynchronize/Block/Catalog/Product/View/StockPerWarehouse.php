<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mytek\ErpSynchronize\Block\Catalog\Product\View;
// use Magento\Framework\DataObject\IdentityInterface;



class StockPerWarehouse extends \Magento\Framework\View\Element\Template  
	// implements IdentityInterface
{
	// protected $_order_id;
    protected $stockRepository;
	protected $wsCollectionFactory;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mytek\ErpSynchronize\Model\StockRepository $stockRepository,
		\Mytek\ErpSynchronize\Model\ResourceModel\Warehouse\CollectionFactory $wsCollectionFactory
        )
	{
		parent::__construct($context);
        $this->stockRepository = $stockRepository;
		$this->wsCollectionFactory  = $wsCollectionFactory;

	}

	
    // public function getStockBySKU($depo,$sku){
    //     return $this->stockRepository->loadByMultiple($depo, $sku);
    // }

	// public function getStockBySKU($sku){
	// 	$collection = $this->wsCollectionFactory->create();
    //         // $collection->addFieldToFilter('REF_ARTICLE', $REF_ARTICLE);
	// 	$collection->clear();
	// 	$collection->addFieldToSelect('*')
	// 				->addFieldToFilter('REF_ARTICLE', ['eq'=> $sku])
	// 				->getSelect();


	// 	// return $collection->getFirstItem();
	// 	return $collection;

	// }

	public function getStockBySKU($sku){
		// $_result =  $this->stockRepository->getById($sku);
		// $ws_array = $_result->fetchAll();
		// echo "<pre>";
		// print_r($ws_array);
		// echo "</pre>";
		// echo date('l jS \of F Y h:i:s A');
		// exit;

	  return  $this->stockRepository->getById($sku);
	
	}

	// public function getStockBySKU($sku){
    //     return $this->loadBySKU($sku);
    // }

 

	// public function getIdentities()
    // {
    //     return [\Magento\Cms\Model\Page::CACHE_TAG . '_' . $this->getPage()->getId()];
    // }


}