<?php


namespace Navyug\DonationProduct\Model\ResourceModel\Donations;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Navyug\DonationProduct\Model\ResourceModel\Donations
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Navyug\DonationProduct\Model\Donations',
            'Navyug\DonationProduct\Model\ResourceModel\Donations'
        );
    }
}
