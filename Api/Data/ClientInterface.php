<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @copyright   Copyright (c) 2022 Meilisearch
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Api\Data;

use Meilisearch\Search\Api\Data\Client\IndexInterface;
use Meilisearch\Search\Api\Data\Client\IndexCollectionInterface;

interface ClientInterface
{
    /**
     * Get all indexes.
     *
     * @return IndexCollectionInterface
     */
    public function getAllIndexes(): IndexCollectionInterface;

    /**
     * Get one index.
     *
     * @param string $uid
     *
     * @return IndexInterface
     */
    public function getIndex(string $uid): IndexInterface;

    /**
     * Create an index.
     *
     * @param string $uid
     * @param ?string $primaryKey
     *
     * @return IndexInterface
     */
    public function createIndex(string $uid, string $primaryKey = null): IndexInterface;

    /**
     * Update an index.
     *
     * @param string $uid
     * @param string $primaryKey
     *
     * @return IndexInterface
     */
    public function updateIndex(string $uid, string $primaryKey): IndexInterface;

    /**
     * Delete an index.
     *
     * @param string $uid
     *
     * @return void
     */
    public function deleteIndex(string $uid): void;
}
