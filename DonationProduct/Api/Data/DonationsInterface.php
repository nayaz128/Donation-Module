<?php

namespace Navyug\DonationProduct\Api\Data;

/**
 * Interface DonationsInterface
 * @package Navyug\DonationProduct\Api\Data
 */
interface DonationsInterface
{

    const ORDER_STATUS = 'order_status';
    const ORDER_ID = 'order_id';
    const DONATIONS_ID = 'donations_id';
    const NAME = 'name';
    const AMOUNT = 'amount';
    const INVOICED = 'invoiced';
    const SKU = 'sku';
    const CREATED_AT = 'created_at';
    const ORDER_ITEM_ID = 'order_item_id';


    /**
     * Get donations_id
     * @return string|null
     */
    public function getDonationsId();

    /**
     * Set donations_id
     * @param string $donationsId
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setDonationsId($donationsId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setName($name);

    /**
     * Get sku
     * @return string|null
     */
    public function getSku();

    /**
     * Set sku
     * @param string $sku
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setSku($sku);

    /**
     * Get amount
     * @return string|null
     */
    public function getAmount();

    /**
     * Set amount
     * @param string $amount
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setAmount($amount);

    /**
     * Get order_item_id
     * @return string|null
     */
    public function getOrderItemId();

    /**
     * Set order_item_id
     * @param string $order_item_id
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderItemId($order_item_id);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $order_id
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderId($order_id);

    /**
     * Get order_status
     * @return string|null
     */
    public function getOrderStatus();

    /**
     * Set order_status
     * @param string $order_status
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setOrderStatus($order_status);

    /**
     * Get invoiced
     * @return string|null
     */
    public function getInvoiced();

    /**
     * Set invoiced
     * @param string $invoiced
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setInvoiced($invoiced);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Navyug\DonationProduct\Api\Data\DonationsInterface
     */
    public function setCreatedAt($createdAt);
}
