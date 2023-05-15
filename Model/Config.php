<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Model;

use Magento\AdvancedSearch\Model\Client\ClientOptionsInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Meilisearch\Search\Api\Data\ConfigInterface;

class Config implements ConfigInterface, ClientOptionsInterface
{
    private const CATALOG_SEARCH_MEILISEARCH_SERVER_HOSTNAME    = 'catalog/search/meilisearch_server_hostname';
    private const CATALOG_SEARCH_MEILISEARCH_SERVER_PORT        = 'catalog/search/meilisearch_server_port';
    private const CATALOG_SEARCH_MEILISEARCH_INDEX_PREFIX       = 'catalog/search/meilisearch_index_prefix';
    private const CATALOG_SEARCH_MEILISEARCH_CURRENT_INDEX      = 'catalog/search/meilisearch_current_index';
    private const CATALOG_SEARCH_MEILISEARCH_ENABLE_AUTH        = 'catalog/search/meilisearch_enable_auth';
    private const CATALOG_SEARCH_MEILISEARCH_MASTER_KEY         = 'catalog/search/meilisearch_master_key';
    private const CATALOG_SEARCH_MEILISEARCH_SERVER_TIMEOUT     = 'catalog/search/meilisearch_server_timeout';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Return search client options
     *
     * @param array $options
     *
     * @phpstan-param array<string, string>  $options
     * @phpstan-ignore-next-line
     *
     * @return array
     *
     * @since 100.1.0
     */
    public function prepareClientOptions($options = []): array
    {
        $defaultOptions = [
            'hostname' => $this->getServerHostname(),
            'port' => $this->getServerPort(),
            'index' => $this->getIndexPrefix(),
            'current_index' => $this->getCurrentIndex(),
            'enableAuth' => $this->isEnableAuth(),
            'master_key' => $this->getMasterKey(),
            'timeout' => $this->getServerTimeout(),
        ];
        $options = array_merge($defaultOptions, $options);
        $allowedOptions = array_merge(array_keys($defaultOptions), ['engine']);

        return array_filter(
            $options,
            function (string $key) use ($allowedOptions) {
                return in_array($key, $allowedOptions);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * @inheritDoc
     */
    public function getServerHostname(): ?string
    {
        return $this->scopeConfig->getValue(
            self::CATALOG_SEARCH_MEILISEARCH_SERVER_HOSTNAME,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getServerPort(): ?string
    {
        return $this->scopeConfig->getValue(
            self::CATALOG_SEARCH_MEILISEARCH_SERVER_PORT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getIndexPrefix(): ?string
    {
        return $this->scopeConfig->getValue(
            self::CATALOG_SEARCH_MEILISEARCH_INDEX_PREFIX,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getCurrentIndex(): ?string
    {
        return $this->scopeConfig->getValue(
            self::CATALOG_SEARCH_MEILISEARCH_CURRENT_INDEX,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function isEnableAuth(): bool
    {
        return (bool)$this->scopeConfig->isSetFlag(
            self::CATALOG_SEARCH_MEILISEARCH_ENABLE_AUTH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getMasterKey(): ?string
    {
        return $this->scopeConfig->getValue(
            self::CATALOG_SEARCH_MEILISEARCH_MASTER_KEY,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getServerTimeout(): ?string
    {
        return $this->scopeConfig->getValue(
            self::CATALOG_SEARCH_MEILISEARCH_SERVER_TIMEOUT,
            ScopeInterface::SCOPE_STORE
        );
    }
}
