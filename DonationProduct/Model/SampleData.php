<?php


namespace Navyug\DonationProduct\Model;

class SampleData
{

    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $productRepository;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \Magento\Framework\File\Csv
     */
    protected $csvReader;

    /**
     * @var \Magento\Framework\Setup\SampleData\FixtureManager
     */
    protected $fixtureManager;

    /**
     * @var \Magento\Catalog\Model\Config
     */
    protected $catalogConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\File\Csv $csvReader,
        \Magento\Framework\Setup\SampleData\FixtureManager $fixtureManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Config $catalogConfig
    ) {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->csvReader = $csvReader;
        $this->fixtureManager = $fixtureManager;
        $this->catalogConfig = $catalogConfig;
        $this->storeManager = $storeManager;
    }

    public function getImportRows()
    {
        $fileName = $this->fixtureManager->getFixture('Navyug_DonationProduct::fixtures/products.csv');
        return $this->csvReader->getData($fileName);
    }

    public function install()
    {
        $rows = $this->getImportRows();

        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = [];
            foreach ($row as $key => $value) {
                $data[$header[$key]] = $value;
            }
            $this->addProduct($data);
        }
    }

    public function remove()
    {
        $rows = $this->getImportRows();

        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = [];
            foreach ($row as $key => $value) {
                $data[$header[$key]] = $value;
            }
            $this->deleteProduct($data);
        }
    }

    public function deleteProduct($data)
    {
        $product = $this->checkIfProductExists($data['sku']);

        if (!$product) {
            return;
        }

        $this->productRepository->delete($product);
    }

    public function addProduct($data)
    {
        if ($this->checkIfProductExists($data['sku'])) {
            return;
        }

        $attributeSetName = (isset($data['attribute_set'])) ? $data['attribute_set'] : 'Default';

        $attributeSetId = $this->catalogConfig->getAttributeSetId(4, $attributeSetName);

        $product = $this->productFactory->create();

        $product->unsetData();
        $product->setData($data);
        $product
            ->setTypeId('donation')
            ->setAttributeSetId($attributeSetId)
            ->setWebsiteIds([$this->storeManager->getDefaultStoreView()->getWebsiteId()])
            ->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
            ->setStoreId(\Magento\Store\Model\Store::DEFAULT_STORE_ID);

        if (empty($data['visibility'])) {
            $product->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        }

        $this->productRepository->save($product);
    }

    public function checkIfProductExists($sku)
    {
        try {
            $product = $this->productRepository->get($sku);
        } catch (\Exception $e) {
            return false;
        }
        return $product;
    }
}
