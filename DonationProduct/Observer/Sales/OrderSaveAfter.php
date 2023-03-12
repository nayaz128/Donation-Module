<?php


namespace Navyug\DonationProduct\Observer\Sales;

use Navyug\DonationProduct\Model\Donations;
use Navyug\DonationProduct\Model\Product\Type\Donation;
use Navyug\DonationProduct\Model\DonationsRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class OrderSaveAfter
 * @package Navyug\DonationProduct\Observer\Sales
 */
class OrderSaveAfter implements ObserverInterface
{
    /**
     * @var Donations
     */
    private $donationsModel;

    /**
     * @var DonationsRepository
     */
    private $donationsRepository;

    /**
     * OrderPlaceAfter constructor.
     * @param Donations $donations
     * @param DonationsRepository $donationsRepository
     * @internal param DonationsRepository $donations
     */
    public function __construct(
        Donations $donations,
        DonationsRepository $donationsRepository
    ) {
        $this->donationsModel = $donations;
        $this->donationsRepository = $donationsRepository;
    }
    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer
    ) {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getOrder();
        $orderId = $order->getId();

        /** @var \Navyug\DonationProduct\Model\Donations $donations */
        $donations = $this->donationsRepository->getDonationsByOrderId($orderId);

        foreach ($donations as $donationItem) {
            $this->updateDonationItemData($donationItem, $order->getStatus());
        }
    }

    /**
     * @param $donationItem
     * @param $orderStatus
     */
    private function updateDonationItemData($donationItem, $orderStatus)
    {
        /** @var \Navyug\DonationProduct\Model\Donations $donationItem */
        $donationItem->setOrderStatus($orderStatus);
        $donationItem->save();
    }
}
