<?php


namespace Navyug\DonationProduct\Model;

use Navyug\DonationProduct\Model\ResourceModel\Donations as ResourceDonations;
use Magento\Framework\Exception\NoSuchEntityException;
use Navyug\DonationProduct\Model\ResourceModel\Donations\CollectionFactory as DonationsCollectionFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SortOrder;
use Navyug\DonationProduct\Api\DonationsRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Navyug\DonationProduct\Api\Data\DonationsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Navyug\DonationProduct\Api\Data\DonationsSearchResultsInterfaceFactory;

/**
 * Class DonationsRepository
 * @package Navyug\DonationProduct\Model
 */
class DonationsRepository implements donationsRepositoryInterface
{

    /**
     * @var ResourceDonations
     */
    protected $resource;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var DonationsCollectionFactory
     */
    protected $donationsCollectionFactory;

    /**
     * @var DonationsFactory
     */
    protected $donationsFactory;

    /**
     * @var DonationsInterfaceFactory
     */
    protected $dataDonationsFactory;

    /**
     * @var DonationsSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;


    /**
     * @param ResourceDonations $resource
     * @param DonationsFactory $donationsFactory
     * @param DonationsInterfaceFactory $dataDonationsFactory
     * @param DonationsCollectionFactory $donationsCollectionFactory
     * @param DonationsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceDonations $resource,
        DonationsFactory $donationsFactory,
        DonationsInterfaceFactory $dataDonationsFactory,
        DonationsCollectionFactory $donationsCollectionFactory,
        DonationsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->donationsFactory = $donationsFactory;
        $this->donationsCollectionFactory = $donationsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataDonationsFactory = $dataDonationsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Navyug\DonationProduct\Api\Data\DonationsInterface $donations
    ) {
        /* if (empty($donations->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $donations->setStoreId($storeId);
        } */
        try {
            $donations->getResource()->save($donations);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the donations: %1',
                $exception->getMessage()
            ));
        }
        return $donations;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($donationsId)
    {
        $donations = $this->donationsFactory->create();
        $donations->getResource()->load($donations, $donationsId);
        if (!$donations->getId()) {
            throw new NoSuchEntityException(__('Donations with id "%1" does not exist.', $donationsId));
        }
        return $donations;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->donationsCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
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
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Navyug\DonationProduct\Api\Data\DonationsInterface $donations
    ) {
        try {
            $donations->getResource()->delete($donations);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Donations: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($donationsId)
    {
        return $this->delete($this->getById($donationsId));
    }

    /**
     * {@inheritdoc}
     */
    public function getDonationsByOrderId($orderId)
    {
        /** @var \Navyug\DonationProduct\Model\Donations $donations */
        $collectionFactory = $this->donationsCollectionFactory->create()->addFieldToFilter('order_id', $orderId);

        return $collectionFactory;
    }
}
