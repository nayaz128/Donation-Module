<?php


namespace Navyug\DonationProduct\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Donations
 * @package Navyug\DonationProduct\Model\ResourceModel
 */
class Donations extends AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Navyug_donations', 'donations_id');
    }
}
