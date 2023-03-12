<?php


namespace Navyug\DonationProduct\Model;

use Navyug\DonationProduct\Api\Data\DonationsInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Donations
 * @package Navyug\DonationProduct\Model
 */
class Donations extends AbstractModel implements DonationsInterface
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Navyug\DonationProduct\Model\ResourceModel\Donations');
    }

    /**
     * Get donations_id
     * @return string
     */
    public function getDonationsId()
    {
        return $this->getData(self::DONATIONS_ID);
    }

    /**
     * Set donations_id
     * @param string $donationsId
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setDonationsId($donationsId)
    {
        return $this->setData(self::DONATIONS_ID, $donationsId);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get sku
     * @return string
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * Set sku
     * @param string $sku
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

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
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * Get order_item_id
     * @return string
     */
    public function getOrderItemId()
    {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    /**
     * Set order_item_id
     * @param string $order_item_id
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderItemId($order_item_id)
    {
        return $this->setData(self::ORDER_ITEM_ID, $order_item_id);
    }

    /**
     * Get order_id
     * @return string
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $order_id
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderId($order_id)
    {
        return $this->setData(self::ORDER_ID, $order_id);
    }

    /**
     * Get order_status
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->getData(self::ORDER_STATUS);
    }

    /**
     * Set order_status
     * @param string $order_status
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderStatus($order_status)
    {
        return $this->setData(self::ORDER_STATUS, $order_status);
    }

    /**
     * Get invoiced
     * @return string
     */
    public function getInvoiced()
    {
        return $this->getData(self::INVOICED);
    }

    /**
     * Set invoiced
     * @param string $invoiced
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setInvoiced($invoiced)
    {
        return $this->setData(self::INVOICED, $invoiced);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
