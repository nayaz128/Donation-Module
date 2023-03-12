<?php


namespace Navyug\DonationProduct\Block\Product\Type;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Navyug\DonationProduct\Helper\Data as DonationHelper;

/**
 * Class Donation
 * @package Navyug\DonationProduct\Block\Product\Type
 */
class Donation extends AbstractProduct
{
    /**
     * @var DonationHelper
     */
    protected $donationHelper;

    /**
     * Donation constructor.
     * @param Context $context
     * @param DonationHelper $donationHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        DonationHelper $donationHelper,
        array $data = []
    ) {

        $this->donationHelper = $donationHelper;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return int
     */
    public function getMinimalAmount()
    {
        return $this->donationHelper->getMinimalAmount($this->getProduct());
    }

    /**
     * @return int
     */
    public function getMaximalAmount()
    {
        return $this->donationHelper->getMaximalAmount($this->getProduct());
    }

    /**
     * @return mixed
     */
    public function getConfiguratorCode()
    {
        return $this->donationHelper->getConfiguratorCode($this->getProduct());
    }

    /**
     * @return mixed
     */
    public function getCurrencySymbol()
    {
        return $this->donationHelper->getCurrencySymbol();
    }

    /**
     * @return array
     */
    public function getFixedAmounts()
    {
        return $this->donationHelper->getFixedAmounts();
    }

    /**
     * @return string
     */
    public function getMinimalDonationAmount()
    {
        $minimalAmount = $this->donationHelper->getCurrencySymbol() . ' ';
        $minimalAmount .= $this->donationHelper->getMinimalAmount($this->getProduct());

        return $minimalAmount;
    }

    /**
     * @return string
     */
    public function getHtmlValidationClasses()
    {
        return $this->donationHelper->getHtmlValidationClasses($this->getProduct());
    }
}
