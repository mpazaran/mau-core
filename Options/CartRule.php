<?php

namespace Freedom\Core\Options;

use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory as CollectionFactory;
use Magento\SalesRule\Model\ResourceModel\Rule\Collection;
use Magento\SalesRule\Model\Rule as DataModel;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class to get cart rules as option array
 */
class CartRule implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var SearchCriteriaBuilder
     */

    private $searchCriteriaBuilder;
    /**
     * @var FilterBuilder
     */

    private $filterBuilder;
    /**
     * @var FilterGroupBuilder
     */

    private $filterGroupBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param CollectionFactory     $collectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder         $filterBuilder
     * @param FilterGroupBuilder    $filterGroupBuilder
     * @param SortOrderBuilder      $sortOrderBuilder
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->collectionFactory     = $collectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder         = $filterBuilder;
        $this->filterGroupBuilder    = $filterGroupBuilder;
        $this->sortOrderBuilder      = $sortOrderBuilder;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray(): array
    {
        /** @var Collection $itemCollection */
        $itemCollection = $this->collectionFactory->create();
        $itemCollection->setOrder('name', 'asc');
        $items    = [];
        /** @var DataModel $item */
        foreach ($itemCollection->getItems() as $item) {
            $itemId  = $item->getId();
            $items[] = [
                'value' => $itemId,
                'label' => $item->getName(),
            ];
        }

        return $items;
    }
}
