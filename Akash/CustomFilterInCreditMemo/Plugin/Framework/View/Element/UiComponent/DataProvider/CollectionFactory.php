<?php
namespace Akash\CustomFilterInCreditMemo\Plugin\Framework\View\Element\UiComponent\DataProvider;

use Magento\Framework\Data\Collection;

/**
 * Class CollectionFactory
 */
class CollectionFactory
{
    /**
     * Const SALES_ORDER_CREDITMEMO_GRID_DATA_SOURCE: contains source name
     */
    const SALES_ORDER_CREDITMEMO_GRID_DATA_SOURCE = 'sales_order_creditmemo_grid_data_source';

    /**
     * @var Collection[]
     */
    protected $collections;

    /**
     * @param array $collections
     */
    public function __construct(
        array $collections = []
    ) {
        $this->collections  = $collections;
    }

    /**
     * Get report collection
     *
     * @param OrigFactory $subject
     * @param \Closure $proceed
     * @param string $requestName
     * 
     * @return Collection
     * @throws \Exception
     */
    public function aroundGetReport(
        \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject,
        \Closure $proceed,
        $requestName
    ) {
        $result = $proceed($requestName);

        $customerGroupId = 1;

        if ($requestName == self::SALES_ORDER_CREDITMEMO_GRID_DATA_SOURCE) {
            $result->addFieldToFilter("main_table.customer_group_id", $customerGroupId);
        }
        
        return $result;
    }
}