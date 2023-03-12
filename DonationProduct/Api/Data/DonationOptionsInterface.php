<?php

namespace Navyug\DonationProduct\Api\Data;

/**
 * Interface DonationOptionsInterface
 * @package Navyug\DonationProduct\Api\Data
 */
interface DonationOptionsInterface
{

    const AMOUNT = 'amount';

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     * @param string $amount
     * @return \Navyug\DonationProduct\Api\Data\DonationOptionsInterface
     */
    public function setAmount($amount);
}
