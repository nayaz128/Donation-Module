<?php


namespace Navyug\DonationProduct\Model;

use Navyug\DonationProduct\Api\Data\DonationOptionsInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class DonationOptions
 * @package Navyug\DonationProduct\Model
 */
class DonationOptions extends AbstractExtensibleModel implements DonationOptionsInterface
{

    /**
     * Get amount
     * @return string
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * Set amount
     * @param string $amount
     * @return \Navyug\DonationProduct\Api\Data\ConfiguratorOptionsInterface
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }
}
