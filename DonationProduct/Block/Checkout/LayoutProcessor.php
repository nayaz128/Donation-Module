<?php


namespace Navyug\DonationProduct\Block\Checkout;

use Navyug\DonationProduct\Helper\Data as DonationHelper;
use Navyug\DonationProduct\Block\Donation\ListProductFactory as DonationProductsFactory;

/**
 * Class LayoutProcessor
 * @package Navyug\DonationProduct\Block\Checkout
 */
class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{

    /**
     * @var DonationHelper
     */
    private $donationHelper;

    /**
     * @var \Navyug\DonationProduct\Block\Donation\ListProduct
     */
    private $donationProductsFactory;

    /**
     * LayoutProcessor constructor.
     * @param DonationHelper $donationHelper
     * @param DonationProducts $donationProducts
     */
    public function __construct(
        DonationHelper $donationHelper,
        DonationProductsFactory $donationProductsFactory
    ) {
        $this->donationHelper = $donationHelper;
        $this->donationProductsFactory = $donationProductsFactory;
    }

    /**
     * @param array $result
     * @return array
     */
    public function process($result)
    {

        if ($this->donationHelper->isLayoutCheckoutEnabled() &&
            isset($result['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['afterMethods']['children'])) {
            $result['components']['checkout']['children']['steps']['children']
            ['billing-step']['children']['payment']['children']
            ['afterMethods']['children']['Navyug-donations'] = $this->getDonationForm('checkout.donation.list');
        }

        if ($this->donationHelper->isLayoutCheckoutSidebarEnabled() &&
            isset($result['components']['checkout']['children']['sidebar']['children']['summary']['children'])) {
            $result['components']['checkout']['children']['sidebar']['children']['summary']['children']
            ['Navyug-donations'] = $this->getDonationForm('checkout.sidebar.donation.list');
        }

        return $result;
    }

    /**
     * @param $scope
     * @return array
     */
    public function getDonationForm($nameInLayout)
    {
        $donationProductsBlock = $this->donationProductsFactory->create();
        $donationProductsBlock->setTemplate('donation.phtml');
        $donationProductsBlock->setNameInLayout($nameInLayout);
        $donationProductsBlock->setAjaxRefreshOnSuccess(true);

        $content = $donationProductsBlock->toHtml();
        $content .= "<script type=\"text/javascript\">jQuery('body').trigger('contentUpdated');</script>";

        $donationForm =
            [
                'component' => 'Magento_Ui/js/form/components/html',
                'config' => [
                    'content'=> $content
                ]
            ];

        return $donationForm;
    }
}
