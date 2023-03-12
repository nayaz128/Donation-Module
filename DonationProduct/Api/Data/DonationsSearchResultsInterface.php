<?php


namespace Navyug\DonationProduct\Api\Data;

/**
 * Interface DonationsSearchResultsInterface
 * @package Navyug\DonationProduct\Api\Data
 */
interface DonationsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Donations list.
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Navyug\DonationProduct\Api\Data\DonationsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
