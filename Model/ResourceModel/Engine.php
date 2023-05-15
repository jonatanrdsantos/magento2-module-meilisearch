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

    /**
     * @param Visibility $catalogProductVisibility
     */
    public function __construct(
        Visibility $catalogProductVisibility
    ) {
        $this->catalogProductVisibility = $catalogProductVisibility;
    }

    /**
     * @inheritDoc
     * @phpstan-ignore-next-line
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
     * @phpstan-ignore-next-line
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function prepareEntityIndex($index, $separator = ' '): array
    {
        return $index;
    }

    /**
     * Engine status
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return true;
    }
}
