<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @copyright   Copyright (c) 2022 Meilisearch
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Gateway\Client;

use Magento\AdvancedSearch\Model\Client\ClientInterface;
use MeiliSearch\Client;
use MeiliSearch\ClientFactory;

class Meilisearch implements ClientInterface
{
    /**
     * @var array
     */
    private array $options;

    /**
     * @var Client[]
     */
    private array $pool;

    /**
     * @var ClientFactory
     */
    private ClientFactory $clientFactory;

    public function __construct(
        ClientFactory $clientFactory,
        $options = [],
        $meilisearchClient = null
    ) {
        $this->options = $options;
        $this->clientFactory = $clientFactory;

        if ($meilisearchClient instanceof Client) {
            $this->pool[getmypid()] = $meilisearchClient;
        }
    }

    /**
     * @inheritDoc
     */
    public function testConnection(): bool
    {
        return $this->getClient()->isHealthy();
    }

    /**
     * Get Client
     *
     * @return Client
     */
    private function getClient(): Client
    {
        $pid = getmypid();
        if (!isset($this->pool[$pid])) {
            $this->pool[$pid] = $this->clientFactory->create([
                'url' => $this->options['hostname'] . ':' . $this->options['port'],
                'apiKey' => $this->options['master_key']
            ]);
        }
        return $this->pool[$pid];
    }
}
