<?php


namespace Navyug\DonationProduct\Plugin\Magento\Catalog\Block\Product;

/**
 * Class ListProduct
 * @package Navyug\DonationProduct\Plugin\Magento\Catalog\Block\Product
 */
class ListProduct
{

    /**
     * @param \Magento\Catalog\Block\Product\ListProduct $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Product $product
     * @return mixed|string
     */
    public function aroundGetProductPrice(
        \Magento\Catalog\Block\Product\ListProduct $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product $product
    ) {
        if ($product->getTypeId()=='donation') {
            return '';
        }
        return $proceed($product);
    }
}
