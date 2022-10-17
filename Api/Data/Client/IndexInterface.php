<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @copyright   Copyright (c) 2022 Meilisearch
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Api\Data\Client;

interface IndexInterface
{
    /**
     * Get uid.
     *
     * @return string
     */
    public function getUid(): string;

    /**
     * Set uid.
     *
     * @param string $uid
     *
     * @return $this
     */
    public function setUid(string $uid): IndexInterface;

    /**
     * Get createdAt.
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set createdAt.
     *
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(string $createdAt): IndexInterface;

    /**
     * Get updatedAt.
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set updatedAt.
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): IndexInterface;

    /**
     * Get primaryKey.
     *
     * @return string
     */
    public function getPrimaryKey(): string;

    /**
     * Set primaryKey.
     *
     * @param string $primaryKey
     *
     * @return $this
     */
    public function setPrimaryKey(string $primaryKey): IndexInterface;
}
