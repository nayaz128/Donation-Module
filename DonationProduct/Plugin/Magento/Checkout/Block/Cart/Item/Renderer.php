<?php


namespace Navyug\DonationProduct\Plugin\Magento\Checkout\Block\Cart\Item;

use Navyug\DonationProduct\Helper\Data;

/**
 * Class Renderer
 * @package Navyug\DonationProduct\Plugin\Magento\Checkout\Block\Cart\Item
 */
class Renderer
{

    /**
     * @var Data
     */
    protected $donationProductHelper;

    /**
     * Renderer constructor.
     * @param Data $donationProductHelper
     */
    public function __construct(
        Data $donationProductHelper
    ) {
    
        $this->donationProductHelper = $donationProductHelper;
    }

    /**
     * @param \Magento\Checkout\Block\Cart\Item\Renderer $subject
     * @param $result
     * @return array
     */
    public function afterGetProductOptions(
        \Magento\Checkout\Block\Cart\Item\Renderer $subject,
        $result
    ) {
        $item = $subject->getItem();
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

            return array_merge($options, $result);
        }

        return $result;
    }
}
