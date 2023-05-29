<?php
    namespace Mytek\ErpSynchronize\Model;

    use \Mytek\ErpSynchronize\Api\Data\WarehouseInterface;
    use \Magento\Framework\Api\SearchCriteriaInterface;
    use \Magento\Framework\Exception\CouldNotSaveException;
    use \Magento\Framework\Exception\NoSuchEntityException;
    use \Magento\Framework\Exception\CouldNotDeleteException;

    class WarehouseRepository implements \Mytek\ErpSynchronize\Api\WarehouseRepositoryInterface
    {
        protected $objectFactory;

        protected $objectResourceModel;

        protected $collectionFactory;

        protected $searchResultsFactory;

        protected $_productRepository;

        protected $logger;


        public function __construct(
            \Mytek\ErpSynchronize\Model\WarehouseFactory $objectFactory,
            \Mytek\ErpSynchronize\Model\ResourceModel\Warehouse  $objectResourceModel,
            \Mytek\ErpSynchronize\Model\ResourceModel\Warehouse\CollectionFactory $collectionFactory,
            \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultsFactory,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Psr\Log\LoggerInterface $logger

        ) {
            $this->objectFactory        = $objectFactory;
            $this->objectResourceModel  = $objectResourceModel;
            $this->collectionFactory    = $collectionFactory;
            $this->searchResultsFactory = $searchResultsFactory;
            $this->_productRepository   = $productRepository;
            $this->logger = $logger;


        }

        public function save(WarehouseInterface $object)
        {
 
        }


        public function save_multi(array $WarehouseItems){


                return true; 
        }



        /**
         * @inheritdoc
         */
        public function getById($id)
        {

        }

        public function delete(WarehouseInterface $object)
        {

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
   
        }
    }