<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Block\Adminhtml\System\Config;

/**
 * Meilisearch test connection block
 */
class TestConnection extends \Magento\AdvancedSearch\Block\Adminhtml\System\Config\TestConnection
{
    /**
     * @inheritdoc
     */
    protected function _getFieldMapping(): array
    {
        $fields = [
            'engine' => 'catalog_search_engine',
            'hostname' => 'catalog_search_meilisearch_server_hostname',
            'port' => 'catalog_search_meilisearch_server_port',
            'index' => 'catalog_search_meilisearch_index_prefix',
            'enableAuth' => 'catalog_search_meilisearch_enable_auth',
            'master_key' => 'meilisearch_master_key',
            'timeout' => 'catalog_search_meilisearch_server_timeout',
        ];

        return array_merge(parent::_getFieldMapping(), $fields);
    }
}
