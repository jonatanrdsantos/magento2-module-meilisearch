<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Model\ResourceModel;

use Magento\Catalog\Model\Product\Visibility;
use Magento\CatalogSearch\Model\ResourceModel\EngineInterface;

class Engine implements EngineInterface
{
    /**
     * @var Visibility
     */
    private Visibility $catalogProductVisibility;

    public function __construct(
        Visibility $catalogProductVisibility
    ) {
        $this->catalogProductVisibility = $catalogProductVisibility;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedVisibility(): array
    {
        return $this->catalogProductVisibility->getVisibleInSiteIds();
    }

    /**
     * @inheritDoc
     */
    public function allowAdvancedIndex(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function processAttributeValue($attribute, $value)
    {
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function prepareEntityIndex($index, $separator = ' '): array
    {
        return $index;
    }

    public function isAvailable()
    {
        return true;
    }
}
