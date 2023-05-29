<?php
    namespace Mytek\ErpSynchronize\Model;

    use \Mytek\ErpSynchronize\Api\Data\StockInterface;
    use \Magento\Framework\Api\SearchCriteriaInterface;
    use \Magento\Framework\Exception\CouldNotSaveException;
    use \Magento\Framework\Exception\NoSuchEntityException;
    use \Magento\Framework\Exception\CouldNotDeleteException;

    class StockRepository implements \Mytek\ErpSynchronize\Api\StockRepositoryInterface
    {
        protected $objectFactory;

        protected $objectResourceModel;

        protected $collectionFactory;
        protected $wsCollectionFactory;

        protected $searchResultsFactory;

        protected $_productRepository;

        protected $logger;

        protected $warehouseResourceModel;

        protected $resourceConnection;

        protected $MSG_ZERO_STK;
 

        protected $_curl;

        private $fullPageCache;
        protected $categoryRepository;
        protected $categoryHelper;




        public function __construct(
            \Mytek\ErpSynchronize\Model\StockFactory $objectFactory,
            \Mytek\ErpSynchronize\Model\ResourceModel\Stock $objectResourceModel,
            \Mytek\ErpSynchronize\Model\ResourceModel\Stock\CollectionFactory $collectionFactory,
            \Mytek\ErpSynchronize\Model\ResourceModel\Warehouse\CollectionFactory $wsCollectionFactory,
            \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultsFactory,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Psr\Log\LoggerInterface $logger,
            \Mytek\ErpSynchronize\Model\ResourceModel\Warehouse  $warehouseResourceModel,
            \Magento\Framework\App\ResourceConnection $resourceConnection,
            \Magento\Framework\HTTP\Client\Curl $curl,
            \Magento\Catalog\Helper\Category $categoryHelper,
            \Magento\Catalog\Model\CategoryRepository $categoryRepository

        ) {
            $this->objectFactory        = $objectFactory;
            $this->objectResourceModel  = $objectResourceModel;
            $this->collectionFactory    = $collectionFactory;
            $this->wsCollectionFactory  = $wsCollectionFactory;
            $this->searchResultsFactory = $searchResultsFactory;
            $this->_productRepository   = $productRepository;
            $this->logger = $logger;
            $this->warehouseResourceModel = $warehouseResourceModel;
            $this->resourceConnection = $resourceConnection;
            $this->_curl = $curl;
            $this->categoryHelper = $categoryHelper;
            $this->categoryRepository = $categoryRepository;



        }

       


        public function save(StockInterface $object)
        {

            try {
                $_update_date= time();
                $object->setUPDATEDDATE($_update_date);
                $this->objectResourceModel->save($object);
                $this->logger->debug("debug1234== stock saved ".$object->getCODE());
                $total_stock = $this->updateWarehouses($object);
                $this->updateProduct($object, $total_stock);
       
        
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__($e->getMessage()));
                // $this->logger->critical($product);
            }
            return $object;
        }


   



        public function updateProduct(StockInterface $object, $total_stock){
            # Possible value of $_MSGZEROSTK : 
            # 5442 => in_stock => En stock
            # 5443 => out_of_stock => Epuisé
            # 5444 => preorder => Sur commande 48h
            # 5445 => backorder => En arrivage
            $wss=$object->getWarehouses() ;
            $dataStatus=array();
            foreach ($wss as $item) {
                array_push($dataStatus,$item->getMSGZEROSTK());
            }
           
            $_MSGZEROSTK = getenv('MK_IN_STOCK'); 

            $product = $this->_productRepository->get($object->getCODE());
                $_qty = 10000;
                $_is_in_stock = 1;              
                if( $total_stock == 0 ){
                    foreach ($dataStatus as $value) {
                        if($value == "EN ARRIVAGE"){
                            $_is_in_stock = 1;
                            // $_MSGZEROSTK = "En stock"; 
                            $_MSGZEROSTK = "5445"; 
                            break; 
                        }elseif($value == "COMMANDE 48h"){
                            $_is_in_stock = 1;
                            // $_MSGZEROSTK = "En stock"; 
                            $_MSGZEROSTK = "5444"; 
                            break; 
                        }else{
                            $_is_in_stock = 0;
                            // $_MSGZEROSTK = "Epuisé";
                            $_MSGZEROSTK = "5443";
                        }
                    }        
                }
                else{
                        $_is_in_stock = 1;
                        // $_MSGZEROSTK = "En stock"; 
                        $_MSGZEROSTK = "5442";         
                }
           
            $this->logger->debug("debug1234 == stock status set is   = ".$_MSGZEROSTK);
            // # fix bug shortDescription not updated when ERPSynchronize module is active            
            $_short_description = $product->getData('short_description');
            $product->setPrice($object->getPRIX())
                    ->setSpecialPrice($this->getFormatedSpecialPrice($object))
                    ->setStoreId(0)
                    ->setShortDescription($_short_description)
                    ->setStockData([
                                'use_config_manage_stock' => 0,
                                'manage_stock' => 1,
                                'use_config_notify_stock_qty' => 0,
                                'qty' => $_qty, 
                                'is_qty_decimal' => 0, 
                                'is_in_stock' => $_is_in_stock
                                
                    ])
                    ->setErpstock($_MSGZEROSTK)
                    ->setGtin($object->getCODEBARRES());
                    // ->$product->setData('erpstock', '12774');
                    // $product->setErpstock($attributeValue[$_MSGZEROSTK]);
                    // $product->setErpstock($_MSGZEROSTK);

            $product->save();
            //var_dump('----------------------------------------------');
            //var_dump($product);
            //var_dump('----------------------------------------------');

            // disable/enable cache unvalidation
            // $this->unvalidate_cache_varnish($product);


        }


        public function unvalidate_cache_varnish($product){
            // unvalidate product pages 
            if($product->getProductUrl()){
                $pieces = explode("/", $product->getProductUrl());
                $product_url = getenv('BASE_URL_SECURE').$pieces[sizeof($pieces)-2].".html";
                $this->logger->info("debug1234 == sending invalidate cache for page   = ".$product_url);
                # send instruction to varnish to clear cache 
                $this->_curl->addHeader("x-amasty-crawler-status", "crawl");
                $this->_curl->get($product_url);
            }

            // unvalidate gategory pages    
            $this->getCategoryIds($product);

        }

        public function getCategoryIds($product){
            $categories = $product->getCategoryIds(); 
            /*will return category ids array*/
            foreach($categories as $category){

            //     $cat = $this->objectManager->create('Magento\Catalog\Model\Category')->load($category);

            //     echo $cat->getName();
                // $this->logger->info("debug12345 == categorie recuperée   = ".$cat->getName());
                $this->logger->info("debug12345 == categorie recuperée   = ".$category);
                $categoryObj = $this->categoryRepository->get($category);
                $url_cat = $this->categoryHelper->getCategoryUrl($categoryObj);
                $this->logger->info("debug12345 == categorie recuperée url   = ".$url_cat);

                if($url_cat){
                    // $pieces = explode("/", $product->getProductUrl());
                    // $product_url = getenv('BASE_URL_SECURE').$pieces[sizeof($pieces)-2].".html";
                    $this->logger->info("debug1234 == sending invalidate cache for page   = ".$url_cat);
                    # send instruction to varnish to clear cache 
                    $this->_curl->addHeader("x-amasty-crawler-status", "crawl");
                    $this->_curl->get($url_cat);
                }


                }


        }
        


        public function getAttrOptIdByLabel($attrCode,$optLabel, $product)
        {
            // $product = $this->productFactory->create();
            $isAttrExist = $product->getResource()->getAttribute($attrCode); // Add here your attribute code
            $optId = ''; 
            if ($isAttrExist && $isAttrExist->usesSource()) {
                $optId = $isAttrExist->getSource()->getOptionId($optLabel);
            }
            return $optId;
        }

        public function updateShortDescription($sku, $short_description){
            $product = $this->_productRepository->get($sku);
            $product->setShortDescription($short_description);
            $product->save();


        }

        // because divalto send reduction instead of specialPrice
        public function getFormatedSpecialPrice($obj){
            $_specicialPrice="";
            if($obj->getPRIXSPECIFIQUE()>0){
                $_specicialPrice = $obj->getPRIX() - $obj->getPRIXSPECIFIQUE();
                return $_specicialPrice;
            }
            
            return $_specicialPrice;


        }

        public function updateWarehouses(StockInterface $object){

            $list_depos = array();
            $connection  = $this->resourceConnection->getConnection();
            $tableName = $connection->getTableName("mytek_erp_warehouse");
            $ws=$object->getWarehouses() ;
            $total_stock=0;
            $this->MSG_ZERO_STK = 'NONE';
            foreach ($ws as $item) {
                // $this->logger->debug("debug1234-multi depo ==".$item->getDEPO());
                $this->MSG_ZERO_STK = $item->getMSGZEROSTK();
                $data = [
                            "REF_ARTICLE"=>$object->getCODE(), 
                            "DEPO"=>$item->getDEPO(), 
                            "QTESTK"=>$item->getQTESTK(),
                            "MSG_ZERO_STK"=>$item->getMSGZEROSTK()
                        ];

                $updatedRows=$connection->insertOnDuplicate($tableName, $data);
                $this->logger->debug("debug1234-code =="."Updated Rows : ".$updatedRows);
                $total_stock +=(int)$item->getQTESTK();
            }
            $this->logger->debug("debug1234-code =="."total_stock = : ".$total_stock);
            return $total_stock;
                // $this->logger->debug("debug1234-code ==".$object->getCODE());
                // $data = ["REF_ARTICLE"=>$object->getCODE(), "DEPO"=>"M04", "QTESTK"=>"44","MSG_ZERO_STK"=>"toto"];
                // $where = ['REF_ARTICLE = ?' => $object->getCODE(), 'DEPO'=>'M03'];


        }

        public function loadByMultiple($DEPO, $REF_ARTICLE){
            $collection = $this->wsCollectionFactory->create();
            $collection->addFieldToFilter('DEPO', $DEPO)
                       ->addFieldToFilter('REF_ARTICLE', $REF_ARTICLE);

                       
            // return $collection->getFirstItem();
            return $collection;
        }

     

        public function loadByREF_ARTICLE($REF_ARTICLE){
            $collection = $this->wsCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->setPageSize(3); // fetching only 3 products


            // return $collection->getFirstItem();
            return $collection;
        }

        public function loadBySKU($REF_ARTICLE){
            $collection = $this->wsCollectionFactory->create();
            // $collection->addFieldToFilter('REF_ARTICLE', $REF_ARTICLE);
            $collection->addFieldToSelect('*');
            $collection->getSelect()->where('REF_ARTICLE='.$REF_ARTICLE);

                       
            // return $collection->getFirstItem();
            return $collection;
        }

        public function save_multi(array $stockItems){
            try{

                foreach ($stockItems as $items) {
                    // $this->stockItemRepo->save($stockItems);
                    $this->objectResourceModel->save($items);
                    $this->logger->debug("debug1234 multi ==".$items->getCODE());
                    $product = $this->_productRepository->get($items->getCODE());
                    $product->save();
                }

            } catch (\Exception $e) {
                throw new CouldNotSaveException(__($e->getMessage()));
                // $this->logger->critical($product);
            }

                return true; 
        }

        function attributeValueExists( $arg_attribute, $arg_value ) {

            $object_Manager = \Magento\Framework\App\ObjectManager::getInstance();
            $eavConfig = $object_Manager->get('\Magento\Eav\Model\Config');
            $attribute = $eavConfig->getAttribute('catalog_product', $arg_attribute);
            $options = $attribute->getSource()->getAllOptions();         
            // $optionsExists = array();            
            foreach($options as $option) {
                // $optionsExists[] = $option['label'];
                if($option['label'] == $arg_value){
                    $this->logger->debug("debug1234 returning optionfound: ".$option['value']);
                    return $option['value'];
                }
            }
            
            return false;
         
        }

        // public function attributeValueExists($arg_attribute, $arg_value)
        // {
        //     $eavConfig = $object_Manager->get('\Magento\Eav\Model\Config');
        //     $attribute = $eavConfig->getAttribute('catalog_product', 'color');

        //     $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        //     $model = $objectManager->get('\Namespace\Modulename\Model\Modulename');
        //     $attribute_model        = Mage::getModel('eav/entity_attribute');
        //     $attribute_options_model= Mage::getModel('eav/entity_attribute_source_table') ;

        //     $attribute_code         = $attribute_model->getIdByCode('catalog_product', $arg_attribute);
        //     $attribute              = $attribute_model->load($attribute_code);

        //     $attribute_table        = $attribute_options_model->setAttribute($attribute);
        //     $options                = $attribute_options_model->getAllOptions(false);

        //     foreach($options as $option)
        //     {
        //         if ($option['label'] == $arg_value)
        //         {
        //             return $option['value'];
        //         }
        //     }

        //     return false;
        // }

        


 
        /**
         * @inheritdoc
         */
        public function getById($id)
        {   
            $db = $this->resourceConnection->getConnection();
            $result = $db->query("SELECT *  FROM mytek_erp_synchronize ms ,mytek_erp_warehouse mw
            where ms.CODE='".$id."' and ms.CODE=mw.REF_ARTICLE");
           
           return $result;

        }

        public function removeById($id)
        {   
            $db = $this->resourceConnection->getConnection();
            $result = $db->query("DELETE   FROM mytek_erp_synchronize  where CODE='".$id."'");
           
           return $result;

        }

    //     public function working()
    // {
    //     $db     = $this->resourceConnection->getConnection();
    //     $result = $db->query('SELECT *  FROM mytek_erp_synchronize ms ,mytek_erp_warehouse mw
    //       where ms.CODE="82C6006GFE" and ms.CODE=mw.REF_ARTICLE');

    //     while($row = $result->fetch())
    //     {
    //         var_dump($row);
    //     }
    //     exit;        
    // }    

        



        public function delete(StockInterface $object)
        {
            try {
                $this->objectResourceModel->delete($object);
            } catch (\Exception $exception) {
                throw new CouldNotDeleteException(__($exception->getMessage()));
            }
            return true;
        }

        public function deleteById($id)
        {
            return $this->delete($this->getById($id));
        }

        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $criteria)
        {
            $searchResults = $this->searchResultsFactory->create();
            $searchResults->setSearchCriteria($criteria);
            $collection = $this->collectionFactory->create();
            foreach ($criteria->getFilterGroups() as $filterGroup) {
                $fields = [];
                $conditions = [];
                foreach ($filterGroup->getFilters() as $filter) {
                    $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                    $fields[] = $filter->getField();
                    $conditions[] = [$condition => $filter->getValue()];
                }
                if ($fields) {
                    $collection->addFieldToFilter($fields, $conditions);
                }
            }
            $searchResults->setTotalCount($collection->getSize());
            $sortOrders = $criteria->getSortOrders();
            if ($sortOrders) {
                /** @var SortOrder $sortOrder */
                foreach ($sortOrders as $sortOrder) {
                    $collection->addOrder(
                        $sortOrder->getField(),
                        ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                    );
                }
            }
            $collection->setCurPage($criteria->getCurrentPage());
            $collection->setPageSize($criteria->getPageSize());
            $objects = [];
            foreach ($collection as $objectModel) {
                $objects[] = $objectModel;
            }
            $searchResults->setItems($objects);
            return $searchResults;
        }
    }