<?php


namespace Navyug\DonationProduct\Plugin\Magento\Catalog\Helper\Product;

use Navyug\DonationProduct\Helper\Data;

/**
 * Class Configuration
 * @package Navyug\DonationProduct\Plugin\Magento\Catalog\Helper\Product
 */
class Configuration
{
    /**
     * @var Data
     */
    protected $donationProductHelper;

    /**
     * Configuration constructor.
     * @param Data $donationProductHelper
     */
    public function __construct(
        Data $donationProductHelper
    ) {
        $this->donationProductHelper = $donationProductHelper;
    }

    /**
     * @param \Magento\Catalog\Helper\Product\Configuration $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Product\Configuration\Item\ItemInterface $item
     * @return array|mixed
     */
    public function aroundGetOptions(
        \Magento\Catalog\Helper\Product\Configuration $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product\Configuration\Item\ItemInterface $item
    ) {

        $product = $item->getProduct();
        $typeId = $product->getTypeId();
        if ($typeId == \Navyug\DonationProduct\Model\Product\Type\Donation::TYPE_CODE) {
            $itemOption = $item->getOptionByCode(Data::DONATION_OPTION_CODE);
            $options = [];
            $showOptionsInCart = false;

            if ($itemOption && $showOptionsInCart) {
                $options = $this->donationProductHelper->optionsJsonToMagentoOptionsArray(
                    $itemOption->getValue(),
                    $product
                );
            }

            return array_merge($options, $proceed($item));
        }

        return $proceed($item);
    }
}
