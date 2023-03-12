<?php


namespace Navyug\DonationProduct\Api;

/**
 * Interface DonationsRepositoryInterface
 * @package Navyug\DonationProduct\Api
 */
interface DonationsRepositoryInterface
{


    /**
     * Save Donations
     * @param \Navyug\DonationProduct\Api\Data\DonationsInterface $donations
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Navyug\DonationProduct\Api\Data\DonationsInterface $donations
    );

    /**
     * Retrieve Donations
     * @param string $donationsId
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($donationsId);

    /**
     * Retrieve Donations matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Navyug\DonationProduct\Api\Data\DonationsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Donations
     * @param \Navyug\DonationProduct\Api\Data\DonationsInterface $donations
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Navyug\DonationProduct\Api\Data\DonationsInterface $donations
    );

    /**
     * Delete Donations by ID
     * @param string $donationsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($donationsId);
}
