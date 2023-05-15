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
use Meilisearch\Search\Api\Data\Client\IndexCollectionInterface;
use Meilisearch\Search\Api\Data\Client\IndexInterface;
use Meilisearch\Search\Api\Data\ClientInterface as MeilisearchClientInterface;
use MeiliSearch\Client;
use MeiliSearch\ClientFactory;

class Meilisearch implements ClientInterface, MeilisearchClientInterface
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

    /**
     * @param ClientFactory $clientFactory
     * @param $options
     * @param $meilisearchClient
     */
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

    /**
     * @inheritDoc
     */
    public function getAllIndexes(): IndexCollectionInterface
    {
        //$indexes = $this->getClient()->getIndexes();
        // TODO: Implement getAllIndexes() method.
    }

    /**
     * @inheritDoc
     */
    public function getIndex(string $uid): IndexInterface
    {
        //$index = $this->getClient()->getIndex($uid);
        // TODO: Implement getIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function createIndex(string $uid, string $primaryKey = null): IndexInterface
    {
        $options = [];
        if (null == $primaryKey) {
            $options = ['primary_key' => $primaryKey];
        }
        $this->getClient()->createIndex($uid, $options);
        // TODO: Implement createIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function updateIndex(string $uid, string $primaryKey): IndexInterface
    {
        // TODO: Implement updateIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteIndex(string $uid): void
    {
        // TODO: Implement deleteIndex() method.
    }
}
