<?php


namespace Navyug\DonationProduct\Observer\Sales;

use Navyug\DonationProduct\Model\Product\Type\Donation;

class QuoteItemSaveBefore implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        /* @var $item \Magento\Quote\Model\Quote\Item */

        $item = $observer->getItem();

        if ($item->getProduct()->getTypeId()==Donation::TYPE_CODE) {
            $item->setNoDiscount(1);
        }

        return $this;
    }
}
